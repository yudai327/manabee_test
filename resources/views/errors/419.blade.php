@extends('layouts.layout')
@include('layouts.header')

@section('content')

<br><br>
<div style="text-align:center">
    セッション情報が無効になっています。<br>
    処理が完了していない場合はもう一度やり直してください。<br>
    不明な場合はお問い合わせください。
    <br><br>
    <p><a href="{{env('APP_URL')}}">トップページへ</a></p>
</div>


@endsection