<div class="col-6 col-sm-4 col-md-4 item_box p-1">
    <div class="center position-relative">
        <a class="a_link" href="{{ route('item.detail', ['id' => $item -> id]) }}">
            <div class="top_img_box">
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
                <a href="{{ route('userpages', ['id' => $item -> user_id]) }}">
                    <span class="clamp1"><i class="fas fa-user-circle"></i>&nbsp;{{ $item -> user -> nickname }}</span>
                </a>
                <div class="d-flex flex-wrap">
                    <p class="mr-2 mb-0">{{ $item -> play_counts ->count('id') }}回視聴</p>
                    <p class="mr-2 mb-0">{{ $item -> created_at ->diffForHumans($nowtimes) }}</p>
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
            </small>
        </div>
        <div class="d-flex flex-wrap align-items-end">
            @if($item -> item_settlements ->where('settlement_user_id', Auth::id())->count() == 0)
            @if($item -> user_id !== Auth::id())
            <p class="m-0">{{ number_format($item -> price) }}円 </p>
            @else
            <p class="m-0 small text-muted">あなたの投稿動画</p>
            @endif
            @else
            <p class="m-0 small text-muted">購入済み動画</p>
            @endif
        </div>
    </div>
</div>