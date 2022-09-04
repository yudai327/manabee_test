<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Item;
use App\Settlement;
use App\Sale;

use App\Push;
use Carbon\Carbon;

class AdminTopController extends Controller
{
    function show()
    {
        $now = Carbon::now()->format('Y-m-d H:i:s');
        $first = Carbon::now()->startOfMonth()->format('Y-m-d H:i:s');
        $last = Carbon::now()->endOfMonth()->format('Y-m-d H:i:s');

        $users = User::whereNull('deleted_at')->count();
        $del_users = User::whereNotNull('deleted_at')->count();

        $items = Item::where('delete_flg', 0)->count();
        $del_items = Item::where('delete_flg', 1)->count();

        $settlements = Settlement::count();

        $total_sales = Settlement::sum('price');
        $this_month_sales = Settlement::whereBetween('created_at', [$first, $last])->sum('price');

        $total_settlement_fee = Settlement::sum('settlement_fee');
        $this_month_settlement_fee = Settlement::whereBetween('created_at', [$first, $last])->sum('settlement_fee');

        $total_transfer_fee = Sale::sum('transfer_fee');
        $this_month_transfer_fee = Sale::whereBetween('transfer_at', [$first, $last])->sum('transfer_fee');
        
        $total_transfer_fee_real = Sale::sum('transfer_fee_real');
        $this_month_transfer_fee_real = Sale::whereBetween('transfer_at', [$first, $last])->sum('transfer_fee_real');

        $total_platform_fee = Settlement::sum('platform_fee');
        $this_month_platform_fee = Settlement::whereBetween('created_at', [$first, $last])->sum('platform_fee');

        $before_sales = Sale::where('transfer_flg', 0)->count();
        $after_sales = Sale::where('transfer_flg', 1)->count();

        return view("admin.admin_top",
        compact('users', 'del_users', 'items', 'del_items', 'settlements',
                 'total_sales', 'this_month_sales',
                'total_settlement_fee',
                'this_month_settlement_fee',
                'total_transfer_fee',
                'this_month_transfer_fee',
                'total_transfer_fee_real',
                'this_month_transfer_fee_real',
                'total_platform_fee',
                'this_month_platform_fee',
                'before_sales',
                'after_sales'
            ));
    }
}
