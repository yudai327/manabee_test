@extends('layouts.layout')
@include('layouts.header')

@section('title', 'お知らせ通知')
@section('keywords', 'お知らせ通知')
@section('description', 'お知らせ通知')


@section('content')
<section class="py-4 content-width">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4 d-none d-md-block">
                @include('home.sidebar',['type' => 'push'])
            </div>
            <div class="col-md-8">
                <h2>お知らせ通知</h2>
                <div class="bg-white shadow">
                    <div class="p-0">

                        <!-- タブ部分 -->
                        <ul id="myTab" class="nav nav-tabs" role="tablist">
                            <li class="nav-item w-50 center" role="presentation">
                                <a href="#home" id="home-tab" class="nav-link active" role="tab" data-toggle="tab" aria-controls="home" aria-selected="true">あなたへのお知らせ<span class="badge badge-pill badge-light p-0">{{count($u_pushes)}}</span></a>
                            </li>
                            <li class="nav-item w-50 center" role="presentation">
                                <a href="#profile" id="profile-tab" class="nav-link" role="tab" data-toggle="tab" aria-controls="profile" aria-selected="false">manabeeからのお知らせ<span class="badge badge-pill badge-light p-0">{{count($m_pushes)}}</span></a>
                            </li>
                        </ul>

                        <!-- パネル部分 -->
                        <div id="myTabContent" class="tab-content mt-0">
                            <div id="home" class="tab-pane active" role="tabpanel" aria-labelledby="home-tab">
                                @foreach($u_pushes as $push)
                                @if($push->status == 0)
                                @elseif($push->status == 1)
                                <a class="dropdown-item write_space_normal w-100 py-2" href="{{ route('item.detail', ['id' => $push -> item_id]) }}"><span class="font-weight-bold">{{ $push->item->title }}</span>の購入が完了しました。<br>{{ $push -> created_at ->diffForHumans($nowtimes) }}</a>
                                <div class="dropdown-divider m-0"></div>
                                @elseif($push->status == 2)
                                <a class="dropdown-item write_space_normal w-100 py-2" href="{{ route('item.detail', ['id' => $push -> item_id]) }}"><span class="font-weight-bold">{{ $push->item->title }}</span>にコメントされました。<br>{{ $push -> created_at ->diffForHumans($nowtimes) }}</a>
                                <div class="dropdown-divider m-0"></div>
                                @elseif($push->status == 3)
                                <a class="dropdown-item write_space_normal w-100 py-2" href="{{ route('item.detail', ['id' => $push -> item_id]) }}"><span class="font-weight-bold">{{ $push->item->title }}</span>が購入されました。<br>{{ $push -> created_at ->diffForHumans($nowtimes) }}</a>
                                <div class="dropdown-divider m-0"></div>
                                @endif
                                @endforeach
                                {{ $u_pushes->links() }}
                            </div>
                            <div id="profile" class="tab-pane" role="tabpanel" aria-labelledby="profile-tab">
                                @foreach($m_pushes as $push)
                                @if($push->status == 0 && ($push->user_id == null || $push->user_id == Auth::id()) )
                                <a class="dropdown-item write_space_normal w-100 py-2" href="#">
                                    <span class="pre_wrap">{{ $push->comment }}</span><br>{{ $push -> created_at ->diffForHumans($nowtimes) }}</a>
                                <div class="dropdown-divider m-0"></div>
                                @elseif($push->status == 1)
                                @elseif($push->status == 2)
                                @elseif($push->status == 3)
                                @endif
                                @endforeach
                                {{ $m_pushes->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
@endsection