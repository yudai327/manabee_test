<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    //プロフィールページへ
    public function index(Request $request)
    {
        return view('profile/index');
    }
}
