@extends('layouts.layout')
@include('layouts.header')

@section('title', $movie -> title)
@section('keywords', $movie -> title)
@section('description', $movie -> title.'|'.$movie ->detail)

@section('og_url', "https://".config('const.domain')."/item/detail/".$movie->id )
@section('og_title', $movie -> title)
@section('og_description', $movie -> detail)

@if ($movie -> image_path === null)
@section('og_image', "https://media.".config('const.domain')."/converted_movie/".$movie -> path."/".$movie -> path."_CMAF.0000000.jpg")
@section('og_tw_image', "https://media.".config('const.domain')."/converted_movie/".$movie -> path."/".$movie -> path."_CMAF.0000000.jpg")
@else
@section('og_image', "https://media.".config('const.domain')."/image/".$movie -> image_path)
@section('og_tw_image', "https://media.".config('const.domain')."/image/".$movie -> image_path)
@endif

@section('content')
<section class="lg-box">
    <div class="bg_dark">
        <div class="container mw-100 m-0 p-0">
            <div class="row justify-content-center m-0 p-md-3 text-light">
                <div class="col-md-6 p-0 m-auto order-12 order-md-1">
                    <div class="px-lg-4 py-lg-2 my-lg-5 mx-2 my-4">
                        <h4 class="font-weight-bold my-3 center h3">{{ $movie -> title}}</h4>
                        <div class="d-flex flex-wrap justify-content-center">
                            <div class="center mx-2 d-flex flex-wrap justify-content-center">
                                <p class="mr-3 mb-0">
                                    作成者：<i class="fas fa-user-circle"></i>
                                    @if($movie->user->deleted_at !== null)
                                    <a class="text-light">退会済ユーザー</a>
                                    @else
                                    <a class="text-light" href="{{ route('userpages', ['id' => $movie -> user_id]) }}">{{ $movie ->user -> nickname}}</a>
                                    @endif
                                </p>
                                <p class="mr-3 mb-0">最終更新日：{{ \Carbon\Carbon::parse($movie->created_at) -> diffForHumans() }}</p>
                                <p class="mr-3 mb-0">視聴回数：{{ $item_count }}回</p>
                                <p class="mr-3 mb-0">購入人数：{{ $movie -> settlements ->count('id') }}人</p>
                                @auth
                                @if($movie->likes()->where('user_id', Auth::id())->get()->isEmpty())
                                <p class="favorite-marke mr-3 mb-0">
                                    <a class="js-like-toggle item_{{$movie->id}} text-light" href="" data-itemid="{{ $movie->id }}"><i class="fas fa-heart"></i></a>
                                    <span class="likesCount">{{$movie->likes()->count()}}</span>
                                </p>
                                @else
                                <p class="favorite-marke mr-3 mb-0">
                                    <a class="js-like-toggle item_{{$movie->id}} text-light loved" href="" data-itemid="{{ $movie->id }}"><i class="fas fa-heart"></i></a>
                                    <span class="likesCount">{{$movie->likes()->count()}}</span>
                                </p>
                                @endif​
                                @endauth
                                @guest
                                <p class="mr-3 mb-0">
                                    <a><i class="fas fa-heart"></i></a>
                                    <span>{{$movie->likes()->count()}}</span>
                                </p>
                                @endguest
                                <div class="d-flex flex-wrap justify-content-center align-items-end">
                                    <span>総合評価：</span>
                                    @if($sum_score !== null)
                                    <a class="p-0 m-0 mr-2">{{round($sum_score, 1)}} </a>
                                    <div class="star-rating">
                                        @if($sum_score !== null)
                                        <div class="star-rating-front" style="width: calc({{$sum_score}} / 5 * 100%)">★★★★★</div>
                                        @endif
                                        <div class="star-rating-back">★★★★★</div>
                                    </div>
                                    <a class="p-0 m-0 mx-2">({{count($score_data)}}件の評価)</a>
                                    @else
                                    <a class="p-0 m-0 mr-3">未評価</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 py-4 px-0 m-auto d-flex align-items-center order-1 order-md-12">
                    <div class="d-flex flex-wrap justify-content-center m-auto">
                        <div class="wrap_video">
                            <video controls crossorigin playsinline id="player">
                                <!-- iOSはネイティブでHLS対応のためsourceを使用。その他はhls.jsで再生。 -->
                                <source src="//media.{{config('const.domain')}}/short_movie/{{$this_item}}/{{$this_item}}.m3u8" type="application/x-mpegURL" size="576" />
                            </video>
                            <p class="mb-0 center small text-muted w-100">プレビュー</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center m-0 mx-md-3">
        <div class="my-3 col-12 col-md-8 px-md-5">
            <div class="m-3 center">
                <p class="h5">価格 <span class="h1">{{ number_format($movie -> price) }}</span>円</p>
                @if($movie->user->deleted_at !== null)
                <a>このユーザーは退会しているため、動画購入できません。</a>
                @elseif($movie->price == 0)
                <a>この動画は無料です。ログインし視聴しましょう。</a>
                @else
                <a href="{{ route('settlement',$movie->id) }}" class="btn btn_color w-75 h2" role="button">動画を購入する</a>
                @endif
            </div>
            <div class="mb-5">
                <div class="center">
                    <p class="share-text">Let's Share the Post!</p>
                </div>
                <div class="center mb-3">
                    @if($movie->user->deleted_at !== null)
                    <a>このユーザーは退会しているため、シェアできません。</a>
                    @else
                    <a href="http://www.facebook.com/share.php?u=https://manabee.shop/item/detail/{{$movie->id}}" rel="nofollow" target="_blank" class="facebook">Facebook</a>
                    <a href="https://twitter.com/intent/tweet?url=https://manabee.shop/item/detail/{{$movie->id}}&text={{$movie -> title}}" class="twitter">Twitter</a>
                    <a class="clipping google" data-clipboard-text='https://manabee.shop/item/detail/{{$movie->id}}'><i class="fa fa-clipboard"></i> URLコピー</a>
                    @endif
                </div>
            </div>
            <div class="m-3">
                <p class="my-3 h2">この動画について</p>
                <div class="m-3">
                    <p class="mb-0">
                        再生時間：{{ $movie -> video_time}}
                    </p>
                    <p class="mb-0">
                        作成日：{{ date("Y/m/d", strtotime($movie -> created_at))}}
                    </p>
                    @if($movie -> created_at !== $movie -> updated_at)
                    <p class="mb-0">
                        更新日：{{ date("Y/m/d", strtotime($movie -> updated_at))}}
                    </p>
                    @endif
                </div>
                <div class="m-3">
                    <p class="mb-2 h4">動画の詳細</p>
                    @if ($movie -> detail !== null)
                    <pre class="text-dark pre_wrap js-autolink motto_text h6 text-muted overflow-hidden" style="height: 30px;">{{ $movie -> detail}}</pre>
                    <div class="motto motto_btn btn btn-outline-primary btn-sm d-block">もっと見る</div>
                    @else
                    <p class="mb-0 text-muted">動画の詳細はありません。</p>
                    @endif
                </div>
                <hr class="m-0">
                <div class="m-3">
                    <p class="mb-2 h4">作成者の詳細</p>
                    <i class="fas fa-user-circle"></i>
                    <a href="{{ route('userpages', ['id' => $movie -> user_id]) }}">{{ $movie ->user -> nickname}}</a>
                    @if($movie->user->deleted_at !== null)
                    <a>(退会済ユーザー)</a>
                    @endif
                    @if ($movie -> user ->detail !== null)
                    <pre class="text-dark pre_wrap js-autolink user_motto_text h6 text-muted overflow-hidden" style="height: 30px;">{{ $movie -> user -> detail}}</pre>
                    <div class="user_motto user_motto_btn btn btn-outline-primary btn-sm d-block">もっと見る</div>
                    @else
                    <p class="mb-0 text-muted">作者の詳細はありません。</p>
                    @endif
                </div>

            </div>
        </div>
        <div class="col-10 col-md-4 bg-white shadow rounded my-3 h_fit">
            <div class="py-2">
                <p class="text-muted mb-0">レビュー</p>
                <hr class="m-0">
                @if (count($scores) > 0)
                @foreach($scores as $score)
                <div class="py-2">
                    <div>
                        <small class="text-muted">
                            <i class="fas fa-user-circle"></i> {{ optional($score -> user) ->nickname}}&nbsp;&nbsp;
                            @if($score->user_id === $movie->user_id)
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
                <div class="d-flex justify-content-center small mt-3">
                    {{ $scores->links() }}
                </div>
                <p class="center small text-muted">レビュー数:{{ $scores->total() }}</p>
                @else
                <p class="text-muted my-3 small">現在この動画のレビューはありません。</p>
                @endif
            </div>

        </div>
    </div>
    <div class="container mt-5">
        @if($movie->user->deleted_at !== null)
        <p class="mt-3 mb-0 center h4">
            退会済のため投稿動画一覧は表示できません
        </p>
        @else
        <p class="mt-3 mb-0 center h4">
            <a href="{{ route('userpages', ['id' => $movie -> user_id]) }}">{{ $movie ->user -> nickname}}</a>の投稿動画一覧
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
        var hls = new Hls({
            autoStartLoad: false
        });
        hls.loadSource("https://media.{{config('const.domain')}}/short_movie/{{ $this_item}}/{{ $this_item }}.m3u8");
        hls.attachMedia(video);
        $('#player').one('play', function() {
            var hls = new Hls();
            hls.loadSource("https://media.{{config('const.domain')}}/short_movie/{{ $this_item }}/{{ $this_item }}.m3u8");
            hls.attachMedia(video);
            hls.startLoad();
            video.play();
        });
    }
    $('#player').attr('poster',
        @if($item_imagepath === null)
        "//media.{{config('const.domain')}}/converted_movie/{{ $this_item }}/{{ $this_item }}_CMAF.0000000.jpg"
        @else "//media.{{config('const.domain')}}/image/{{ $item_imagepath }}"
        @endif
    );
    var player = new Plyr(video, {});
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.4/clipboard.min.js"></script>
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
    .plyr__video-wrapper {
        width: 300px;
        height: calc(300px * 0.5625);
    }

    .plyr__poster {
        width: 100% !important;
        height: 100% !important;
        background-position: center !important;
        background-size: contain !important;
    }

    video[poster] {
        width: 100% !important;
        height: 100% !important;
        background-position: center !important;
        background-size: contain !important;
    }
</style>
@endsection