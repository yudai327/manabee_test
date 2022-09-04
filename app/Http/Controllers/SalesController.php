<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Settlement;
use App\Bank;
use App\User;
use App\Sale;
use App\Item;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Mail\TransferSendMail;
use Illuminate\Support\Facades\Mail;


class SalesController extends Controller
{
    //
    public function sales(Request $request, $id)
    {
        $now = Carbon::now()->format('Y-m-d H:i:s');
        $first = Carbon::now()->startOfMonth()->format('Y-m-d H:i:s');
        $last = Carbon::now()->endOfMonth()->format('Y-m-d H:i:s');

        $settlement = Settlement::select()
            ->orderBy('settlements.created_at', 'desc')
            ->join('items', 'items.id', '=', 'settlements.item_id')
            ->where('items.user_id', $id)
            ->join('users', 'users.id', '=', 'settlements.user_id')
            ->select(
                'settlements.price as settlements_price',
                'settlements.id as settlements_id',
                'items.id as items_id',
                'items.path as path',
                'users.nickname as nickname',
                'users.created_at as user_created_at',
                'items.image_path as image_path',
                'items.title as items_title',
                'settlements.created_at as created_at'
            )
            ->whereBetween('settlements.created_at', ['Carbon(user_created_at)', $now]);

        $settlements = $settlement->Paginate(30);

        $day＿histories = $settlement
            ->get()
            ->groupBy(function ($row) {
                return $row->created_at->format('Y-m-d');
            })
            ->map(function ($day) {
                return [$day->sum('settlements_price'), $day->count('settlements_price')];
            });

        $month＿histories = $settlement
            ->get()
            ->groupBy(function ($row) {
                return $row->created_at->format('Y-m');
            })
            ->map(function ($day) {
                return [$day->sum('settlements_price'), $day->count('settlements_price')];
            });

        $year＿histories = $settlement
            ->get()
            ->groupBy(function ($row) {
                return $row->created_at->format('Y');
            })
            ->map(function ($day) {
                return [$day->sum('settlements_price'), $day->count('settlements_price')];
            });



        return view('sales.sales', compact('id', 'settlements', 'day＿histories', 'month＿histories', 'year＿histories'));
    }


    public function item(Request $request, $id, $item_id)
    {
        $item = Item::where('id', $item_id)
            ->with('user')->first();
        // dd($item);
        $settlements = Settlement::select()
            ->orderBy('settlements.created_at', 'desc')
            ->join('items', 'items.id', '=', 'settlements.item_id')
            ->where('items.id', $item_id)
            ->join('users', 'users.id', '=', 'settlements.user_id')
            ->select(
                'settlements.price as settlements_price',
                'settlements.id as settlements_id',
                'settlements.user_id as user_id',
                'items.id as items_id',
                'items.path as path',
                'users.nickname as nickname',
                'users.created_at as user_created_at',
                'items.image_path as image_path',
                'items.title as items_title',
                'settlements.created_at as created_at'
            )
            ->get();
        return view('sales.item', compact('id', 'item_id', 'item', 'settlements'));
    }
    public function request(Request $request, $id)
    {
        $transfer_fee = $request->transfer_fee;
        $possible_sum_transfer = $request->possible_sum_transfer;
        $bank_id = $request->bank_id;
        $bank = Bank::where('id', $bank_id)->first();
        return view('sales.request', compact('id', 'transfer_fee', 'possible_sum_transfer','bank_id', 'bank'));
    }
    public function store(Request $request, $id)
    {
        // 前月
        $before_month = Carbon::parse('- 1 month')->endOfMonth()->format('Y-m-d H:i:s');
        // 振込可能金額
        $param = Settlement::select()
                ->select(
                    'settlements.price',
                    'settlements.settlement_fee',
                    'settlements.platform_fee',
                )
                ->join('items', 'items.id', '=', 'settlements.item_id')
                ->where('items.user_id', $id)
                ->whereDate('settlements.created_at','<', $before_month);

        $sale = Sale::where('user_id', $id)->sum('price');                                  //振込申請済金額
        $sum_transfer0 = $param->sum('settlements.price');                                  //先月末までの売上合計
        $settlement_fee = $param->sum('settlements.settlement_fee');                        //squareのクレジット決済手数料
        $platform_fee = $param->sum('settlements.platform_fee');                            //プラットフォーム手数料
        $possible_sum_transfer = $sum_transfer0 - $sale - $settlement_fee - $platform_fee;  //引出し可能金額

        $this->validate($request, ['price' => "required|numeric|min:1000|max:{$possible_sum_transfer}"]);

        $sales = new Sale();
        $now = Carbon::now();
        $sales->timestamps = false;    // 追記
        $form['user_id'] = $id;
        $form['bank_id'] = $request->bank_id;
        $form['price'] = $request->price;
        $form['transfer_fee'] = 0; //管理画面で振込手数料を入力するように変更
        $form['transfer_fee_real'] = 0;//管理画面で振込手数料を入力するように変更
        $form['transfer_flg'] = 0;
        $form['request_at'] = $now;

        $sales->fill($form)->save();

        //メール
        $user = User::findOrFail($id);
        $bank = Bank::findOrFail($request->bank_id);
        Mail::to($user->email)->send(new TransferSendMail($bank, $request->price, $request->transfer_fee));
        Mail::to("manabee.info@gmail.com")->send(new TransferSendMail($bank, $request->price, $request->transfer_fee));

        // 二重送信防止
        $request->session()->regenerateToken();
        
        return redirect()->route('transfer', ['id' => $id]);
    }

}
