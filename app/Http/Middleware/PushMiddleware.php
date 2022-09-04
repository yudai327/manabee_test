<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Push;
use App\User;
use App\Read;
use Illuminate\Support\Facades\Auth; //追加
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class PushMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // ログイン済みのときの処理
        if (Auth::check()) {
            // ステータス０で全体にお知らせ＆運営から個人にお知らせするときの処理
            $user = Auth::user();
            $user_id = Auth::id();
            $nowtimes = Carbon::now();
            $date = Push::query();
            $pushes = $date
                ->with(['item','reads'])
                ->orwhere('user_id' ,$user_id)
                ->orwhere([
                    ['status', 0],
                    ['user_id', null]
                    ])
                ->orderBy('created_at', 'desc')
                ->get();
            View::share(['pushes' =>$pushes, 'nowtimes' =>$nowtimes, 'user' =>$user]);

        } else {
            // ログインしていないときの処理
            $user_push = [];
            View::share(['pushes' => $user_push]);
        }
        //全てのViewに、pushesという名前の配列を渡す.

        return $next($request);
    }
}
