@extends('layouts.layout')
@include('layouts.header')

@section('title', $item -> title)
@section('keywords', $item -> title)
@section('description', $item -> title.'|'.$item -> detail)

@section('og_url', "https://".config('const.domain')."/item/view/".$item->id )
@section('og_title', $item -> title)
@section('og_description', $item -> detail)

@if ($item -> image_path === null)
@section('og_image', "https://media.".config('const.domain')."/converted_item/".$item -> path."/".$item -> path."_CMAF.0000000.jpg")
@section('og_tw_image', "https://media.".config('const.domain')."/converted_movie/".$item -> path."/".$item -> path."_CMAF.0000000.jpg")
@else
@section('og_image', "https://media.".config('const.domain')."/image/".$item -> image_path)
@section('og_tw_image', "https://media.".config('const.domain')."/image/".$item -> image_path)
@endif

@section('content')
<section class="lg-box">
    <div class="container mw-100 m-0 p-0">
        <div class="row justify-content-center m-0">
            <div class="col-lg-9 p-0">
                <video controls crossorigin playsinline id="player">
                    <!-- iOSはネイティブでHLS対応のためsourceを使用。その他はhls.jsで再生。 -->
                    <source src="//media.{{config('const.domain')}}/converted_movie/{{ $item -> path }}/{{ $item -> path }}.m3u8" type="application/x-mpegURL" size="576" />
                    <p>お使いのブラウザは、対応していません。</p>
                </video>
                <div class="col-12 px-md-5 my-3">
                    <div class="px-4 py-2">
                        <h3>{{ $item -> title}}</h3>
                        <div class="d-flex flex-wrap justify-content-start text-muted">
                            <p class="mr-3 mb-0">視聴回数：{{ $item_count }}回</p>
                            <p class="mr-3 mb-0">購入人数：{{ $item -> settlements ->count('id') }}人</p>
                            @auth
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
                            @endauth
                            @guest
                            <p class="mb-0">
                                <a><i class="fas fa-heart"></i></a>
                                <span>{{$item->likes()->count()}}</span>
                            </p>
                            @endguest
                        </div>
                        <div class="d-flex flex-wrap justify-content-start text-muted">
                            <p class="mr-3 mb-0">作成日：{{ $item->created_at->format('Y/m/d') }}</p>
                            <p class="mb-0">更新日：{{ $item->updated_at->format('Y/m/d') }}</p>
                        </div>
                    </div>
                    <hr class="m-0 px-4">
                    <p class="m-3 h4">この動画について</p>
                    <div class="px-4 py-2">
                        @if ($item -> detail !== null)
                        <p class="mb-2 h4">動画の詳細</p>
                        <pre class="m-0 pre_wrap js-autolink motto_text h6 text-muted overflow-hidden" style="height: 30px;">{{ $item -> detail}}</pre>
                        <div class="motto motto_btn btn btn-outline-primary btn-sm d-block">もっと見る</div>
                        @else
                        <p class="text-muted mb-0">動画の詳細はありません。</p>
                        @endif
                    </div>
                    <hr class="m-0">
                    <div class="px-4 py-2">
                        <p class="mb-2 h4">作成者の詳細</p>
                        <i class="fas fa-user-circle"></i>
                        <a href="{{ route('userpages', ['id' => $item -> user_id]) }}">{{ $item ->user -> nickname}}</a>
                        @if($item->user->deleted_at !== null)
                        <a>(退会済ユーザー)</a>
                        @endif
                        @if ($item -> user -> detail !== null)
                        <p class="small text-muted mb-0">紹介文</p>
                        <pre class="pre_wrap js-autolink user_motto_text h6 text-muted overflow-hidden" style="height: 30px;">{{ $item -> user -> detail}}</pre>
                        <div class="user_motto user_motto_btn btn btn-outline-primary btn-sm d-block">もっと見る</div>
                        @else
                        <p class="text-muted mb-0">紹介文は設定していません。</p>
                        @endif
                    </div>
                    <hr class="m-0">
                </div>
            </div>
            <div class="col-12 col-sm-8 col-md-6 col-lg-3 p-0 mt-3">
                <div class="px-4 py-2">
                    <div class="center">
                        <h4>視聴者からの総合評価</h4>
                        <div class="d-flex m-auto all_score">
                            @if($sum_score !== null)
                            <span class="h2">{{round($sum_score, 1)}} </span>
                            <div class="star-rating">
                                @if($sum_score !== null)
                                <div class="star-rating-front h2" style="width: calc({{$sum_score}} / 5 * 100%)">★★★★★</div>
                                @endif
                                <div class="star-rating-back h2">★★★★★</div>
                            </div>
                            @else
                            <p>未評価</p>
                            @endif
                        </div>
                    </div>
                    @auth
                    @error('comment')
                    <p class="left small text-danger mb-0">{{$message}}</p>
                    @enderror
                    <form method="post" action="{{ route('item.view', ['id' => $item -> id]) }}">
                        @csrf
                        <div class="card">
                            @if($obje_score->isEmpty('score') ===true)
                            @if($item->user_id !== Auth::id())
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
                            @endif
                            @endif
                            <div class="card-footer text-muted">
                                <textarea id="comment" type="text" name="comment" class="item_rv_t_area mb-sm w_100 text-input" rows="4" maxlength="200" placeholder="ここにレビューを記入する"></textarea>
                                <button type="submit" id="text-submit" class="btn btn_color w_100">送信</button>
                            </div>
                        </div>
                    </form>
                    @endauth
                </div>
                <div class="px-4 py-2">
                    @foreach($scores as $score)
                    <div class="px-4 py-2">
                        <div>
                            <small class="text-muted">
                                <i class="fas fa-user-circle"></i> {{ optional($score -> user) ->nickname}}&nbsp;&nbsp;
                                @if($score->user_id === $item->user_id)
                                <span class="badge badge-info text-light">投稿者</span>&nbsp;&nbsp;
                                @endif
                                {{ \Carbon\Carbon::parse($score->created_at) -> diffForHumans() }}
                            </small>
                        </div>
                        @if($score -> score != null)
                        <div>
                            <div class="star-rating">
                                <div class="star-rating-front" style="width: calc({{$score->score}} / 5 * 100%)">★★★★★</div>
                                <div class="star-rating-back">★★★★★</div>
                            </div>
                        </div>
                        @endif
                        <div>
                            <pre class="m-0 pre_wrap js-autolink">{{ $score -> comment }}</pre>
                        </div>
                    </div>
                    <hr class="m-0">
                    @endforeach
                </div>
                <div class="d-flex justify-content-center small">
                    {{ $scores->links() }}
                </div>
            </div>
        </div>
        <div class="row justify-content-center mx-0">
            <div class="center">
                <p class="share-text">Let's Share the Post!</p>
                <div class="center mb-3">
                    @if($item->user->deleted_at !== null)
                    <a>このユーザーは退会しているため、シェアできません。</a>
                    @else
                    <a href="http://www.facebook.com/share.php?u=https://manabee.shop/item/detail/{{$item->id}}" rel="nofollow noopener noreferrer" target="_blank" class="facebook">Facebook</a>
                    <a href="https://twitter.com/intent/tweet?url=https://manabee.shop/item/detail/{{$item->id}}&text={{$item -> title}}" rel="nofollow noopener noreferrer" target="_blank" class="twitter">Twitter</a>
                    <a class="clipping google" data-clipboard-text='https://manabee.shop/item/detail/{{$item->id}}'><i class="fa fa-clipboard"></i> URLコピー</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        @if($item->user->deleted_at !== null)
        <p class="mt-3 mb-0 center h4">
            退会済のため投稿動画一覧は表示できません
        </p>
        @else
        <p class="my-5 center h4">
            <a href="{{ route('userpages', ['id' => $item -> user_id]) }}">{{ $item ->user -> nickname}}</a> の動画</p>
        </p>
        <div class="row">
            @foreach($items as $item)
            @include('layouts.item')
            @endforeach
        </div>
        <div class="d-flex justify-content-center small">
            {{ $items->links() }}
        </div>
        <p class="center">合計{{ $items->total() }}件</p>
        @endif
    </div>
</section>

<script type="text/javascript">
    var video = document.querySelector('video');
    if (Hls.isSupported()) {
        //iOS以外はtrue =MSEをサポート
        var hls = new Hls({
            autoStartLoad: false
        });
        hls.loadSource("https://media.{{config('const.domain')}}/converted_movie/{{ $this_item }}/{{ $this_item }}.m3u8");
        hls.attachMedia(video);
        $('#player').one('play', function() {
            var hls = new Hls();
            hls.loadSource("https://media.{{config('const.domain')}}/converted_movie/{{ $this_item }}/{{ $this_item }}.m3u8");
            hls.attachMedia(video);
            hls.startLoad();
            video.play();
        });
    };
    $('#player').attr('poster',
        @if($item_imagepath === null)
        "//media.{{config('const.domain')}}/converted_movie/{{ $this_item }}/{{ $this_item }}_CMAF.0000000.jpg"
        @else "//media.{{config('const.domain')}}/image/{{ $item_imagepath }}"
        @endif
    );
    var player = new Plyr(video, {});
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var cp = new ClipboardJS('.clipping');
        cp.on("success", function(e) {
            alert("URLをコピーしました。");
        });

        // コピーした時にアラートを表示する (失敗時)
        cp.on("error", function(e) {
            alert("失敗しました…");
        });
    });
</script>
<script>
    const element = document.querySelector('.motto');
    var motto_text = document.querySelector('.motto_text');
    element.addEventListener('click', function() {
        if ($(this).hasClass('motto_btn')) {
            var motto = document.querySelector('.motto_btn');
            motto_text.style.height = '100%';
            motto.innerHTML = '表示を減らす';
            motto.classList.replace('motto_btn', 'dis_motto');
        } else {
            motto_text.style.height = '30px';
            element.innerHTML = 'もっと見る';
            element.classList.replace('dis_motto', 'motto_btn');
        }
    });
</script>
<script>
    const userElement = document.querySelector('.user_motto');
    var useMotto_text = document.querySelector('.user_motto_text');
    userElement.addEventListener('click', function() {
        if ($(this).hasClass('user_motto_btn')) {
            var userMotto = document.querySelector('.user_motto_btn');
            useMotto_text.style.height = '100%';
            userMotto.innerHTML = '表示を減らす';
            userMotto.classList.replace('user_motto_btn', 'user_dis_motto');
        } else {
            useMotto_text.style.height = '30px';
            userElement.innerHTML = 'もっと見る';
            userElement.classList.replace('user_dis_motto', 'user_motto_btn');
        }
    });
</script>

<style type="text/css">
</style>



@endsection