<?php

namespace App\Http\Controllers;

use App\Item;
use App\Like;
use App\ObjectScore;
use App\Settlement;
use App\PlayCount;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests\ObjectScoreRequest;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class ItemViewController extends Controller
{
	public function index(Request $request, $id)
    {
		//ここから再生回数
		$ip = $request->ip();
		$user_id = Auth::id();
		$now_date = Carbon::now()->toDateString();
		if ($user_id == null) {
			$count = PlayCount::where('item_id', $id)
								->where('ip_address', $ip)
								->whereDate('created_at', $now_date)
								->get();
			//ログイン済の場合（当日に同じusesr_id or IPがあるか）
		} else {
			$count = PlayCount::where('item_id', $id)
								->whereDate('created_at', $now_date)
								->where(function($query) use($user_id,$ip){
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

		$item = Item::findOrFail($id);
		$this_item = $item['path'];
		$item_imagepath = $item['image_path'];
		$nowtimes = Carbon::now();
		$object_score = ObjectScore::where('item_id', $id);
		$scores = $object_score
			->latest()
			->paginate(3);
		$obje_score = 0;
		$obje_score = DB::table('object_scores')
						->where('item_id', $id)
						->whereNotNull('score')
						->get('score');
		$sum_score = $obje_score->avg('score');

		$items = Item::where('user_id', $item->user_id)
			->with(['preitem', 'settlements', 'user', 'item_settlements', 'object_scores', 'play_counts'])
			->where('convert_flg', 1)
			->where('delete_flg', 0)
			->where('release_flg', 0)
			->where('preview_flg', '<', 2)
			->wherehas('user', function ($query) {
				$query->where('deleted_at', null);
			})
			->latest()
			->Paginate(4);

        $settlement = Settlement::where('user_id', Auth::id())
      						  ->where('item_id', $id)
							  ->count();
		if($settlement === 1 || $item->user_id === Auth::id() || $item->free_flg === 1){
			return view('item.view', compact('this_item','item', 'items', 'nowtimes', 'scores', 'obje_score', 'sum_score', 'item_imagepath', 'item_count'));
		}
		return redirect()->route('item.detail', ['id' => $id]);

	}
	public function store(ObjectScoreRequest $request, $id)
	{
		//バリデーションを実行（結果に問題があれば処理を中断してエラーを返す）
		$request->validate([
			'comment'  => 'required|max:1000',
		]);

		$objectScore = new ObjectScore();
		$form['score'] = $request->score;
		$form['comment'] = $request->input('comment');
		$form['user_id'] = Auth::id(); //user_idは、コメント送信者。
		$form['item_id'] = $id; //item_id未実装
		$objectScore->fill($form)->save();

// 追加-------ステータス関係-----
		// コメント入力した際に、"動画投稿者"と"過去にコメントをした人"にお知らせを送る機能
		$now = Carbon::now();
		$item_user_id = DB::table('items')->where('id', $id)->value('user_id');//動画投稿者
		$before_item_user_id = DB::table('object_scores')->where('item_id', $id)//過去にコメントをつけた人
												->groupBy('user_id')
												->pluck('user_id')
												->all();

		$s_user = Auth::id(); //今スコアつけた人・・・オブジェクト
		$i_user = $item_user_id; //動画投稿者・・・オブジェクト
		$b_user = $before_item_user_id; //過去にスコアつけた人・・・配列

		$array_s_user = (array)$s_user;//配列に変換
		$array_i_user = (array)$i_user;//配列に変換

		//過去にスコアをつけた人の中から、今スコアつけた人と動画投稿者を省く
		$comparison_b_s = array_diff($b_user, $array_s_user,$array_i_user);

		//今スコアつけた人と動画投稿者が異なる場合
		if($s_user !== $i_user){
			$push_data2 = ['status' => 2, 'item_id' => $id, 'user_id' => $i_user, 'created_at' => $now, 'updated_at' => $now];
			DB::table('pushes')
				->insert($push_data2);
				//今スコアつけた人と動画投稿者と過去にスコアをつけた人が全て異なる場合
			if (empty($comparison_b_s == false)){
				foreach ($comparison_b_s as $key => $value) {
					$push_data3 = ['status' => 2, 'item_id' => $id, 'user_id' => $value, 'created_at' => $now, 'updated_at' => $now];
					DB::table('pushes')
						->insert($push_data3);
				}
			}
		//今スコアつけた人と動画投稿者が同一の場合
		}else{
			//今スコアつけた人と過去にスコアをつけた人が全て異なる場合
			if (empty($comparison_b_s == false)){
				foreach ($comparison_b_s as $value2) {
					// dd($comparison_b_s,$value2);
					$push_data3 = ['status' => 2, 'item_id' => $id, 'user_id' => $value2, 'created_at' => $now, 'updated_at' => $now];
					DB::table('pushes')
						->insert($push_data3);
				}
		}
	}
// ここまで追加-------ステータス関係-----


		return redirect()->back()->with('success', '投稿が更新されました');
	}

}
