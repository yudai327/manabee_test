@extends('layouts.layout')
@include('layouts.header')

@section('content')
<div class="center mt-5 w-75 mx-auto">
    <p class="h5 my-3">{{$message}}</p>
    <a href="{{ url('/') }}">トップページへ戻る</a>
</div>
@endsection