<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Push;

class ManagePushController extends Controller
{
    function list()
    {
        $pushes = Push::orderBy("created_at", "desc")
        ->where('status', 0)
        ->paginate(10);
        return view("admin.push_list", [
            "pushes" => $pushes
        ]);

    }
    function show()
    {
        $user_list = User::orderBy("id", "asc")->get();
        return view("admin.push", [
            "user_list" => $user_list
        ]);
    }
    function post(Request $request)
    {
        $comment = $request->comment;
        $u_id = $request->user_id;
        if($u_id == 0){
            $user_id = null;
        }else{
            $user_id = $u_id;

        }
        //db保存
        $push = new Push;
        $form['status'] = 0;
        $form['user_id'] = $user_id;
        $form['comment'] = $comment;
        $push->fill($form)->save();
        return redirect()->route('admin.push_list');

    }
}
