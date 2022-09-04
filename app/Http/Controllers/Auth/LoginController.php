<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Socialite;
use Auth;
use App\User;
use Carbon\Carbon;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * ログイン時の認証項目
     *
     * @return string
     */
    public function username()
    {
        return 'login';
    }

    /**
     * ログイン認証
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function attemptLogin(Request $request)
    {
        $username = $request->input($this->username());
        $password = $request->input('password');

        if (filter_var($username, \FILTER_VALIDATE_EMAIL)) {
            $credentials = ['email' => $username, 'password' => $password];
        } else {
            $credentials = ['nickname' => $username, 'password' => $password];
        }
        return $this->guard()->attempt($credentials, $request->filled('remember'));
    }

    /**
     * OAuth認証の結果受け取り
     *
     * @param str $provider
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback(Request $request, $provider)
    {
        try {
            $providerUser = Socialite::driver($provider)->user();

        } catch (\Exception $e) {
            return redirect('/login')->with('oauth_error', '予期せぬエラーが発生しました');
        }
        if ($email = $providerUser->getEmail()) {

            // email が合致するユーザーを取得
            $user = User::where('email', $providerUser->email)->first();
            $now = Carbon::now();
            // 見つからなければ新しくユーザーを作成
            if ($user == null) {
                Auth::login(User::firstOrCreate([
                    'name' => $providerUser->getName(),
                    'email' => $email,
                    'nickname' => $providerUser->getName(),
                    'email_verified_at' => $now,
                    $provider.'_id' => $providerUser->getId(),
                ]));
                return redirect($this->redirectTo);
            }
            // ログイン処理
            Auth::login($user, true);
            return redirect($request->session()->get('url.intended'));
        } else {
            return redirect('/login')->with('oauth_error', 'メールアドレスが取得できませんでした');
        }
    }

    /**
     * OAuth認証先にリダイレクト
     *
     * @param str $provider
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider($provider)
    {
        return \Socialite::driver($provider)->redirect();
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        if (array_key_exists('HTTP_REFERER', $_SERVER)) {
            $path = parse_url($_SERVER['HTTP_REFERER']); // URLを分解
            if (array_key_exists('host', $path)) {
                if ($path['host'] == $_SERVER['HTTP_HOST']) { // ホスト部分が自ホストと同じ
                    session(['url.intended' => $_SERVER['HTTP_REFERER']]);
                }
            }
        }
        return view('auth.login');
    }
}
