@extends('layouts.layout')
@include('layouts.header')

@section('title', 'ログインページ')
@section('keywords', 'ログイン')
@section('description', 'ログイン')

@section('content')
<section class="py-4 content-width">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2 class="center">ログイン</h2>

                <div class="card">
                    <a class="btn btn-link" href="{{ route('register') }}">
                        はじめての方はこちら<br>（新規無料会員登録）
                    </a>

                    <div class="social-btn">
                        <a href="{{ url('login/facebook') }}" class="text-center btn btn-primary btn-block"><i class="fab fa-facebook"></i> Sign in with <b>Facebook</b></a>
                        <a href="{{ url('login/twitter') }}" class="text-center btn btn-info btn-block text-white"><i class="fab fa-twitter"></i> Sign in with <b>Twitter</b></a>
                        <a href="{{ url('login/google') }}" class="text-center btn btn-danger btn-block"><i class="fab fa-google"></i> Sign in with <b>Google</b></a>
                    </div>
                    <div class="or-seperator"><i>or</i></div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="login" class="col-sm-4 col-form-label text-md-right"><small>ニックネームorメールアドレス</small></label>

                                <div class="col-md-6">
                                    <input id="login" type="text" class="form-control{{ $errors->has('login') ? ' is-invalid' : '' }}" name="login" value="{{ old('login') }}" required autofocus>

                                    @if ($errors->has('login'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('login') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right"><small>パスワード</small></label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            次から入力を省略
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        ログイン
                                    </button>

                                    @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        パスワードを忘れた場合はこちら
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection