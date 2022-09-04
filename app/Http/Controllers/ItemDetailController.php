<?php

namespace App\Http\Controllers;

use App\Item;
use App\Like;
use App\ObjectScore;
use App\Settlement;
use App\PlayCount;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use Illuminate\Http\Response; //Response::makeのため


class ItemDetailController extends Controller
{
	public function index(Request $request, $id)
	{
		//ここから再生回数
		$ip = $request->ip();
		$user_id = Auth::id();
		$now_date = Carbon::now()->toDateString();
		//ログインしていない場合（当日に同じIPがあるか）
		if ($user_id == null) {
			$count = PlayCount::where('item_id', $id)
				->where('ip_address', $ip)
				->whereDate('created_at', $now_date)
				->get();
			//ログイン済の場合（当日に同じusesr_id or IPがあるか）
		} else {
			$count = PlayCount::where('item_id', $id)
				->whereDate('created_at', $now_date)
				->where(function ($query) use ($user_id, $ip) {
					$query->where('user_id', $user_id)
						->orWhere('ip_address', $ip);
				})
				->get();
		}
		//再生回数保存
		if ($count->isEmpty()) {
			$play_count = new PlayCount;
			$couts['user_id'] = $user_id;
			$couts['item_id'] = $id;
			$couts['ip_address'] = $ip;
			$play_count->fill($couts)->save();
		}
		$item_count = PlayCount::where('item_id', $id)->count();
		//ここまで再生回数

		$object_score = ObjectScore::where('item_id', $id);
		$scores = $object_score
			->latest()
			->paginate(3);
		$obje_score = 0;
		$data = DB::table('object_scores')
			->where('item_id', $id);
		$score_data = $data->whereNotNull('score')->get();
		$obje_score = $data
			->whereNotNull('score')
			->get('score');
		$sum_score = $obje_score->avg('score');

		$movie = Item::findOrFail($id);
		$this_item = $movie['path'];
		$item_imagepath = $movie['image_path'];

		$nowtimes = Carbon::now();
		$scores = ObjectScore::where('item_id', $id)
			->latest()
			->paginate(5);
		// 決済済みもしくは投稿者は、閲覧ページへ遷移
        $settlement = Settlement::where('user_id', Auth::id())
      						  ->where('item_id', $id)
							  ->count();

		if ($settlement === 1 || $movie->user_id === Auth::id() || $movie->free_flg === 1) {
			return redirect()->route('item.view', ['id' => $id]);
		}

		$items = Item::where('user_id', $movie->user_id)
			->where('release_flg', 0)
			->with(['preitem', 'settlements', 'user', 'item_settlements', 'object_scores', 'play_counts'])
			->where('convert_flg', 1)
			->where('release_flg', 0)
			->where('delete_flg', 0)
			->where('preview_flg', '<', 2)
			->wherehas('user', function ($query) {
				$query->where('deleted_at', null);
			})
			->latest()
			->Paginate(4);

		return view('item.detail', compact('this_item', 'movie', 'items', 'nowtimes', 'scores', 'score_data', 'sum_score', 'item_imagepath', 'item_count'));
	}

}
