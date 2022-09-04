@extends('layouts.layout')
@include('layouts.header')

@section('top',"website")
@section('content')
<div class="pb-4 content-width">
    <section id="content">
        @if($search == null)
        <div class="my-5">
            <p class="h4 center">「教え合う」を最高の学びに</p>
        </div>
    </section>
    <hr class="hr_dot">
    <section>
        <div>
            <h2>最近の動画</h2>
            <p>お気に入りの動画を見つけましょう</p>
        </div>
        <div class="container">
            <div class="row">
                @foreach($items as $item)
                @include('layouts.item')
                @endforeach
            </div>
        </div>
    </section>
    <hr class="hr_dot">
    <section>
        <div>
            <h2>人気の動画</h2>
            <p>お気に入りの動画を見つけましょう</p>
        </div>
        <div class="container">
            <div class="row">
                @foreach($up_items as $item)
                @include('layouts.item')
                @endforeach
            </div>
        </div>
    </section>
    <hr class="hr_dot">
    <section>
        <div class="container">
            <div class="result_users">
                <div class="row">
                    @foreach($rand_items as $item)
                    @include('layouts.item')
                    @endforeach
                </div>
                <div class="d-flex justify-content-center small">
                    {{ $rand_items->links() }}
                </div>
            </div>
        </div>
    </section>
    @else
    <section>
        <div class="container">
            <div class="center">
                <hr class="hr_dot">
                <div class="my-3">
                    <h2>検索結果</h2>
                    @if(count($s_items) !== 0)
                    <p class="center">
                        キーワード: {{$search}}
                    </p>
                    <p class="center text-muted">" {{$search}} "に関連した動画が{{ $s_items->total() }}件見つかりました。</p>
                    <p>検索数：{{ $s_items->total() }}件</p>
                    @else
                    <p>キーワード: {{$search}}</p>
                    <p class="center text-muted">" {{$search}} "を検索しましたが、一致した動画は見つかりませんでした。</p>
                    <p class="center text-muted">
                        キーワードを変えて検索してみましょう。
                    </p>
                    @endif
                </div>
                <hr class="hr_dot">
            </div>
            <div class="row">
                @foreach($s_items as $item)
                @include('layouts.item')
                @endforeach
            </div>
            <div class="d-flex justify-content-center small">
                {{ $s_items->links() }}
            </div>
        </div>
    </section>
    @if(count($s_items) !== 0)
    <hr class="hr_dot">
    @endif
    <section>
        <div>
            <p class="mb-0">こちらは、現在manabeeで人気の動画です。こちらの動画もみてみましょう。</p>
        </div>
        <div class="container">
            <div class="row">
                @foreach($up_items as $item)
                @include('layouts.item')
                @endforeach
            </div>
            <div class="d-flex justify-content-center small">
                {{ $up_items->links() }}
            </div>
        </div>
    </section>
</div>
@endif
@endsection