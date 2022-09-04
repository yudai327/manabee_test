@extends('layouts.layout')
@include('layouts.header')

@section('title', '投稿動画一覧')
@section('keywords', '投稿動画一覧')
@section('description', 'あなたが投稿した動画を一覧で確認できるページです。')


@section('content')
<section class="py-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4 d-none d-md-block">
                @include('home.sidebar',['type' => 'post'])
            </div>
            <div class="col-md-8 p-0">
                <p class="h2 mx-2">投稿動画一覧</p>
                @if (count($items) > 0)
                <table class=" table table-striped small">
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
                                    <p class="my-1 d-flex align-items-end">
                                        <span class="h6 m-0">{{ number_format($item -> price) }}円&nbsp;&nbsp;</span>
                                        @if($item -> preitem !== null)
                                        <span class="m-0 small text-muted">プレビュー</span>
                                        @endif
                                        @if($item -> release_flg === 0)
                                        <span class="badge badge-primary">公開中</span>
                                        @else($item -> release_flg === 1)
                                        <span class="badge badge-secondary">非公開</span>
                                        @endif
                                        @if($item -> convert_flg === 0)
                                        <span class="badge badge-secondary">未変換</span>
                                        @endif
                                    </p>
                                    <div class="d-flex flex-wrap">
                                        <p class="text-muted mb-0 mr-2">{{ date('Y-m-d', strtotime($item->created_at)) }}(作成)</p>
                                        @if($item->created_at !== $item->updated_at)
                                        <p class="text-muted mb-1">{{ date('Y-m-d', strtotime($item->updated_at)) }}(更新)</p>
                                        @endif
                                    </div>

                                    <form method="post" action="{{ route('item.delete') }}">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$item -> id}}">
                                        <button type="button" onclick="location.href='{{ route('item.edit', ['id' => $item -> id]) }}'" class="text-white btn btn-info px-2 mx-1 py-0">編集</button>
                                        <button type="submit" name="delete_flg" value="1" class="btn btn-danger px-2 mx-1 py-0" onclick='return confirm("本当に削除しますか？");'>削除</button>
                                    </form>
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
                    現在投稿されている動画はありません。
                </p>
                @endif
            </div>
        </div>
    </div>

</section>
@endsection