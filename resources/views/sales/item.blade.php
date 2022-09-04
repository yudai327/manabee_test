@extends('layouts.layout')
@include('layouts.header')
@section('title', '動画ごとの売り上げ詳細')
@section('keywords', '動画ごとの売り上げ詳細')
@section('description', '動画ごとの売り上げ詳細ページです。')


@section('content')
<section class="py-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4 d-none d-md-block">
                @include('home.sidebar',['type' => 'transfer'])
            </div>
            <div class="col-md-8">
                <div class="center">
                    <h4>売り上げ詳細</h4>
                    <div class="card mb-3">
                        <div class="row no-gutters">
                            <div class="col-md-4">
                                @if ($item -> image_path === null)
                                <img class="sales_img" src="//media.{{config('const.domain')}}/converted_movie/{{ $item -> path }}/{{ $item -> path }}_CMAF.0000000.jpg" alt="">
                                @else
                                <img class="sales_img" src="//media.{{config('const.domain')}}/image/{{ $item -> image_path }}" alt="">
                                @endif
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title item_box__title clamp2 m-0">{{$item->title}}</h5>
                                    <p class="card-text small text-muted">
                                        <span><a href="{{ route('userpages', ['id' => $item -> user_id]) }}"><i class="fas fa-user-circle"></i> {{ $item -> user -> nickname }}</a></span> {{ $item -> settlements ->count('id') }}人視聴　{{ $item -> created_at ->diffForHumans($nowtimes) }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table table-striped small center">
                    <thead class="thead-dark">
                        <tr>
                            <th>購入日</th>
                            <th>購入者</th>
                            <th>売上</th>
                        </tr>
                    </thead>
                    @if (count($settlements) > 0)
                    @foreach($settlements as $settlement)
                    <tr>
                        <td>{{ date('Y-m-d', strtotime($settlement->created_at)) }}</td>
                        <td><a href="{{ route('userpages', ['id' => $settlement -> user_id]) }}">{{ $settlement->nickname }}様</a></td>
                        <td>{{ number_format($settlement->settlements_price) }}円</td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="3">
                            購入されていません。
                        </td>
                    </tr>
                    @endif

                </table>
            </div>
        </div>
    </div>
</section>
@endsection