<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Push;
use App\Read;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PushReadController extends Controller
{
    //
    public function index(Request $request)
    {
        $push['read_user_id'] = Auth::id();
        $push['push_id'] = $request->input('push_id');
        $push['read_at'] = Carbon::now();
        $id = $request->input('item_id');
        $read = new Read();
        $read->timestamps = false;    // 追記
        $read->fill($push)->save();

        if($id !== null){
            return redirect()->route('item.view', ['id' => $id]);
        }else{
            return redirect()->route('push');
        }
    }
}
