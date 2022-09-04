@section('script')
<script src="https://cdn.jsdelivr.net/npm/hls.js@latest"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/plyr/3.3.6/plyr.min.js"></script>

<script type="text/javascript">
    var video = document.querySelector('video');
    if (Hls.isSupported()) {
        //iOS以外はtrue =MSEをサポート
        var hls = new Hls();
        hls.loadSource('https://media.manabee.shop/converted_movie/{{ $item -> path }}/{{ $item -> path }}.m3u8');
        hls.attachMedia(video);
    };
    var player = new Plyr(video, {});
</script>
@overwrite
@yield('script')