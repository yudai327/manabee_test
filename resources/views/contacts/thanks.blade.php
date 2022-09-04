@extends('layouts.layout')
@include('layouts.header')


@section('content')
<section class="lg-box py-4 content-width">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4 d-none d-md-block">
                @include('home.sidebar',['type' => 'contacts'])
            </div>
            <div class="col-md-8">

                <div class="center mt-5 w-75 mx-auto">
                    <p class="h5 my-3">{{ __('送信が完了しました。内容を確認後、返信致しますのでお待ちください。返信には数日程度かかる場合がございます。') }}</p>
                    <a href="{{ url('/') }}">トップページへ戻る</a>
                </div>
            </div>
        </div>
    </div>
</section>
    @endsection