@extends('layouts.layout')
@include('layouts.header')
@section('title', 'プロフィール')
@section('keywords', 'A,B,C')
@section('description', '説明文')

@section('content')
<!-- ここにコンテンツ入力 -->

<section class="py-4 content-width">
    <div>
        <div>
            <div>
                <div>
                    <span>ニックネーム</span>
                </div>
                <div>所属など</div>
                <div>
                    <span>カテゴリー</span>
                    <span>筋肉</span>
                    <span>筋肉</span>
                    <span>筋肉</span>
                    <span>筋肉</span>
                </div>
            </div>
        </div>
        <div>
            <div>
                <div>
                    <p>プロフィールの詳細が入ります。プロフィールの詳細が入ります。プロフィールの詳細が入ります。
                        プロフィールの詳細が入ります。プロフィールの詳細が入ります。プロフィールの詳細が入ります。
                        プロフィールの詳細が入ります。プロフィールの詳細が入ります。プロフィールの詳細が入ります。
                    </p>
                </div>
                <div>
                    <button class="btn filled">もっと詳しく</button>
                </div>
            </div>
        </div>
        <div>
            <img src="{{ asset('images/image-1.jpg') }}" alt="">
        </div>
    </div>
</section>

<section class="py-4 content-width">
    <div>
        <input id="myModal_open" type="radio" name="myModal_switch" />
        <label class="btn filled" for="myModal_open">シェアする</label>
        <input id="myModal_close-overlay" type="radio" name="myModal_switch" />
        <label for="myModal_close-overlay">オーバーレイで閉じる</label>
        <input id="myModal_close-button" type="radio" name="myModal_switch" />
        <label for="myModal_close-button"></label>
        <div class="myModal_popUp">
            <div class="myModal_popUp-content">
                <p>シェアする</p>
                <input type="text">
                <button>リンクをコピー</button>
            </div>
        </div>
    </div>
</section>

<section class="py-4 content-width">
    <div>
        <h2>あなたの投稿動画</h2>
    </div>
    <div>
        <div>
            <a href="./course"></a>
            <div>
                <img src="{{ asset('images/image-1.jpg') }}" alt="">
            </div>
            <p>House 1</p>
        </div>
        <div>
            <a href="./course"></a>
            <div>
                <img src="{{ asset('images/image-1.jpg') }}" alt="">
            </div>
            <p>House 1</p>
        </div>
        <div>
            <a href="./course"></a>
            <div>
                <img src="{{ asset('images/image-1.jpg') }}" alt="">
            </div>
            <p>House 1</p>
        </div>
        <div>
            <a href="./course"></a>
            <div>
                <img src="{{ asset('images/image-1.jpg') }}" alt="">
            </div>
            <p>House 1</p>
        </div>
        <div>
            <a href="./course"></a>
            <div>
                <img src="{{ asset('images/image-1.jpg') }}" alt="">
            </div>
            <p>House 1</p>
        </div>
        <div>
            <a href="./course"></a>
            <div>
                <img src="{{ asset('images/image-1.jpg') }}" alt="">
            </div>
            <p>House 1</p>
        </div>
        <div>
            <button>もっと詳しく</button>
        </div>

    </div>
</section>

<section class="py-4 content-width">
    <div>
        <h2>あなたのお気に入り</h2>
    </div>
    <div>
        <div>
            <a href="./course"></a>
            <div>
                <img src="{{ asset('images/image-1.jpg') }}" alt="">
            </div>
            <p>House 1</p>
        </div>
        <div>
            <a href="./course"></a>
            <div>
                <img src="{{ asset('images/image-1.jpg') }}" alt="">
            </div>
            <p>House 1</p>
        </div>
        <div>
            <a href="./course"></a>
            <div>
                <img src="{{ asset('images/image-1.jpg') }}" alt="">
            </div>
            <p>House 1</p>
        </div>
        <div>
            <a href="./course"></a>
            <div>
                <img src="{{ asset('images/image-1.jpg') }}" alt="">
            </div>
            <p>House 1</p>
        </div>
        <div>
            <a href="./course"></a>
            <div>
                <img src="{{ asset('images/image-1.jpg') }}" alt="">
            </div>
            <p>House 1</p>
        </div>
        <div>
            <a href="./course"></a>
            <div>
                <img src="{{ asset('images/image-1.jpg') }}" alt="">
            </div>
            <p>House 1</p>
        </div>
        <div>
            <button>もっと詳しく</button>
        </div>

    </div>
</section>


<!-- ここにまでコンテンツ入力 -->
@endsection