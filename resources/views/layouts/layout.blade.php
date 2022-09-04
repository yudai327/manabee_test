<!DOCTYPE HTML>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />

    <!-- ファビコン -->
    <link rel="icon" href="{{ asset('/favicon.ico') }}">

    <!-- スマホ用アイコン -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset(config('const.favicon_png')) }}">


    <meta name="twitter:card" content="summary_large_image">
    @hasSection('top')
    <meta property="og:type" content="@yield('top')">
    @else
    <meta property="og:type" content="artcle">
    @endif

    @hasSection('title')
    <meta name="title" itemprop="title" content="manabee|@yield('title')">
    @else
    <meta name="title" itemprop="title" content="manabee|”教え合うを最高の学びに”">
    @endif

    @hasSection('description')
    <meta name="description" itemprop="description" content="@yield('description')">
    @else
    <meta name="description" content="「教えるがいちばんの学びへ」学ぶ・教える・自分に返ってくる。医療特化型オンライン動画学習プラットフォーム。">
    @endif

    @hasSection('keywords')
    <meta name="keywords" itemprop="keywords" content="@yield('keywords'),manabee,マナビー,教え合う,動画投稿,医療特化型オンライン,動画学習プラットフォーム">
    @else
    <meta name="keywords" itemprop="keywords" content="manabee,マナビー,教え合う,動画投稿">
    @endif

    <meta property="og:site_name" content="manabee|”教え合うを最高の学びに”" />

    @hasSection('og_url')
    <meta property="og:url" content="@yield('og_url')" />
    @else
    <meta property="og:url" content="{{ request()->fullUrl() }}" />
    @endif

    @hasSection('og_title')
    <meta property="og:title" content="@yield('og_title')" />
    @else
    <meta property="og:title" content="manabee|”教え合うを最高の学びに”">
    @endif

    @hasSection('og_description')
    <meta property="og:description" content="@yield('og_description')" />
    @else
    <meta property="og:description" content="「教えるがいちばんの学びへ」学ぶ・教える・自分に返ってくる。医療特化型オンライン動画学習プラットフォーム。">
    @endif

    @hasSection('og_image')
    <meta property="og:image" content="@yield('og_image')">
    @else
    <meta property="og:image" content="{{asset(config('const.LOGO'))}}">
    @endif

    @hasSection('og_tw_image')
    <meta name="twitter:image" content="@yield('og_tw_image')">
    @else
    <meta name="twitter:image" content="{{asset(config('const.LOGO'))}}">
    @endif

    <!-- ↓↓↓↓↓↓検索されない設定↓↓↓↓↓↓ -->
    <meta name="robots" content="{{config('const.meta_robots')}}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-1.6.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/hls.js/latest/hls.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/plyr/3.3.6/plyr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.4/clipboard.min.js"></script>

    <script src="{{ mix('js/app.js') }}" defer></script>
    <script src="{{ mix('js/util.js') }}" defer></script>


    <!-- Fonts -->
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <!-- <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> -->

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP&family=Oswald:wght@400;700&display=swap" rel="stylesheet">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ mix('css/style.css') }}">

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/plyr/3.3.6/plyr.css" />

    @if(config('const.domain') == 'manabee.shop')
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-177214819-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-177214819-1');
    </script>
    @endif

</head>

<body>
    @yield('header')
    <main class="mb-5 ">
        @yield('content')
    </main>

    <footer class="footer">
        <div class="footer__container">
            @auth
            <div class="footer__item">
                <a href="{{ url('/') }}">
                    <div class="footer__icon">
                        <i class="fas fa-home"></i>
                    </div>
                    <span>ホーム</span>
                </a>
            </div>
            <div class="footer__item">
                <a href="{{ route('PostMovie', ['id' => Auth::id()]) }}">
                    <div class="footer__icon">
                        <i class="fas fa-list-alt"></i>
                    </div>
                    <span>投稿動画</span>
                </a>
            </div>
            <div class="footer__item">
                <a href="{{ route('PurchasedMovie', ['id' => Auth::id()]) }}">
                    <div class="footer__icon">
                        <i class="fas fa-play-circle"></i>
                    </div>
                    <span>購入済み</span>
                </a>
            </div>
            <div class="footer__item">
                <a href="{{ route('favoritedMovie', ['id' => Auth::id()]) }}">
                    <div class="footer__icon">
                        <i class="far fa-star"></i>
                    </div>
                    <span>お気に入り</span>
                </a>
            </div>
            <div class="footer__item">
                <a href="{{ route('home') }}">
                    <div class="footer__icon">
                        <i class="far fa-user-circle"></i>
                    </div>
                    <span>マイページ</span>
                </a>
            </div>
            @endauth
            @guest
            <div class="footer__item">
                <a href="{{ url('/') }}">
                    <div class="footer__icon">
                        <i class="fas fa-home"></i>
                    </div>
                    <span>ホーム</span>
                </a>
            </div>
            <div class="footer__item">
                <a href="{{ route('item.regist') }}">
                    <div class="footer__icon">
                        <i class="fas fa-video"></i>
                    </div>
                    <span>投稿</span>
                </a>
            </div>
            <div class="footer__item">
                <a href="{{ route('register') }}">
                    <div class="footer__icon">
                        <i class="fas fa-users"></i> </div>
                    <span>新規登録</span>
                </a>
            </div>
            <div class="footer__item">
                <a href="{{ route('login') }}">
                    <div class="footer__icon">
                        <i class="fas fa-sign-in-alt"></i> </div>
                    <span>ログイン</span>
                </a>
            </div>
            @endguest
        </div>
    </footer>

</body>

</html>