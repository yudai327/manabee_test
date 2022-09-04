@extends('layouts.layout')
@include('layouts.header')

@section('title', 'アカウント情報の変更')
@section('keywords', 'アカウント情報の変更')
@section('description', 'アカウント情報の変更')


@section('content')
<section class="py-4 content-width">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4 d-none d-md-block">
                @include('home.sidebar',['type' => 'change'])
            </div>
            <div class="col-md-8">
                <h2>アカウント情報の変更</h2>
                <div class="card">
                    <div class="card-body">
                        <div class="contact_form">
                            <!-- フラッシュメッセージ -->
                            @if (session('flash_message'))
                            <div>
                                {{ session('flash_message') }}
                            </div>
                            @endif


                            <div class="form-group">
                                <label for="user_img" class="small text-muted mb-0">ヘッダー画像</label>
                                <div id="user_img">
                                    @if($auth -> user_img_path !== null)
                                    <img src="//media.{{config('const.domain')}}/image/{{ $auth -> user_img_path }}" id="img_view" class="channel_art mb-2">
                                    @else
                                    <img src="{{ asset(config('const.NO_USER_IMAGE')) }}" id="img_view" class="channel_art mb-2">
                                    @endif
                                    <br><a href="{{ route('home.edit', 'user_img') }}" class="text-info">編集</a>
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="name" class="small text-muted mb-0">名前</label>
                                <div id="name">{{$auth->name}}　<a href="{{ route('home.edit', 'name') }}" class="text-info">編集</a></div>
                            </div>
                            <div class="form-group">
                                <label for="nickname" class="small text-muted mb-0">ニックネーム</label>
                                <div id="nickname">{{$auth->nickname}}　<a href="{{ route('home.edit', 'nickname') }}" class="text-info">編集</a></div>
                            </div>
                            <div class="form-group">
                                <label for="detail" class="small text-muted mb-0">紹介文</label>
                                <div id="nickname">
                                    <a class="js-autolink">{{$auth->detail}}</a>　<a href=" {{ route('home.edit', 'detail') }}" class="text-info">編集</a>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email" class="small text-muted mb-0">メールアドレス</label>
                                <div id="email">{{$auth->email}}　<a href="{{ route('home.edit', 'email') }}" class="text-info" class="text-info">編集</a></div>
                            </div>
                            <div class="form-group">
                                <label for="password" class="small text-muted mb-0">パスワード</label>
                                @if(isset($auth->password))
                                <div id="password">パスワードは安全のため表示できません　<a href="{{ route('home.edit', 'password') }}" class="text-info">編集</a></div>
                                @else
                                <div>SNS経由で登録されている為パスワードの変更はできません。</div>
                                @endif
                            </div>
                            <form action="{{ route('home.delete_user') }}" method="POST">
                                @csrf
                                <div>
                                    <button class="btn btn-outline-danger" type="submit" onclick='return confirm("本当に削除しますか。");'>アカウント削除</button>
                                    <p class="text-muted">※アカウントを削除すると今までのデータは全て失われます。<br>
                                        ※削除後、アカウントの再開は不可能となっております。ご注意ください。
                                    </p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
@endsection