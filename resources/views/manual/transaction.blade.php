@extends('layouts.layout')
@include('layouts.header')

@section('title', '特定商取引に関する表記')
@section('keywords', '特定商取引に関する表記')
@section('description', '特定商取引に関する表記')

@section('content')

<section class="lg-box py-4 content-width">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4 d-none d-md-block">
                @include('home.sidebar',['type' => 'transaction'])
            </div>
            <div class="col-md-8">
                <h2>特定商取引に関する表記</h2>
                <h4>事業者</h4>
                <p>株式会社Bei</p>
                <h4>代表者</h4>
                <p>吉田直紀</p>
                <h4>メールアドレス</h4>
                <p> Info@bei-magazine.com</p>
                <h4>所在地</h4>
                <p> 〒305-0882 つくば市みどりの中央24-3</p>
                <h4>電話番号</h4>
                <p> 080-5478-8521</p>
                <p> ※お取引やサービスについてのお問い合わせは電話では受け付けておりません</p>
                <p>大変申し訳ありませんが、お問い合わせについては個人情報保護などのためアプリ内の「お問い合わせ」フォームよりご連絡をいただき対応させていただいております。ご不便をおかけいたしますが、ご理解ご協力をよろしくお願いいたします。</p>
                <h4>販売価格帯</h4>
                <p>各商品に表記された価格に準じます</p>
                <h4>商品等の引き渡し時期</h4>
                <p>入金確認後の引き渡しになります</p>
                <h4>代金の支払方法</h4>
                <p>クレジットカード(Visa、Mastercard)</p>
                <h4>代金の支払時期</h4>
                <p>即日</p>
                <h4>商品代金以外に必要な費用</h4>
                <p>商品により発送費用</p>
                <p>支払い方法により所定の手数料</p>
                <h4>返品・交換について</h4>
                <p>お客様都合による返品・交換は受け付けておりません</p>
            </div>
        </div>
    </div>
</section>

@endsection