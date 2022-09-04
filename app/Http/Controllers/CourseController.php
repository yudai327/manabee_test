<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ObjectScore;
use App\Item;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;



class CourseController extends Controller
{
    //コースページのコントローラー
    public function index($id)
    {
        $items = Item::all()->where('id', $id);
        $scores = ObjectScore::where('item_id', $id)
        ->latest()
        ->paginate(5);
        $nowtimes = Carbon::now();

        return view('course/index', ['items' => $items], ['scores' => $scores], ['nowtimes' => $nowtimes]);
    }

    public function store(Request $request, $id)
    {
        $objectScore = new ObjectScore();
        $form['score'] = $request->score;
        $form['comment'] = $request->comment;
        $form['user_id'] = Auth::id(); //user_idは、コメント送信者。
        $form['item_id'] = $id; //item_id未実装
        $form['reply_id'] = 1;//reply_id未実装。これはitem所有者？
        $objectScore->fill($form)->save();

        return redirect()->back()->with('success', '投稿が更新されました');
    }
}
