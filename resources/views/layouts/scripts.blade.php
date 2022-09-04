@section('script')
<script src="https://cdn.jsdelivr.net/npm/hls.js@latest"></script>

<script>
    var video = document.getElementById('video');
    var videoSrc = 'https://media.manabee.shop/converted_movie/{{ $item -> path }}/{{ $item -> path }}.m3u8';
    if (Hls.isSupported()) {
        var hls = new Hls();
        hls.loadSource(videoSrc);
        hls.attachMedia(video);
        hls.on(Hls.Events.MANIFEST_PARSED, function() {
            video.play();
        });
    } else if (video.canPlayType('application/vnd.apple.mpegurl')) {
        video.src = videoSrc;
        video.addEventListener('loadedmetadata', function() {
            video.play();
        });
    }
</script>
@yield('script')