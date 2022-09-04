@extends('layouts.layout')
@include('layouts.header')

@section('title', '会員登録')
@section('keywords', '会員登録')
@section('description', '会員登録ページです。')


@section('content')
<section class="py-4 content-width">
    <div class="contact_form">
        <h2 class="center my-5">新規会員登録</h2>
        <div class="card">
            <img class="w-100" src="{{asset(config('const.step1'))}}" alt="ステップ1">
            <div class="social-btn px-2">
                <a href="{{ url('login/facebook') }}" class="text-center btn btn-primary btn-block w-100 my-4"><i class="fab fa-facebook"></i><b>Facebook</b>アカウントで登録</a>
                <a href="{{ url('login/twitter') }}" class="text-center btn btn-info btn-block w-100 my-4 text-white"><i class="fab fa-twitter"></i><b>Twitter</b>アカウントで登録</a>
                <a href="{{ url('login/google') }}" class="text-center btn btn-danger btn-block w-100 my-4"><i class="fab fa-google"></i><b>Google</b>アカウントで登録</a>
            </div>
            <div class="or-seperator"><i>or</i></div>
            <div class="card-body">
                <h4 class="center">メールアドレスから会員登録</h4>
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="form-group">
                        <label for="name" class="mb-0">名前<span class="badge badge-success ml-2">必須</span></label>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="例）田中太郎" value="{{ old('name') }}" required autocomplete="name" autofocus>

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">

                        <label for="nickname" class="mb-0">ニックネーム<span class="badge badge-success ml-2">必須</span></label>
                        <input id="nickname" type="text" class="form-control @error('nickname') is-invalid @enderror" name="nickname" placeholder="例）マナビー" 　value="{{ old('nickname') }}" required autocomplete="nickname" autofocus>

                        @error('nickname')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email" class="mb-0">メールアドレス<span class="badge badge-success ml-2">必須</span></label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="PC・携帯どちらでも可" value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password" class="mb-0">パスワード<span class="badge badge-success ml-2">必須</span></label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="8文字以上１６文字以内の半角英数字" required autocomplete="new-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">

                        <label for="password-confirm" class="mb-0">パスワード（確認用）<span class="badge badge-success ml-2">必須</span></label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="8文字以上１６文字以内の半角英数字" required autocomplete="new-password">
                    </div>
                    <br>
                    <div class="form-group center">
                        <button type="submit" class="btn btn-primary w_100">登録</button>
                    </div>
                </form>
                <div class="w-100 mx-auto mt-3 row">
                    <p class="small mb-0 mx-auto">※こちら↓↓↓の動画がお使いのブラウザで再生可能かお試しください。</p>
                    <div class="col-md-6 col-12 mx-auto">
                        <video controls crossorigin playsinline id="player">
                            <!-- iOSはネイティブでHLS対応のためsourceを使用。その他はhls.jsで再生。 -->
                            <source src="//media.{{config('const.domain')}}/converted_movie/1239/1239.m3u8" type="application/x-mpegURL" size="576" />
                        </video>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    var video = document.querySelector('video');
    if (Hls.isSupported()) {
        //iOS以外はtrue =MSEをサポート
        var hls = new Hls();
        hls.loadSource("https://media.{{config('const.domain')}}/converted_movie/1239/1239.m3u8");
        hls.attachMedia(video);
    };
    var player = new Plyr(video, {});
</script>

@endsection