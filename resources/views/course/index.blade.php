@extends('layouts.layout')
@include('layouts.header')

@section('title', 'コース詳細')
@section('keywords', 'A,B,C')
@section('description', 'コースの詳細を表示します。')
@section('head_title', 'コース名')

@section('content')
<section class="py-4 content-width">
    {{-- 投稿完了時にフラッシュメッセージを表示 --}}
    @if(Session::has('success'))
    <div class="bg-info">
        <p>{{ Session::get('success') }}</p>
    </div>
    @endif
    <div class="container">
        <div class="row">
            @foreach($items as $item)
            <div class="col-md-6">


                <div class="card">
                    <img src="{{ asset('images/image-1.jpg') }}" alt="">
                    <div class="card-body">
                        <h5 class="card-title">{{ $item -> title}}</h5>
                        <p class="card-text">
                            <a href="{{ route('userpages', ['id' => $item -> user_id]) }}">{{ $item ->user -> nickname}}</a>
                            <small class="text-muted">{{ \Carbon\Carbon::parse($item->created_at) -> diffForHumans() }}</small>
                        </p>
                        <p class="card-text">
                            <span>カテゴリー</span>
                            <span>筋肉</span>
                            <span>筋肉</span>
                            <span>筋肉</span>
                            <span>筋肉</span>
                        </p>
                        <p class="card-text">
                            {{ $item -> detail}}
                        </p>
                    </div>
                </div>
                <div class="sosyal center">
                    <a href="http://www.facebook.com/share.php?u={{url()->full()}}" rel="nofollow" target="_blank" class="facebook">Facebook</a>
                    <a href="#" class="twitter">Twitter</a>
                    <a href="#" class="google">Google+</a>
                </div>
            </div>
            <div class="col-md-6">
                <div>
                    <p>〇〇円</p>
                    <button class="btn btn-primary w_100">購入</button>
                </div>
                <div>
                    @auth
                    <form method="post" action="{{ route('course', ['id' => $item -> id]) }}">
                        @csrf
                        <div class="card">
                            <div class="card-header text-center">
                                レビューを書く
                            </div>
                            <div class="card-body">
                                <div class="evaluation">
                                    <input id="star1" type="radio" name="score" value="5">
                                    <label for="star1"><span class="text">最高</span>★</label>
                                    <input id="star2" type="radio" name="score" value="4" />
                                    <label for="star2"><span class="text">良い</span>★</label>
                                    <input id="star3" type="radio" name="score" value="3" />
                                    <label for="star3"><span class="text">普通</span>★</label>
                                    <input id="star4" type="radio" name="score" value="2" />
                                    <label for="star4"><span class="text">悪い</span>★</label>
                                    <input id="star5" type="radio" name="score" value="1" />
                                    <label for="star5"><span class="text">最悪</span>★</label>
                                </div>
                            </div>
                            <div class="card-footer text-muted">
                                <textarea id="comment" type="text" name="comment" class="item_rv_t_area mb-sm w_100" placeholder="ここにレビューを記入する"></textarea>
                                <button type="submit" class="btn btn-primary w_100">送信</button>
                            </div>
                        </div>
                    </form>
                    @endauth
                </div>
                <div>
                    @foreach($scores as $score)
                    <table>
                        <tr>
                            @if($score -> score != null)
                            <td>
                                <div class="star-rating">
                                    <div class="star-rating-front" style="width: calc({{$score->score}} / 5 * 100%)">★★★★★</div>
                                    <div class="star-rating-back">★★★★★</div>
                                </div>
                            </td>
                            @endif
                        </tr>
                        <tr>
                            <td><small class="text-muted">{{ optional($score -> user) ->nickname}}　{{ \Carbon\Carbon::parse($score->created_at) -> diffForHumans() }}</small></td>
                        </tr>
                        <tr>
                            <td>{{ $score -> comment }}</td>
                        </tr>
                    </table>
                    <hr>
                    @endforeach
                </div>
                {{ $scores->links() }}
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection