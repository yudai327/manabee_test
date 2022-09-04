<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Sale;
use App\Bank;
use App\User;
use Carbon\Carbon;
use App\Mail\AdminTransferCompletedSendMail;
use App\Mail\AdminTransferCompleted2SendMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;


class ManageTransferController extends Controller
{
    function list()
    {
        $transferes = Sale::orderBy("id", "desc")
        ->with('user')->paginate(10);
        return view("admin.transfer.transfer_list", compact('transferes'));
    }

    function transfer($id)
    {
        $transfer = Sale::where("id", $id)->first();
        return view("admin.transfer.transfer", compact('transfer'));
    }

    function post(Request $request)
    {
        $id = $request->input('id');
        $transfer_fee = intval($request->input('transfer_fee'));
        $transfer_fee_real = intval($request->input('transfer_fee_real'));
        $transfer = Sale::where("id", $id)->first();
        $now = Carbon::now();
        //db保存
        $transfer->transfer_flg = 1;
        $transfer->transfer_fee = $transfer_fee;
        $transfer->transfer_fee_real = $transfer_fee_real;
        $transfer->timestamps = false;    // 追記
        $transfer->transfer_at = $now;

        $transfer->save();

        //メール
        $user_id = $transfer->user_id;
        $bank_id = $transfer->bank_id;
        $user = User::findOrFail($user_id);
        $bank = Bank::findOrFail($bank_id);
        Mail::to($user->email)->send(new AdminTransferCompletedSendMail($user, $transfer , $bank));
        Mail::to("manabee.info@gmail.com")->send(new AdminTransferCompleted2SendMail($user, $transfer, $bank));

        // 追加-------ステータス関係-----
        $push_data = [
            ['status' => 0, 'user_id' => $user_id, 'comment' => '[振込完了]指定口座への振込が完了いたしました。ご確認ください。', 'created_at' => $now, 'updated_at' => $now],
        ];
        DB::table('pushes')
        ->insert($push_data);
		// ここまで追加-------ステータス関係-----


        return redirect()->route('admin.transfer_list');
    }

}
