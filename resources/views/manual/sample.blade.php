@extends('layouts.layout')
@include('layouts.header')

@section('title', 'サンプル動画')
@section('keywords', 'サンプル動画')
@section('description', 'サンプル動画を再生するページです。お使いのデバイスで動作確認をお願いします。')

@section('content')

<section class="lg-box py-4 content-width">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4 d-none d-md-block">
                @include('home.sidebar',['type' => 'sample'])
            </div>
            <div class="col-md-8">
                <h2>サンプル動画</h2>
                <p class="mb-0 text-muted">こちらはサンプル動画です。お使いのブラウザで再生可能かお確かめください。</p>
                <div class="w-100 m-auto">
                    <video controls crossorigin playsinline id="player">
                        <!-- iOSはネイティブでHLS対応のためsourceを使用。その他はhls.jsで再生。 -->
                        <source src="//media.{{config('const.domain')}}/converted_movie/1239/1239.m3u8" type="application/x-mpegURL" size="576" />
                    </video>
                </div>
                <p class="mb-0 text-muted">※再生されない場合はお使いのブラウザでは、manabeeの動画を視聴することができませんのでご注意ください。</p>

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