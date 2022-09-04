<?php

namespace App\Http\Controllers;

use App\Item;
use App\Http\Requests\ItemRequest;
use App\Http\Requests\EditItemRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;


class ItemRegistController extends Controller
{
	public function index()
    {
        return view('item.regist');
    }

	public function post(ItemRequest $request)
    {
		$form = $request->all();
		$form['user_id'] = Auth::id();
		$item_img = $request->file('item_img');
		$video = $request->file('video');
		$now = Carbon::now();
		$day_nam = $now->format('Y-m-d-Hisu');
		$file_name = $form['user_id'] . "-" . $day_nam;
		$form['path'] = $file_name;
		$form['release_flg'] = 0;
		$form['convert_flg'] = 0;
		$form['delete_flg'] = 0;
		$form['video_time'] = date('H:i:s', $request->input('video_time')+ 54000);//+9時間を修正
		//無料フラグ判定
		if(isset($form['free_flg'])){
			$form['price'] = 0;
		}else{
			$form['price'] = $request->input('price');
		}

		//ファイル保存
		if(!empty($item_img)){
			$form['image_path'] = $file_name.".".$item_img->getClientOriginalExtension();
			Storage::disk('s3')->putFileAs('image', $item_img, $form['image_path'], 'public');
		}
		if (!empty($video)) {
			$form['video_path'] = $file_name . "." . $video->getClientOriginalExtension();
			Storage::disk('s3')->putFileAs('original_movie', $video, $form['video_path'], 'public');
		}

		//db保存
		$item = new Item;
		unset($form['_token']);
		unset($form['item_img']);
		unset($form['video']);
		$item->fill($form)->save();

		// 二重送信防止
		$request->session()->regenerateToken();

		$message = "動画の投稿が完了致しました。動画が反映されるまで数分程度かかります。反映されない場合は、マイページのお問い合わせフォームからご連絡お願いいたします。";
        return view('message.index', compact('message'));
	}

	public function edit($id)
	{
		$item = Item::find($id);

		return view('item.edit', compact('item'));
	}

	public function update(EditItemRequest $request)
	{
		$id = $request->id;
		$item = Item::find($id);
		$form = $request->all();
		$form['user_id'] = Auth::id();
		$item_img = $request->file('item_img');
		$now = Carbon::now();
		$day_nam = $now->format('Y-m-d-Hisu');
		$file_name = $form['user_id'] . "-" . $day_nam;
		if($form['img'] === "1"){
			if($item_img !== null){
				$form['image_path'] = $file_name . "." . $item_img->getClientOriginalExtension();
				Storage::disk('s3')->putFileAs('image', $item_img, $form['image_path'], 'public');
			}
		}else{
			$form['image_path'] = null;
		}
		$form['title'] = $request->input('title');
		$form['detail'] = $request->input('detail');
		//		$form['price'] = $request->input('price');

		if($request->input('release_flg') !== "0"){
			$release_flg = 1;
		}else{
			$release_flg = 0;
		}
		$form['release_flg'] = $release_flg;

		//db保存
		unset($form['_token']);
		unset($form['item_img']);
		$item->fill($form)->save();

		return redirect()->route('PostMovie', ['id' => Auth::id()]);
	}


	public function delete(Request $request)
	{
		$item = Item::find($request->id);
		$form['delete_flg'] = $request->input('delete_flg');
		$item->fill($form)->save();

		return redirect()->route('PostMovie', ['id' => Auth::id()]);
	}

}
