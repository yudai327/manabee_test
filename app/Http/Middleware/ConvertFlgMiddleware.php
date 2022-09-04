<?php

namespace App\Http\Middleware;

use Closure;
use App\Item;

class ConvertFlgMiddleware
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
        //動画変換したかURLでチェックし、変換後のURLが存在すればDBに変換フラグを挿入する
        $url_check_items = Item::where('convert_flg', 0)->orWhere('pre_convert_flg', 0)->get();
        if ($url_check_items !== null) {
            foreach ($url_check_items as $url_check_item) {
                $url = 'https://media.' . config('const.domain') . '/converted_movie/' . $url_check_item->path . '/' . $url_check_item->path . '.m3u8';
                $response = @file_get_contents($url, NULL, NULL, 0, 1);
                $pre_url = 'https://media.' . config('const.domain') . '/short_movie/' . $url_check_item->path . '/' . $url_check_item->path . '.m3u8';
                $pre_response = @file_get_contents($pre_url, NULL, NULL, 0, 1);
                if ($response !== false) {
                    $url_check_item->convert_flg = 1;
                    $url_check_item->save();
                }
                if ($pre_response !== false) {
                    $url_check_item->pre_convert_flg = 1;
                    $url_check_item->save();
                }
            }
        }

        return $next($request);
    }
}
