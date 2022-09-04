<div class="col-6 col-sm-3 col-md-3 item_box p-1">
    <div class="center">
        <a class="a_link" href="{{ route('item.detail', ['id' => $item -> id]) }}">
            <div class="top_img_box position-relative">
                @if ($item -> image_path === null)
                <img class="top_img" src="//media.{{config('const.domain')}}/converted_movie/{{ $item -> path }}/{{ $item -> path }}_CMAF.0000000.jpg" alt="">
                @else
                <img class="top_img" src="//media.{{config('const.domain')}}/image/{{ $item -> image_path }}" alt="">
                @endif
                <div class="video_time">{{$item -> video_time}}</div>
            </div>
        </a>
    </div>
    <div class="item_box__inner">
        <div class="d-block">
            <a class="a_link" href="{{ route('item.detail', ['id' => $item -> id]) }}">
                <p class="item_box__title clamp2 m-0">{{ $item -> title }}</p>
            </a>
        </div>
        <div class="d-block">
            <small class="item_box__name">
                <a class="clamp1" href="{{ route('userpages', ['id' => $item -> user_id]) }}">
                    <span><i class="fas fa-user-circle"></i>&nbsp;{{ $item -> user -> nickname }}</span>
                </a>
                <div class="d-flex flex-wrap">
                    <p class="mr-2 mb-0">{{ $item -> play_counts ->count('id') }}回視聴</p>
                    <p class="mr-2 mb-0">{{ $item -> created_at ->diffForHumans($nowtimes) }}</p>
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
                    <a><i class="fas fa-heart"></i></a>
                    <span>{{$item->likes()->count()}}</span>
                    @endguest
                </div>

            </small>
        </div>
        <div class="d-flex flex-wrap align-items-end">
            @if($item -> item_settlements ->where('settlement_user_id', Auth::id())->count() == 0)
            @if($item -> user_id !== Auth::id())
            <span class="mr-2">{{ number_format($item -> price) }}円</span>
            @else
            <span class="mr-2 small text-muted">あなたの投稿動画</span>
            @endif
            @else
            <span class="mr-2 small text-muted">購入済み動画</span>
            @endif
            @if($item->object_scores->avg('score') != 0)
            <span>
                <div class="d-flex flex-wrap align-items-end">
                    <span class="text-secondary">{{ round($item->object_scores->avg('score'), 1) }}</span>
                    <div class="star-rating-item">
                        <div class="star-rating-front" style="width: calc({{$item->object_scores->avg('score')}} / 5 * 100%)">★★★★★</div>
                        <div class="star-rating-back">★★★★★</div>
                    </div>
                    <span class="small text-muted">({{ count($item->object_scores->whereNotNull('score')) }})</span>
                </div>
            </span>
            @endif
        </div>
    </div>
</div>