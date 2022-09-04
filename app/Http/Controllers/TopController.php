<?php

namespace App\Http\Controllers;

use App\User;
use App\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;



class TopController extends Controller
{
    public function index(Request $request)
    {
        $query = Item::with('settlements')
            ->with(['preitem', 'settlements', 'user', 'item_settlements', 'object_scores', 'play_counts'])
            ->where('convert_flg', 1)
            ->where('release_flg', 0)
            ->where('delete_flg', 0)
            ->where('preview_flg','<', 2)
            ->wherehas('user' , function ($query) {
            $query->where('deleted_at', null);
        });

        $items = $query->where('preview_flg', '<', 2)
            ->orderBy('created_at', 'desc')
            ->take(4)->get();
        $up_items = $query->where('preview_flg', '<', 2)
            ->withCount('likes')
            ->orderBy('created_at', 'desc')
            ->take(4)->get();
        $rand_items = $query->where('preview_flg', '<', 2)
            ->inRandomOrder('id')
            ->Paginate(8);
        $search = $request->input('search');
        $s_items = null;

        $nowtimes = Carbon::now();
        return view('top/index', compact('s_items', 'items', 'up_items', 'nowtimes', 'search', 'rand_items'));
    }
}
