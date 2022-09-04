<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\Like;
use Illuminate\Support\Facades\Auth;


class AjaxLikeItemController extends Controller
{
    public function ajaxlike(Request $request)
    {
        $id = Auth::id();
        $item_id = $request->item_id;
        $likedata = Like::where('item_id', $item_id)->where('user_id', $id)->get();
        $item = Item::findOrFail($item_id);
        //loadCountとすればリレーションの数を○○_countという形で取得できる（今回の場合はいいねの総数）
        // 空なら
        if ($likedata->isEmpty()) {
            //likesテーブルに新しいレコードを作成する
            $like = new Like;
            $form['item_id'] = $request->item_id;
            $form['user_id'] = Auth::id();
            $like->fill($form)->save();
        } else {
            //likesテーブルのレコードを削除
            $like = Like::where('item_id', $item_id)->where('user_id', $id)->delete();
        }
        $itemLikesCount = $item->loadCount('likes')->likes_count;

        //一つの変数にajaxに渡す値をまとめる
        //今回ぐらい少ない時は別にまとめなくてもいいけど一応。笑
        $json = [
            'itemLikesCount' => $itemLikesCount,
        ];
        //下記の記述でajaxに引数の値を返す
        return response()->json($json);
    }

}
