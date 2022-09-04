<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ManualController extends Controller
{
    public function privacy()
    {
        return view('manual/privacy');
    }
    public function terms()
    {
        return view('manual/terms');
    }
    public function transaction()
    {
        return view('manual/transaction');
    }
    public function faq()
    {
        return view('manual/faq');
    }
    public function sample()
    {
        //サンプル動画で再生するpathを指定する↓
        $item = '1-2020-06-19-134148409006';
        return view('manual/sample', compact('item'));
    }
    

}
