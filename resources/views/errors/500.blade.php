@extends('layouts.layout')
@include('layouts.header')

@section('content')

<br><br>
<div style="text-align:center">
    サーバーが混み合っております。<br>
    暫くしてからもう一度やり直し下さい。
    <br><br>
    <p><a href="{{env('APP_URL')}}">トップページへ</a></p>

</div>


@endsection