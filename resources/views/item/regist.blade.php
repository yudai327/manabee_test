@extends('layouts.layout')
@include('layouts.header')

@section('title', '動画投稿')
@section('keywords', '動画投稿')
@section('description', '動画投稿を行います。')

@section('content')
<section class="py-4 content-width">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 p-0">
                <h2 class="center">動画投稿</h2>
                <form action="#" id="regist_form" method="post" enctype="multipart/form-data" name="form">
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <div class="container p-0">
                                <div class="row center  justify-content-center">
                                    <div class="col-12 col-md-8 p-0">
                                        <div class="regist_contents">
                                            <p class="left m-0 text-muted">動画をアップロード</p>
                                            @error('video')
                                            <p class="left small text-danger mb-0">{{$message}}</p>
                                            @enderror
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="customFile" name="video" accept="video/*">
                                                    <label class="custom-file-label left" for="customFile" data-browse="参照">動画選択...</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 p-0">
                                        <div class="regist_contents">
                                            <p class="left m-0 text-muted">サムネイルをアップロード</p>
                                            @error('item_img')
                                            <p class="left small text-danger mb-0">{{$message}}</p>
                                            @enderror
                                            <div class="regist_img_box m-auto mb-1">
                                                <img src="{{ asset(config('const.NO_IMAGE')) }}" id="img_view" class="regist_img mb-2">
                                            </div>
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
                                    </div>
                                    <div class="col-12 col-md-6 p-0 align-self-center">
                                        <div class="regist_contents">
                                            <p class="left m-0 text-muted">タイトル</p>
                                            @error('title')
                                            <p class="left small text-danger mb-0">{{$message}}</p>
                                            @enderror
                                            <input type="text" name="title" value="{{old('title')}}" class="form-control" maxlength="100" placeholder="タイトルを入力する...">
                                        </div>
                                        <div class="regist_contents">
                                            <div class="input-group mb-3">
                                                <input type="checkbox" name="free_flg" id="free_flg" value="1" class="item_free_check">
                                                <label for="free_flg">無料動画<span class="text-muted small">（登録後の変更はできません）</span></label>
                                            </div>
                                        </div>
                                        <div class="regist_contents">
                                            <p class="left m-0 text-muted">価格</p>
                                            @error('price')
                                            <p class="left small text-danger mb-0">{{$message}}</p>
                                            @enderror
                                            <div class="input-group mb-3">
                                                <input type="tel" id="price" name="price" value="{{old('price')}}" class="form-control right" placeholder="(例)2980">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">円</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 p-0">
                                        <div class="regist_contents">
                                            <p class="left m-0 text-muted">説明文</p>
                                            @error('detail')
                                            <p class="left small text-danger mb-0">{{$message}}</p>
                                            @enderror
                                            <textarea name="detail" rows="4" cols="40" maxlength="1000" class="form-control" id="textarea" placeholder="動画の説明を入力する...">{{old('detail')}}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="video_time" value="">
                            <div class="center">
                                <button class="btn btn-primary regist_btn" type="submit" id="regist_btn" value="送信" disabled onclick="return btn_click()">動画を投稿する</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    window.onload = function() {
        // ファイル選択時のイベントを設定
        document.getElementById("customFile").onchange = function(e) {
            $('#regist_btn').attr('disabled', true);
            var file = e.target.files[0];
            // 選択されたファイルをチェック用のメソッドに渡す
            checkVideoDuration(file);
        }
    }

    // 再生時間チェック用メソッド
    var checkVideoDuration = function(file) {
        var video = document.createElement('video');
        var fileURL = URL.createObjectURL(file);
        video.src = fileURL;
        video.ondurationchange = function() {
            document.form.video_time.value = this.duration;
            $('#regist_btn').attr('disabled', false);
            URL.revokeObjectURL(this.src);
        };
    }

    function btn_click() {
        if (confirm('この内容でよろしいですか？')) {
            $('#regist_btn').prop('disabled', true);
            $('#regist_form').submit();
            return true;
        } else {
            return false;
        }
    }
</script>
@endsection
