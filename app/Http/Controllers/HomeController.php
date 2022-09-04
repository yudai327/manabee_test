<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Push;
use App\Item;
use Carbon\Carbon;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
        public function index(Request $request)
    {
        $user = Auth::user();
        $id = $user->id;
        $params = Item::where('user_id', $id)
            ->orderBy('created_at', 'desc')
            ->with(['preitem', 'settlements', 'user', 'item_settlements', 'object_scores', 'play_counts'])
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
        return view('home.index', compact('user', 'items', 'nowtimes', 'sum', 'count', 'score'));
    }

    public function push(Request $request)
    {
        $auth = Auth::user();
        $user = new User();
        $items = $user->where('id', $auth->id)->get();

        $user_id = Auth::id();
        $nowtimes = Carbon::now();

        $u_pushes = Push::with(['item', 'reads'])
            ->where('user_id', $user_id)
            ->where('status', '>', 0)
            ->orderBy('created_at', 'desc')
            ->simplePaginate( 10, ["*"], 'itempage')
            ->appends(["userpage" => $request->input('userpage')]);

        $m_pushes = Push::with(['item', 'reads'])
            ->where('status', 0)
            ->Where(function ($query) {
                $query->orwhere('user_id',null)
                    ->orwhere('user_id', Auth::id());
            })
            ->orderBy('created_at', 'desc')
            ->simplePaginate( 10, ["*"], 'userpage')
            ->appends(["itempage" => $request->input('itempage')]);

            return view('home.push', compact('auth', 'items','nowtimes','u_pushes', 'm_pushes'));
    }
    public function change()
    {
        $auth = Auth::user();
        $user = new User();
        $items = $user->where('id', $auth->id)->get();
        return view('home.change', ['auth' => $auth], ['items' => $items]);
    }
    public function useredit($page)
    {
        $auth = Auth::user();
        return view('home.edit', ['auth' => $auth, 'page' => $page]);
    }


    public function update(Request $request, $id)
    {

        // 選択ページ情報取得
        $page = $request->page;
        // 選択ページでバリデーションを選ぶ
        if ($page == 'name') {
            $rule = User::$editNameRules;
        } elseif ($page == 'nickname') {
            $rule = User::$editNicknameRules;
        } elseif ($page == 'detail') {
            $rule = User::$editDetailRules;
        } elseif ($page == 'user_img') {
            $now = Carbon::now();
            $day = $now->format('Y-m-d-Hisu');

            $rule = User::$editUserImageRules;
        }

        // バリデーションチェック
        $this->validate($request, $rule);
        // 対象レコード取得
        $auth = User::find($id);
        // リクエストデータ受取
        $form = $request->all();

        // ユーザーヘッダー画像の場合の処理
        if($page == 'user_img'){
        $item_img = $request->file('user_img');
        $file_name = 'user-img'.'-'.$id.'-'.$day;
            if (!empty($item_img)) {

        $form['user_img_path'] = $file_name . "." . $item_img->getClientOriginalExtension();
        Storage::disk('s3')->putFileAs('image', $item_img, $form['user_img_path'], 'public');
            }
        }

        // フォームトークン削除(user_imgあれば削除)
        unset($form['_token']);
        unset($form['user_img']);

        // ページ情報削除
        unset($form['page']);
        // レコードアップデート
        $auth->fill($form)->save();

        return redirect()->route('change');

    }
    public function AuthRouteAPI(Request $request)
    {
        return $request->user();
    }

    public function deleteUser()
    {
        $user_id = Auth::id();
        $user = User::find($user_id);
        $user->deleted_at = Carbon::now();
        $user->email = $user->email . '.delete.manabee.user' . $user->deleted_at;
        $user->password = '';
        $user->save();
        Auth::logout();


        return view('home.thanks');
    }


}
