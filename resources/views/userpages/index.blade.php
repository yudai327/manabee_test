@extends('layouts.layout')
@include('layouts.header')

@section('title', $user -> nickname)
@section('keywords', $user -> nickname)
@section('description', $user -> nickname .'|'.$user -> detail)

@section('content')
<!-- ここにコンテンツ入力 -->
<div class="d-flex">
    @if($user -> user_img_path !== null)
    <img src="//media.{{config('const.domain')}}/image/{{ $user -> user_img_path }}" id="img_view" class="channel_art mb-2">
    @else
    <img src="{{ asset(config('const.NO_USER_IMAGE')) }}" id="img_view" class="channel_art mb-2">
    @endif
</div>
<section class="py-4 content-width">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8">
                <p class="center h2"><i class="fas fa-user-circle"></i> {{ $user -> nickname }}
                    @if($user->deleted_at !== null)
                    <a>(退会済ユーザー)</a>
                    @endif
                    様</p>
                <div class="row justify-content-around center my-3">
                    <div class="col-8 col-md-3 card p-0 mb-2">
                        <div class="card-body">
                            <p class="text-muted">動画登録数</p>
                            <p class=" h2">{{ $count }}</p>
                        </div>
                    </div>
                    <div class="col-8 col-md-3 card p-0 mb-2">
                        <div class="card-body">
                            <p class="text-muted">動画販売数</p>
                            <p class="h2">{{ $sum }}</p>
                        </div>
                    </div>
                    <div class="col-8 col-md-3 card p-0 mb-2">
                        <div class="card-body">
                            <p class="text-muted">総合評価</p>
                            @if($score !== null)
                            <p class="h2">{{ round($score, 1) }}</p>
                            @else
                            <p class="h4">未評価</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-8">

                @if ($user -> detail != null)
                <p class="text-muted m-0 center">紹介文</p>
                <pre class="pre_wrap js-autolink">{{ $user -> detail }}</pre>
                @else
                <div class="center my-3 text-muted">
                    紹介文は設定していません。
                </div>
                @endif
            </div>
        </div>
    </div>
    <div class="container mt-3">
        @if($user->deleted_at !== null)
        <p class="mt-3 mb-0 center h4">
            退会済のため投稿動画一覧は表示できません
        </p>
        @else
        <p class="mb-0 center h4">{{ $user -> nickname }}の投稿動画一覧</p>
        <div class="row">
            @if (count($items) > 0)
            @foreach($items as $item)
            @include('layouts.item')
            @endforeach
            @else
            <div class="col-12 col-md-8 center my-3 text-muted">
                投稿中の動画はありません。
            </div>
            @endif
        </div>
        <div class="d-flex justify-content-center small">
            <p>{{ $items->links() }}</p>
            </p>
        </div>
        <p class="center">合計{{ $items->total() }}件</p>
        @endif
    </div>
</section>
@endsection