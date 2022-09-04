<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Contact;
use App\Mail\ContactSendMail;
use Illuminate\Support\Facades\Auth;

use App\Contact as ModelsContact;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $auth = Auth::user();
        return view('contacts.index', ['auth' => $auth]);
    }

    public function confirm(Request $request)
    {
        //バリデーションを実行（結果に問題があれば処理を中断してエラーを返す）
        $request->validate([
            'email' => 'required|email',
            'name' => 'required',
            'comment'  => 'required',
        ]);
        //フォームから受け取ったすべてのinputの値を取得
        $inputs = $request->all();
        $request->session()->regenerateToken();

        //入力内容確認ページのviewに変数を渡して表示
        return view('contacts.confirm', [
            'inputs' => $inputs,
        ]);
    }

    public function thanks(Request $request)
    {

        //フォームから受け取ったactionの値を取得
        $action = $request->input('action');

        //フォームから受け取ったactionを除いたinputの値を取得
        $inputs = $request->except('action');

        //actionの値で分岐
        if ($action !== 'submit') {
            return redirect()
                ->route('contacts.index')
                ->withInput($inputs);
        } else {
            // 二重送信防止
            $request->session()->regenerateToken();

            //入力されたメールアドレスにßメールを送信
            Mail::to($request->email)->send(new ContactSendMail($inputs));

            //管理者へ送信
            Mail::to("manabee.info@gmail.com")->send(new ContactSendMail($inputs));

            // データを保存
            ModelsContact::create($request->all());

            //送信完了ページのviewを表示
            return view('contacts.thanks');

        }

    }
}
