@extends('layouts.layout')
@include('layouts.header')

@section('title', '購入済み動画一覧')
@section('keywords', '購入済み動画一覧')
@section('description', '購入済み動画を一覧で確認するページです。')


@section('content')
<section class="py-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4 d-none d-md-block">
                @include('home.sidebar',['type' => 'favorite'])
            </div>
            <div class="col-md-8 p-0">
                <p class="h2 mx-2">お気に入り動画一覧</p>
                @if (count($items) > 0)
                <table class="table table-striped">
                    @foreach($items as $item)
                    <tr>
                        <td class="d-flex align-content-between">
                            <div class="row m-0 w-100">
                                <div class="col-6 col-md-4 my-auto p-0">
                                    <a href="{{ route('item.detail',['id' => $item -> id] ) }}">
                                        <div class="posted_img_box">
                                            @if ($item -> image_path === null)
                                            <img class="posted_img" src="//media.{{config('const.domain')}}/converted_movie/{{ $item -> path }}/{{ $item -> path }}_CMAF.0000000.jpg" alt="">
                                            @else
                                            <img class="posted_img" src="//media.{{config('const.domain')}}/image/{{ $item -> image_path }}" alt="">
                                            @endif
                                        </div>
                                    </a>
                                </div>
                                <div class="col-6 col-md-8 pl-3 my-auto">
                                    <a href="{{ route('item.detail',['id' => $item -> id] ) }}">
                                        <p class="item_box__title clamp2 m-0">{{ $item -> title }}</p>
                                    </a>
                                    <p class="mb-0">
                                        <a class="clamp1" href="{{ route('userpages', ['id' => $item -> user_id]) }}">
                                            <i class="fas fa-user-circle"></i>&nbsp;{{ $item -> user -> nickname }}
                                            @if($item->user->deleted_at !== null)
                                            (退会済)
                                            @endif
                                        </a>
                                    </p>
                                    <div class="text-muted d-flex flex-wrap small">
                                        <p class="text-muted mb-0 mr-2">{{ date('Y-m-d', strtotime($item->created_at)) }}(作成)</p>
                                        @if($item->created_at !== $item->updated_at)
                                        <p class="text-muted mb-0">{{ date('Y-m-d', strtotime($item->updated_at)) }}(更新)</p>
                                        @endif
                                        <p class="mr-3 mb-0">購入人数：{{ $item -> settlements() ->count('id') }}人</p>
                                        @if($item->likes()->where('user_id', Auth::id())->get()->isEmpty())
                                        <p class="favorite-marke mb-0">
                                            <a class="js-like-toggle item_{{$item->id}}" href="" data-itemid="{{ $item->id }}"><i class="fas fa-heart"></i></a>
                                            <span class="likesCount">{{$item->likes()->count()}}</span>
                                        </p>
                                        @else
                                        <p class="favorite-marke mb-0">
                                            <a class="js-like-toggle item_{{$item->id}} loved" href="" data-itemid="{{ $item->id }}"><i class="fas fa-heart"></i></a>
                                            <span class="likesCount">{{$item->likes()->count()}}</span>
                                        </p>
                                        @endif​
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </table>
                <div class="d-flex justify-content-center small">
                    {{ $items->links() }}
                </div>
                <p class="center">合計{{ $items->total() }}件</p>
                @else
                <p>
                    現在購入している動画はありません。
                </p>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection