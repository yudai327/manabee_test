@extends('layouts.layout')
@include('layouts.header')

@section('title', 'ユーザー情報変更')
@section('keywords', 'ユーザー情報変更')
@section('description', 'ユーザー情報変更')


@section('content')
<section class="py-4 content-width">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4 d-none d-md-block">
                @include('home.sidebar',['type' => 'change'])
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">ユーザー情報変更</div>

                    <div class="card-body">
                        <div class="contact_form">

                            @if ($page == 'user_img')
                            <form action="{{ route('home.update', $auth->id)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <!-- <input type="hidden" name="_method" value="PUT"> -->
                                <input type="hidden" name="page" value="user_img">
                                <div class="form-label small text-muted mb-0">ヘッダー画像</div>
                                <div class="input-group mb-3">
                                    @if($auth->user_img_path === null)
                                    <img src="{{ asset(config('const.NO_USER_IMAGE')) }}" id="img_view" class="channel_art mb-2">
                                    @else
                                    <img src="//media.{{config('const.domain')}}/image/{{ $auth -> user_img_path }}" id="img_view" class="channel_art mb-2">
                                    @endif
                                    <div class="container d-flex justify-content-center">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" type="file" id="file_img" name="user_img" accept="image/*" value="{{old('movie')}}" aria-describedby="button-addon2">
                                            <label class="custom-file-label left" for="file_img" data-browse="参照">画像選択...</label>
                                        </div>
                                    </div>
                                    <div class="mx-auto my-3 center">
                                        <p class="small text-muted">※推奨サイズ：1500（横）×500（縦）px</p>
                                        <button type="submit" class="btn btn-outline-secondary" id="button-addon2">編集</button>
                                    </div>
                                </div>
                            </form>
                            @endif


                            @if ($page == 'name')
                            <form action="{{ route('home.update', $auth->id)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <!-- <input type="hidden" name="_method" value="PUT"> -->
                                <input type="hidden" name="page" value="name">
                                <div class="form-label small text-muted mb-0">名前</div>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="name" value="{{$auth->name}}" aria-describedby="button-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="submit" id="button-addon2">編集</button>
                                    </div>
                                </div>
                            </form>
                            @endif
                            @if ($page == 'nickname')
                            <form action="{{ route('home.update', $auth->id)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <!-- <input type="hidden" name="_method" value="PUT"> -->
                                <input type="hidden" name="page" value="nickname">
                                <div class="form-label small text-muted mb-0">ニックネーム</div>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="nickname" value="{{$auth->nickname}}" aria-describedby="button-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="submit" id="button-addon2">編集</button>
                                    </div>
                                </div>
                            </form>
                            @endif
                            @if ($page == 'detail')
                            <form action="{{ route('home.update', $auth->id)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <!-- <input type="hidden" name="_method" value="PUT"> -->
                                <input type="hidden" name="page" value="detail">

                                <div class="form-label small text-muted mb-0">自己紹介</div>
                                <div class="input-group mb-3">
                                    <textarea class="w-100 form-control" rows="8" type="text" name="detail" value="{{$auth->detail}}" placeholder="{{$auth->detail}}">{{$auth->detail}}</textarea>
                                </div>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary mx-auto" type="submit" id="button-addon2">編集</button>
                                </div>
                            </form>
                            @endif


                            <!-- フラッシュメッセージ -->
                            @if (session('flash_message'))
                            <div class="text-success">
                                {{ session('flash_message') }}
                            </div>
                            @endif

                            @if ($page == 'email')
                            <div>
                                @if ($errors->has('new_email'))
                                    {{ $errors->first('new_email') }}
                                @endif
                                <div class="form-label small text-muted mb-0">メールアドレス変更</div>
                                <small>※新規メールアドレスを入力してください</small>
                                <form action="/email" method="POST">
                                    @csrf
                                    <div class="input-group mb-3">
                                        <input type="email" class="form-control" name="new_email" aria-describedby="button-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" type="submit" id="button-addon2">編集</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            @endif

                            @if ($page == 'password')

                            <form action="/changepassword" method="POST">
                                @csrf
                                <p class="small text-muted mb-0">現在のパスワード</p>
                                <div class="input-group mb-3">
                                    <input type="password" class="form-control" name="current-password" required autofocus>
                                </div>
                                @if ($errors->has('new-password'))
                                <p class="text-danger">{{ $errors->first('new-password') }}</p>
                                @endif
                                <p class="small text-muted mb-0">新しいパスワード</p>
                                <div class="input-group mb-3">
                                    <input type="password" class="form-control" name="new-password" placeholder="8文字以上16文字以内の半角英数字" maxlength="16" required>
                                </div>
                                <p class="small text-muted mb-0">新しいパスワード(確認)</p>
                                <div class="input-group mb-3">
                                    <input type="password" class="form-control" name="new-password_confirmation" placeholder="8文字以上16文字以内の半角英数字" maxlength="16" required>
                                </div>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary mx-auto" type="submit">編集</button>
                                </div>

                            </form>


                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
