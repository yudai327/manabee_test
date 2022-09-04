<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;

class PurchasedMovieController extends Controller
{
    public function index($id)
    {

        $items = Item::whereHas('settlements' , function ($query) use ($id) {
                $query->where('user_id', $id);
            })
            ->with(['preitem', 'item_settlements', 'user'])
            ->orderBy('created_at', 'desc')
            ->where('convert_flg', 1)
            ->where('delete_flg', 0)
            ->where('preview_flg', '<', 2)
            ->Paginate(5);
        return view('purchased.index', compact('items'));
    }
}