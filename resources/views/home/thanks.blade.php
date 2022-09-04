@extends('layouts.layout')
@include('layouts.header')


@section('content')
<section class="lg-box py-4 content-width">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="center mt-5 w-75 mx-auto">
                    <p class="h5 my-3">{{ __('アカウント削除(退会)が完了しました。ご利用ありがとうございました。') }}</p>
                    <a href="{{ url('/') }}">トップページへ戻る</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection