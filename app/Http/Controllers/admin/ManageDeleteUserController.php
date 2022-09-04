<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class ManageDeleteUserController extends Controller
{
    function showUserList()
    {
        $user_list = User::orderBy("id", "asc")
                        ->whereNotNull('deleted_at')
                        ->paginate(10);
        return view("admin.delete_user_list", [
            "user_list" => $user_list
        ]);
    }
}
