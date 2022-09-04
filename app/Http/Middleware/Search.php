<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use App\Item;


class Search
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
        $response = $next($request);

        $nowtimes = Carbon::now();
        $search = null;
        $search = $request->input('search');
        $query = Item::with('settlements')
            ->with(['preitem', 'settlements', 'user'])
            ->where('convert_flg', 1)
            ->where('release_flg', 0)
            ->where('delete_flg', 0)
            ->where('preview_flg', '<', 2)
            ->wherehas('user', function ($query) {
                $query->where('deleted_at', null);
            });

        $up_items = $query->where('preview_flg', '<', 2)
            ->withCount('likes')
            ->orderBy('created_at', 'desc')
            ->Paginate(12);


        //もしキーワードがあったら
        if ($search !== null) {
            //全角を半角に
            $search_split = mb_convert_kana($search, 's');

            //空白で区切る
            $search_split2 = preg_split('/[\s]+/', $search_split, -1, PREG_SPLIT_NO_EMPTY);

            //単語をループする
            foreach ($search_split2 as $value) {
                $s_items = $query->where('title', 'like', "%{$value}%")
                                ->orWhere('detail', 'like', "%{$value}%")
                                ->paginate(12);

            }

            return response(view('top/index', compact('nowtimes','search','s_items', 'up_items')));
        }

        return $response;
    }
}
