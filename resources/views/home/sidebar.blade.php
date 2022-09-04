<div class="sidebar_fixed">
    <div class="list-group">
        @auth
        <button type="button" class="px-2 list-group-item list-group-item-action left @if( $type == 'home') active @endif" onclick='location.href="{{ route('home') }}"'><i class="fas fa-fw fa-home"></i>　マイページ</button>
        <button type="button" class="px-2 list-group-item list-group-item-action @if( $type == 'change') active @endif" onclick='location.href="{{ route('change') }}"'><i class="fas fa-fw fa-user"></i>　アカウント情報の変更</button>
        <button type="button" class="px-2 list-group-item list-group-item-action @if( $type == 'push') active @endif" onclick='location.href="{{ route('push') }}"'><i class="fas fa-fw fa-bell"></i>　お知らせ通知</button>
        <button type="button" class="px-2 list-group-item list-group-item-action @if( $type == 'favorite') active @endif" onclick='location.href="{{ route('favoritedMovie', ['id' => Auth::id()]) }}"'><i class="fa-fw far fa-star"></i>　お気に入り動画一覧</button>
        <button type="button" class="px-2 list-group-item list-group-item-action @if( $type == 'purchase') active @endif" onclick='location.href="{{ route('PurchasedMovie', ['id' => Auth::id()]) }}"'><i class="fas fa-fw fa-play-circle"></i>　購入済み動画一覧</button>
        <button type="button" class="px-2 list-group-item list-group-item-action @if( $type == 'post') active @endif" onclick='location.href="{{ route('PostMovie', ['id' => Auth::id()]) }}"'><i class="fas fa-fw fa-list-alt"></i>　投稿動画一覧</button>
        <button type="button" class="px-2 list-group-item list-group-item-action @if( $type == 'regist') active @endif" onclick='location.href="{{ route('item.regist') }}"'><i class="fas fa-fw fa-video"></i>　動画投稿</button>
        <button type="button" class="px-2 list-group-item list-group-item-action @if( $type == 'transfer') active @endif" onclick='location.href="{{ route('transfer', ['id' => Auth::id()]) }}"'><i class="fas fa-fw fa-yen-sign"></i>　振り込み申請</button>
        @endauth
        <button type="button" class="px-2 list-group-item list-group-item-action @if( $type == 'sample') active @endif" onclick='location.href="{{ route('sample') }}"'><i class="fas fa-fw fa-desktop"></i>　サンプル動画</button>
        <button type="button" class="px-2 list-group-item list-group-item-action @if( $type == 'contacts') active @endif" onclick='location.href="{{ route('contacts.index') }}"'><i class="fas fa-fw fa-comments"></i>　お問い合わせ</button>
        <button type="button" class="px-2 list-group-item list-group-item-action @if( $type == 'faq') active @endif" onclick='location.href="{{ route('faq') }}"'><i class="fas fa-fw fa-question-circle"></i>　よくある質問</button>
        <button type="button" class="px-2 list-group-item list-group-item-action @if( $type == 'privacy') active @endif" onclick='location.href="{{ route('privacy') }}"'><i class="fas fa-fw fa-lock"></i>　プライバシーポリシー</button>
        <button type="button" class="px-2 list-group-item list-group-item-action @if( $type == 'terms') active @endif" onclick='location.href="{{ route('terms') }}"'><i class="fas fa-fw fa-clipboard"></i>　ご利用規約</button>
        <button type="button" class="px-2 list-group-item list-group-item-action @if( $type == 'transaction') active @endif" onclick='location.href="{{ route('transaction') }}"'><i class="fas fa-fw fa-store-alt"></i>　特定商取引に関する表記</button>
        <button type="button" class="px-2 list-group-item list-group-item-action" data-toggle="modal" data-backdrop="true" data-target="#modal-option"><i class="fas fa-fw fa-share-alt"></i>　アプリを共有する</button>
        <div class="modal fade" id="modal-option" tabindex="-1" role="dialog" aria-labelledby="myModalOptionLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalOptionLabel">共有する</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="閉じる"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body m-3">
                        <p>URLをコピーする</p>

                        <div class="share input-group mb-3">
                            <input type="text" id="copyTarget" class="form-control" value="https://{{config('const.domain')}}" readonly placeholder="..." aria-label="..." aria-describedby="button-addon2">
                            <div class="input-group-append">
                                <button type="button" id="button-addon2" class="btn btn-outline-secondary" onclick="copyToClipboard()">コピー</button>
                            </div>
                        </div>
                        <br>
                        <div class="center">
                            <a class="btn-twitter w-100" href="https://twitter.com/share?url=https://{{config('const.domain')}}&text=「教え合う」を最高の学びに。｜manabee｜動画配信サービス" rel="nofollow" target="_blank">Twitterでシェアする</a>
                            <br>
                            <a class="btn-facebook w-100" href="https://www.facebook.com/share.php?u=https://{{config('const.domain')}}" rel="nofollow" target="_blank">Facebookでシェアする</a>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                    </div>
                </div>
            </div>
        </div>
        @auth
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="px-2 list-group-item list-group-item-action"><i class="fas fa-fw fa-sign-out-alt"></i>　ログアウト</button>
        </form>
        @endauth
    </div>
</div>
<script>
    function copyToClipboard() {
        // コピー対象をJavaScript上で変数として定義する
        var copyTarget = document.getElementById("copyTarget");

        // コピー対象のテキストを選択する
        copyTarget.select();

        // 選択しているテキストをクリップボードにコピーする
        document.execCommand("Copy");

        // コピーをお知らせする
        alert("コピーできました！ : " + copyTarget.value);
    }
</script>