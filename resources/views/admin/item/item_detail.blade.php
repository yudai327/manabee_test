@extends('layouts.admin')

@section('content')

<div class="container">
    <div class="card">
        <div class="card-header">
            <a href="{{ url('admin/item_list') }}">投稿動画一覧</a> &gt; 投稿動画詳細
        </div>
        <div class="card-body">
            <table class="table table-hover">
                <tr>
                    <td>タイトル</td>
                    <td>{{ $item->title }}</td>
                </tr>
                <tr>
                    <td>作者</td>
                    <td>{{ $item->user->nickname }}</td>
                </tr>
            </table>
        </div>
    </div>
    <div class="w-100">
        <video controls crossorigin playsinline id="player">
            <!-- iOSはネイティブでHLS対応のためsourceを使用。その他はhls.jsで再生。 -->
            <source src="//media.{{config('const.domain')}}/converted_movie/{{ $item -> path }}/{{ $item -> path }}.m3u8#t=0,3" type="application/x-mpegURL" size="576" />
            <p>お使いのブラウザは、対応していません。</p>
        </video>
    </div>

</div>
<script type="text/javascript">
    var video = document.querySelector('video');
    if (Hls.isSupported()) {
        //iOS以外はtrue =MSEをサポート
        var hls = new Hls();
        hls.loadSource("https://media.{{config('const.domain')}}/converted_movie/{{ $item -> path }}/{{ $item -> path }}.m3u8");
        hls.attachMedia(video);
    };
    var player = new Plyr(video, {});
</script>

@endsection