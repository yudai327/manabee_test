@section('header')
<nav class="navbar navbar-expand-xl navbar-light sticky-top shadow-sm">
    <div class="container d-flex">
        <!-- <a class="navbar-brand flex-fill" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a> -->
        <a class="navbar-brand flex-fill mr-0" href="{{ url('/') }}">
            <img class="head_logo" src="{{ asset(config('const.LOGO')) }}" alt="manabee">
        </a>
        <div class="d-none d-sm-inline-block flex-fill">
            <form method="GET" action="{{ route('index') }}">
                @csrf
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="キーワードを入力する" @if(isset($search)) value="{{$search}}" @endif>
                    <span class="input-group-btn">
                        <button class="btn btn_search btn_round" type="submit">
                            <i class="fas fa-search"></i> </button>
                    </span>
                </div>
            </form>

        </div>

        <div class="ml-auto text-right flex-fill">
            <div class="d-sm-none d-inline-block">
                <a type="button" class="navbar-text h4 p-0 mb-0 center text-dark btn-reset" data-toggle="modal" data-target="#exampleModal">
                    <i class="fas fa-search pb-0"></i>
                    <p class="p-0 m-0 header_font">検索</p>
                </a>

                <!-- モーダルの設定 -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h2 class="h2 modal-title" id="exampleModalLabel">動画を検索する</h2>
                                <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="GET" action="{{ route('index') }}">
                                    @csrf
                                    <div class="input-group">
                                        <input type="text" name="search" class="form-control" placeholder="キーワードを入力する" @if(isset($search)) value="{{$search}}" @endif>
                                        <span class="input-group-btn">
                                            <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                        </span>
                                    </div>
                                </form>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
            </div>

            <a class="navbar-text ml-3 h4 p-0 mb-0 center text-dark" href="{{ route('item.regist') }}">
                <i class="fas fa-video pb-0"></i>
                <p class="p-0 m-0 header_font">動画投稿</p>
            </a>
            @guest
            @if (Route::has('register'))
            <a class="navbar-text ml-2 h4 p-0 mb-0 center text-dark" href="{{ route('login') }}">
                <i class="nav-link fas fa-sign-in-alt pb-0"></i>
                <p class="p-0 m-0 header_font">ログイン</p>
            </a>
            <a id="1navbarDropdown" class="nav-link h_circle h4 m-0 p-0 text-dark" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                <i class="fa-lg fas fa-bars"></i>
                <p class="p-0 m-0 header_font">メニュー</p>
            </a>

            <div class="dropdown-menu dropdown-menu-right p-0 m-0" aria-labelledby="1navbarDropdown">
                <a class="dropdown-item py-3 px-5" href="{{ route('sample') }}">サンプル動画</a>
                <div class="dropdown-divider m-0"></div>
                <a class="dropdown-item py-3 px-5" href="{{ route('faq') }}">よくある質問</a>
                <div class="dropdown-divider m-0"></div>
                <a class="dropdown-item py-3 px-5" href="{{ route('contacts.index') }}">お問い合わせ</a>
                <div class="dropdown-divider m-0"></div>
                <a class="dropdown-item py-3 px-5" href="{{ route('privacy') }}">プライバシーポリシー</a>
                <div class="dropdown-divider m-0"></div>
                <a class="dropdown-item py-3 px-5" href="{{ route('terms') }}">ご利用規約</a>
                <div class="dropdown-divider m-0"></div>
                <a class="dropdown-item py-3 px-5" href="{{ route('transaction') }}">特定商取引に関する表記</a>
                <div class="dropdown-divider m-0"></div>
            </div>
            @endif
            @else
            <div class="navbar-text dropdown ml-3 p-0">
                <a class="nav-link h4 m-0 p-0 center text-dark" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="far fa-bell pb-0"></i><span class="badge badge-pill badge-light p-0" id="count"></span>
                    <p class="p-0 m-0 header_font">お知らせ</p>
                </a>
                <div class="dropdown-menu dropdown-menu-right p-0 m-0 header_push" aria-labelledby="navbarDropdown">
                    @foreach($pushes as $push)
                    @if($push->status == 0 && $push->user_id === null && count($push->reads) === 0)
                    <div class="dropdown-divider m-0"></div>
                    <form method="post" action="{{route('read',$push->id)}}">
                        @csrf
                        <input type="hidden" name="push_id" value="{{$push->id}}">
                        <input type="hidden" name="item_id" value="{{$push->item_id}}">
                        <a class="dropdown-item write_space_normal min_w_200 py-2 small aaa" onclick="this.parentNode.submit()">[manabeeからのお知らせ]<br><span class="pre_wrap">{{ $push->comment }}</span><br>{{ $push -> created_at ->diffForHumans($nowtimes) }}</a>
                    </form>
                    @elseif($push->status == 0 && $push->user_id === Auth::id() && count($push->reads) === 0)
                    <div class="dropdown-divider m-0"></div>
                    <form method="post" action="{{route('read',$push->id)}}">
                        @csrf
                        <input type="hidden" name="push_id" value="{{$push->id}}">
                        <input type="hidden" name="item_id" value="{{$push->item_id}}">
                        <a class="dropdown-item write_space_normal min_w_200 py-2 small aaa" onclick="this.parentNode.submit()"><span class="pre_wrap">{{ $push->comment }}</span><br>{{ $push -> created_at ->diffForHumans($nowtimes) }}</a>
                    </form>

                    @elseif($push->status == 1 && count($push->reads) === 0)
                    <div class="dropdown-divider m-0"></div>
                    <form method="post" action="{{route('read',$push->id)}}">
                        @csrf
                        <input type="hidden" name="push_id" value="{{$push->id}}">
                        <input type="hidden" name="item_id" value="{{$push->item_id}}">
                        <a class="dropdown-item write_space_normal min_w_200 py-2 small aaa" onclick="this.parentNode.submit()"><span class="font-weight-bold">{{ $push->item->title }}</span>の購入が完了しました。<br>{{ $push -> created_at ->diffForHumans($nowtimes) }}</a>
                    </form>
                    @elseif($push->status == 2 && count($push->reads) === 0)
                    <div class="dropdown-divider m-0"></div>
                    <form method="post" action="{{route('read',$push->id)}}">
                        @csrf
                        <input type="hidden" name="push_id" value="{{$push->id}}">
                        <input type="hidden" name="item_id" value="{{$push->item_id}}">
                        <a class="dropdown-item write_space_normal min_w_200 py-2 small aaa" onclick="this.parentNode.submit()"><span class="font-weight-bold">{{ $push->item->title }}</span>にコメントされました。<br>{{ $push -> created_at ->diffForHumans($nowtimes) }}</a>
                    </form>
                    @elseif($push->status == 3 && count($push->reads) === 0)
                    <div class="dropdown-divider m-0"></div>
                    <form method="post" action="{{route('read',$push->id)}}">
                        @csrf
                        <input type="hidden" name="push_id" value="{{$push->id}}">
                        <input type="hidden" name="item_id" value="{{$push->item_id}}">
                        <a class="dropdown-item write_space_normal min_w_200 py-2 small aaa" onclick="this.parentNode.submit()"><span class="font-weight-bold">{{ $push->item->title }}</span>が購入されました。<br>{{ $push -> created_at ->diffForHumans($nowtimes) }}</a>
                    </form>
                    @endif
                    @endforeach
                </div>
            </div>
            <div class="navbar-text dropdown ml-3 p-0">
                <a id="navbarDropdown" class="nav-link h_circle h4 m-0 p-0 center text-dark" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    <i class="fas fa-user pb-0"></i>
                    <p class="p-0 m-0 header_font">メニュー</p>

                </a>

                <div class="dropdown-menu dropdown-menu-right p-0 m-0" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item py-3 px-5" href="{{ route('home') }}">マイページへ</a>
                    <div class="dropdown-divider m-0"></div>
                    <a class="dropdown-item py-3 px-5" href="{{ route('change') }}">アカウント情報の変更</a>
                    <div class="dropdown-divider m-0"></div>
                    <a class="dropdown-item py-3 px-5" href="{{ route('favoritedMovie', ['id' => Auth::id()]) }}">お気に入り動画一覧</a>
                    <div class="dropdown-divider m-0"></div>
                    <a class="dropdown-item py-3 px-5" href="{{ route('PurchasedMovie', ['id' => Auth::id()]) }}">購入済み動画一覧</a>
                    <div class="dropdown-divider m-0"></div>
                    <a class="dropdown-item py-3 px-5" href="{{ route('PostMovie', ['id' => Auth::id()]) }}">投稿動画一覧</a>
                    <div class="dropdown-divider m-0"></div>
                    <a class="dropdown-item py-3 px-5" href="{{ route('transfer', ['id' => Auth::id()]) }}">振り込み申請</a>
                    <div class="dropdown-divider m-0"></div>
                    <a class="dropdown-item py-3 px-5" href="{{ route('sample') }}">サンプル動画</a>
                    <div class="dropdown-divider m-0"></div>
                    <a class="dropdown-item py-3 px-5" href="{{ route('faq') }}">よくある質問</a>
                    <div class="dropdown-divider m-0"></div>
                    <a class="dropdown-item py-3 px-5" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        ログアウト
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
            @endguest
        </div>
    </div>
</nav>
<script>
    $(function() {
        var classCount = $(".aaa").length; /* .aaaというクラスの数を取得 */
        $("span#count").text(classCount); /* p#countにクラスの数を表示 */
    })
</script>


@endsection