<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Settlement;
use App\Bank;
use App\User;
use App\Sale;
use App\Item;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class ManageUserSalesController extends Controller
{
    public function item(Request $request, $id, $item_id)
    {
        $item = Item::where('id', $item_id)
            ->with('user')->first();
        // dd($item);
        $settlements = Settlement::select()
            ->orderBy('settlements.created_at', 'desc')
            ->join('items', 'items.id', '=', 'settlements.item_id')
            ->where('items.id', $item_id)
            ->join('users', 'users.id', '=', 'settlements.user_id')
            ->select(
                'settlements.price as settlements_price',
                'settlements.id as settlements_id',
                'settlements.user_id as user_id',
                'items.id as items_id',
                'items.path as path',
                'users.nickname as nickname',
                'users.created_at as user_created_at',
                'items.image_path as image_path',
                'items.title as items_title',
                'settlements.created_at as created_at'
            )
            ->get();
        return view('admin.user_detail_salesitem', compact('id', 'item_id', 'item', 'settlements'));
    }

    public function sales(Request $request, $id)
    {
        $now = Carbon::now()->format('Y-m-d H:i:s');
        $first = Carbon::now()->startOfMonth()->format('Y-m-d H:i:s');
        $last = Carbon::now()->endOfMonth()->format('Y-m-d H:i:s');

        $settlement = Settlement::select()
            ->orderBy('settlements.created_at', 'desc')
            ->join('items', 'items.id', '=', 'settlements.item_id')
            ->where('items.user_id', $id)
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
                'settlements.created_at as created_at'
            )
            ->whereBetween('settlements.created_at', ['Carbon(user_created_at)', $now]);

        $settlements = $settlement->Paginate(30);

        $day＿histories = $settlement
            ->get()
            ->groupBy(function ($row) {
                return $row->created_at->format('Y-m-d');
            })
            ->map(function ($day) {
                return [$day->sum('settlements_price'), $day->count('settlements_price')];
            });

        $month＿histories = $settlement
            ->get()
            ->groupBy(function ($row) {
                return $row->created_at->format('Y-m');
            })
            ->map(function ($day) {
                return [$day->sum('settlements_price'), $day->count('settlements_price')];
            });

        $year＿histories = $settlement
            ->get()
            ->groupBy(function ($row) {
                return $row->created_at->format('Y');
            })
            ->map(function ($day) {
                return [$day->sum('settlements_price'), $day->count('settlements_price')];
            });



        return view('admin.user_sales_detail', compact('id', 'settlements', 'day＿histories', 'month＿histories', 'year＿histories'));
    }

}

