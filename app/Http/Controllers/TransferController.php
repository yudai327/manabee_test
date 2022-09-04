<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Settlement;
use App\Sale;
use App\Bank;
use App\Item;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class TransferController extends Controller
{
    public function index($id)
    {
        $now = Carbon::now()->format('Y-m-d H:i:s');
        $first = Carbon::now()->startOfMonth()->format('Y-m-d H:i:s');
        $last = Carbon::now()->endOfMonth()->format('Y-m-d H:i:s');
        $before_month = Carbon::parse('- 1 month')->endOfMonth()->format('Y-m-d H:i:s');

//-------------- 手数料系　　変更あればここをいじること！！----------------
        // $settlement_rate = 0.0325; //決済手数料3.25％
        // $platform_rate = 0.1; //プラットフォーム手数料10％
        $transfer_fee = 300; //振込手数料300円
// ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

        $settlement = Settlement::select()
            ->orderBy('settlements.created_at', 'desc')
            ->join('items','items.id','=', 'settlements.item_id')
            ->where('items.user_id',$id);
        $histories = $settlement
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
                'settlements.created_at as created_at')
            ->whereBetween('settlements.created_at', ['Carbon(user_created_at)', $now]);

            $sum = $histories->get()->sum('settlements_price');
        $timehistories = $histories
            ->get()
            ->groupBy(function ($row) {
                return $row->created_at->format('Y-m');
            })
            ->map(function ($day) {
                return [$day->sum('settlements_price') , $day->count('settlements_price')];
            });

        $nowhistories = $histories
            ->whereBetween('settlements.created_at', [$first, $last])
            ->Paginate(12);


        $my_items = Item::with('settlements')
            ->where('user_id', $id)
            ->where('delete_flg', 0)
            ->where('preview_flg', '<', 2)
            ->orderBy('items.updated_at', 'desc')
            ->Paginate(5);

// 振込可能金額
        $param = Settlement::select()
                ->orderBy('settlements.created_at', 'desc')
                ->join('items', 'items.id', '=', 'settlements.item_id')
                ->where('items.user_id', $id)
                ->join('users', 'users.id', '=', 'settlements.user_id')
                ->select(
                    'settlements.price as settlements_price',
                    'settlements.settlement_fee as settlements_settlement_fee',
                    'settlements.platform_fee as settlements_platform_fee',
                    'settlements.id as settlements_id',
                    'settlements.created_at as created_at'
                )
                ->whereDate('settlements.created_at','<', $before_month);

//決済関係の計算式
        $sale = Sale::where('user_id', $id)->sum('price'); //振込申請済金額
        $not_transferred = Sale::where('user_id', $id)->where('transfer_flg',0)->sum('price'); //振込申請済かつ未振込金額
        $sum_transfer0 = $param->sum('settlements.price'); //先月末までの売上合計
        $sum_transfer = $sum_transfer0 - $sale;//先月末までの売上合計から申請金額を引いた額
        $settlement_fee = $param->sum('settlements.settlement_fee');//squareのクレジット決済手数料
        $platform_fee = $param->sum('settlements.platform_fee');//プラットフォーム手数料
        $possible_sum_transfer = $sum_transfer0 - $sale - $settlement_fee - $platform_fee;//引出し可能金額

// 今月の売上金額
        $sum_month = $settlement->where('items.user_id', $id)
            ->whereBetween('settlements.created_at', [$first, $last])->sum('settlements.price');
// 登録済み口座
        $bank = Bank::where('user_id', $id)->latest()->first();
// 登録済み口座
        $hurikomies = Sale::where('user_id', $id)
            ->orderBy('request_at', 'desc')
            ->Paginate(10);


        return view('transfer.index', compact('id','my_items','histories', 'timehistories', 'nowhistories', 'sum_transfer', 'possible_sum_transfer','sum', 'sum_month', 'first', 'last', 'bank', 'transfer_fee', 'platform_fee', 'settlement_fee', 'hurikomies', 'not_transferred'));
    }

    public function form(Request $request, $id)
    {
        return view('transfer.form', compact('id'));
    }


    public function store(Request $request, $id)
    {
        $bank = new Bank;
        $inputs = $request->all();
        $bank->user_id = $id;
        unset($inputs['_token']);

        //rules
        $rules = [
            'bank_name' => 'required|max:50',
            'branch_name' => 'required|max:50',
            'deposit_type' => 'required|max:5',
            'bank_num' => 'required|numeric',
            'name' => 'required|max:50'
        ];

        //validation
        $validation = \Validator::make($inputs,$rules);

        //if fails
        if($validation->fails())
        {
            return redirect()->back()->withErrors($validation->errors())->withInput();
        }
        // 二重送信対策
        // $request->session()->regenerateToken();
        //バリデーションOK
        $bank->fill($inputs)->save();
        return redirect()->route('transfer', ['id' => $id]);
    }
    public function edit(Request $request, $id)
    {
        $user = $id;
        $date = Bank::where('user_id', $user)->latest()->first();
        return view('transfer.edit', compact('id', 'date'));
    }

    public function update(Request $request, $id)
    {
        $bank = new Bank;
        $inputs = $request->all();
        $bank->user_id = $id;
        unset($inputs['_token']);

        //rules
        $rules = [
            'bank_name' => 'required|max:50',
            'branch_name' => 'required|max:50',
            'deposit_type' => 'required|max:5',
            'bank_num' => 'required|numeric',
            'name' => 'required|max:50'
        ];

        //validation
        $validation = \Validator::make($inputs, $rules);

        //if fails
        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation->errors())->withInput();
        }
        // 二重送信対策
        // $request->session()->regenerateToken();
        //バリデーションOK
        $bank->fill($inputs)->save();
        return redirect()->route('transfer', ['id' => $id]);

    }
}