<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Item;
use Carbon\Carbon;

class UserPageController extends Controller
{
    //ユーザーページのコントローラー
    public function index($id)
    {
        $user = User::where('id', $id)->first();
        $params = Item::where('user_id', $id)
            ->orderBy('created_at', 'desc')
            ->with(['preitem', 'settlements', 'user'])
            ->where('convert_flg', 1)
            ->where('release_flg', 0)
            ->where('delete_flg', 0)
            ->where('preview_flg', '<', 2);
        $items = $params->Paginate(12);

        $nowtimes = Carbon::now();

        $hoge = $params->withCount('settlements')->get();
        $sum = $hoge->sum('settlements_count');
        $count = count($params->get());
        $hogehoge = Item::join('object_scores', 'items.id', '=', 'object_scores.item_id')
            ->select('items.*', 'object_scores.score', 'items.user_id as user_id', 'object_scores.user_id as o_user_id')
            ->where('items.user_id', $id)
            ->orderBy('created_at', 'desc')
            ->where('convert_flg', 1)
            ->where('release_flg', 0)
            ->where('delete_flg', 0)
            ->where('preview_flg', '<', 2)
        ->get();
        $score = $hogehoge->avg('score');
        // $hogehoge = $params->with('object_scores:id,score')->get();
        // $score = $hogehoge->avg('object_scores_count');

        return view('userpages/index', compact('user', 'items','nowtimes','sum','count', 'score'));
    }

}
