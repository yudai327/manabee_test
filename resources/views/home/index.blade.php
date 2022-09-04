@extends('layouts.layout')
@include('layouts.header')

@section('title', 'マイページ')
@section('keywords', 'マイページ')
@section('description', 'マイページ')


@section('content')
<section class="py-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4 d-none d-md-block">
                @include('home.sidebar',['type' => 'home'])
            </div>
            <div class="col-md-8 p-0">
                <div class="d-flex">
                    @if($user -> user_img_path !== null)
                    <img src="//media.{{config('const.domain')}}/image/{{ $user -> user_img_path }}" id="img_view" class="channel_art mb-2">
                    @else
                    <img src="{{ asset(config('const.NO_USER_IMAGE')) }}" id="img_view" class="channel_art mb-2">
                    @endif
                </div>
                <div class="container">
                    <div class="container-fluid">
                        <div class="row justify-content-center align-items-center my-3">
                            <div class="col-12 col-md-6">
                                <p class="center h2"><i class="fas fa-user-circle"></i><br>{{ $user -> nickname }}</p>
                            </div>
                            <div class="col-12 col-md-6 center">
                                <p class="text-muted">動画登録数 <span class="text-success h3">{{ $count }}</span></p>
                                <p class="text-muted">動画販売数 <span class="text-success h3">{{ $sum }}</p>
                                <p class="text-muted">
                                    総合評価
                                    @if($score !== null)
                                    <span class="text-success h3">{{ round($score, 1) }}</span>
                                    @else
                                    <span>未評価</span>
                                    @endif
                                </p>
                            </div>

                            <div class="col-12 col-md-12">
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
                </div>
                <div class="d-block d-md-none bg-white small">
                    <table class="center w-100 table table-bordered">
                        <tr>
                            <td class="w-50 py-2 px-1 align-middle">
                                <a class="m-1 my-auto" href="{{ route('contacts.index') }}">お問い合わせ</a>
                            </td>
                            <td class="w-50 py-2 px-1 align-middle">
                                <a class="m-1" href="{{ route('privacy') }}">プライバシーポリシー</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="w-50 py-2 px-1 align-middle">
                                <a class="m-1" href="{{ route('terms') }}">ご利用規約</a>
                            </td>
                            <td class="w-50 py-2 px-1 align-middle">
                                <a class="m-1" href="{{ route('transaction') }}">特定商取引に関する表記</a>
                            </td>
                        </tr>
                        </tr>
                    </table>
                </div>
                <div class="container mt-3">
                    <p class="mb-0 center h4">{{ $user -> nickname }}の投稿動画一覧</p>
                    <div class="row">
                        @if (count($items) > 0)
                        @foreach($items as $item)
                        @include('layouts.home_item')
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
                </div>
            </div>
        </div>
    </div>
</section>
@endsection