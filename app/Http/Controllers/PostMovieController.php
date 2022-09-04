<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use Illuminate\Support\Facades\DB;


class PostMovieController extends Controller
{
    public function index($id)
    {
        $items = Item::with(['preitem', 'settlements'])
        ->where('user_id', $id)
        ->where('preview_flg','<',2)
        ->where('delete_flg', 0)
        ->orderBy('created_at', 'desc')
        ->Paginate(5);
        return view('posted.index', compact('items'));
    }

}
