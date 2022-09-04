@extends('layouts.layout')
@include('layouts.header')

@section('title', '投稿動画の編集')
@section('keywords', '投稿動画の編集')
@section('description', '投稿動画の編集を行います。')


@section('content')
<section class="py-4 content-width">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4 d-none d-md-block">
                @include('home.sidebar',['type' => 'regist'])
            </div>
            <div class="col-md-8">
                <h2>投稿動画の編集</h2>

                <form action="{{ route('item.update') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-body p-0">
                            <div class="container">
                                <div class="row center justify-content-center">
                                    <div class="col-12 align-self-center p-0">
                                        <div class="regist_contents">
                                            <p class="left m-0 text-muted pb-0 mt-3">使用するサムネイルをチェックして選択</p>
                                            @error('item_img')
                                            <p class="left small text-danger mb-0">{{$message}}</p>
                                            @enderror
                                            <div class="container">
                                                <div class="row center justify-content-center">
                                                    <div class="col-6 p-0">
                                                        <p class="small text-muted mb-0">動画から作成</p>
                                                        <label>
                                                            <input type="radio" name="img" value=0 class="radio" @if($item -> image_path === null) checked="checked" @endif>
                                                            <img class="edit_img radio_image" src="//media.{{config('const.domain')}}/converted_movie/{{ $item -> path }}/{{ $item -> path }}_CMAF.0000000.jpg" alt="">
                                                        </label>
                                                    </div>
                                                    @if ($item -> image_path === null)
                                                    <div class="col-6 p-0">
                                                        <p class="small text-muted mb-0">ユーザーが作成</p>
                                                        <label>
                                                            <input type="radio" name="img" value=1 class="radio">
                                                            <img id="img_view" class="edit_img radio_image" src="{{ asset(config('const.NO_IMAGE')) }}">
                                                        </label>
                                                    </div>
                                                    @else
                                                    <div class="col-6 p-0">
                                                        <p class="small text-muted mb-0">投稿したサムネイル</p>
                                                        <label>
                                                            <input type="radio" name="img" value=1 class="radio" checked="checked">
                                                            <img id="img_view" class="edit_img radio_image" src="//media.{{config('const.domain')}}/image/{{ $item -> image_path }}" alt="">
                                                        </label>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <p class="left mt-2 m-0 text-muted">サムネイルをアップロード</p>
                                            <div class="d-flex justify-content-center">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" type="file" id="file_img" name="item_img" accept="image/*" value="{{old('movie')}}">
                                                    <label class="custom-file-label left" for="file_img" data-browse="参照">画像選択...</label>
                                                </div>
                                                <div class="input-group-append">
                                                    <button type="button" class="btn btn-outline-secondary" id="img_del" value="{{ asset(config('const.NO_IMAGE')) }}"><i class="far fa-trash-alt"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="regist_contents">
                                            <p class="left m-0 text-muted">タイトル</p>
                                            @error('title')
                                            <p class="left small text-danger mb-0">{{$message}}</p>
                                            @enderror
                                            <input type="text" name="title" value="{{$item->title}}" maxlength="100" class="form-control">
                                        </div>
                                        <div class="regist_contents">
                                            <p class="left m-0 text-muted">価格</p>
                                            @error('price')
                                            <p class="left small text-danger mb-0">{{$message}}</p>
                                            @enderror
                                            @if ($item -> free_flg !== 1)
                                            <div class="input-group mb-3">
                                                <input type="tel" name="price" value="{{$item->price}}" class="form-control right" placeholder="(例)2980">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">円</span>
                                                </div>
                                            </div>
                                            @else
                                            無料動画のため、価格設定はありません。
                                            @endif
                                        </div>
                                        <div class="regist_contents">
                                            <p class="left m-0 text-muted">説明文</p>
                                            @error('detail')
                                            <p class="left small text-danger mb-0">{{$message}}</p>
                                            @enderror
                                            <textarea name="detail" rows="4" cols="40" maxlength="1000" class="form-control" id="textarea" placeholder="動画の説明を入力する...">{{$item->detail}}</textarea>
                                        </div>
                                        <div class="regist_contents">
                                            <div class="switchArea">
                                                <input type="checkbox" id="switch1" name="release_flg" value="0" @if($item -> release_flg === 0) checked @endif>
                                                <label for="switch1"><span></span></label>
                                                <div id="swImg"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="center">
                                <input type="hidden" name="free_flg" value="{{$item -> free_flg}}">
                                <input type="hidden" name='id' value="{{$item -> id}}">
                                <input type="hidden" name='user_id' value="{{Auth::id()}}">
                                <button class="btn btn-primary regist_btn" type="submit" value="送信" onclick="return(confirm('この変更内容でよろしいですか？'))">変更を更新する</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection