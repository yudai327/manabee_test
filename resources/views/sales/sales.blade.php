@extends('layouts.layout')
@include('layouts.header')
@section('title', '売り上げ詳細を確認するページ')
@section('keywords', '売り上げ詳細')
@section('description', '投稿した動画や期間ごとに売り上げ詳細を確認できます。')


@section('content')
<section class="py-4 content-width">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4 d-none d-md-block">
                @include('home.sidebar',['type' => 'transfer'])
            </div>
            <div class="col-md-8">
                <div class="center">
                    <h4>売り上げ詳細</h4>
                </div>
                <!-- タブ部分 -->
                <ul id="myTab" class="nav nav-tabs" role="tablist">
                    <li class="nav-item w-25 center" role="presentation">
                        <a href="#item" id="item-tab" class="nav-link active small" role="tab" data-toggle="tab" aria-controls="item" aria-selected="true">全期間</a>
                    </li>
                    <li class="nav-item w-25 center" role="presentation">
                        <a href="#day" id="day-tab" class="nav-link small" role="tab" data-toggle="tab" aria-controls="day" aria-selected="false">年間</a>
                    </li>
                    <li class="nav-item w-25 center" role="presentation">
                        <a href="#detail" id="detail-tab" class="nav-link small" role="tab" data-toggle="tab" aria-controls="detail" aria-selected="false">月間</a>
                    </li>
                    <li class="nav-item w-25 center" role="presentation">
                        <a href="#history" id="history-tab" class="nav-link small" role="tab" data-toggle="tab" aria-controls="history" aria-selected="false">日毎</a>
                    </li>
                </ul>

                <!-- パネル部分 -->
                <div id="myTabContent" class="tab-content mt-0">
                    <div id="item" class="tab-pane active" role="tabpanel" aria-labelledby="item-tab">
                        <table class="table table-striped small center">
                            <thead class="thead-dark">
                                <tr>
                                    <th>日付</th>
                                    <th class="w-50">タイトル</th>
                                    <th>売上</th>
                                </tr>
                            </thead>
                            @if (count($settlements) > 0)
                            @foreach($settlements as $settlement)
                            <tr>
                                <td>{{ $settlement->created_at->format('Y-m-d') }}</td>
                                <td class="left">
                                    <p class="m-0">{{ $settlement->items_title}}
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('sales.item', ['id' => $id,'item_id' => $settlement->items_id]) }}">詳細</a>
                                    </p>
                                </td>
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
                        <div class="d-flex justify-content-center small">
                            {{ $settlements->links() }}
                        </div>
                        <p class="center">合計{{ $settlements->total() }}件</p>

                    </div>
                    <div id="day" class="tab-pane" role="tabpanel" aria-labelledby="day-tab">
                        <table class="table table-striped small center">
                            <thead class="thead-dark">
                                <tr>
                                    <th>年毎</th>
                                    <th>販売数</th>
                                    <th>売上</th>
                                </tr>
                            </thead>
                            @if (count($year＿histories) > 0)
                            @foreach($year＿histories as $key => $value)
                            <tr>
                                <td>{{ $key }}年</td>
                                <td>{{ $value[1]}}個</td>
                                <td>{{ number_format($value[0])}}円</td>
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
                        </table>
                    </div>
                    <div id="detail" class="tab-pane" role="tabpanel" aria-labelledby="detail-tab">
                        <table class="table table-striped small center">
                            <thead class="thead-dark">
                                <tr>
                                    <th>月毎</th>
                                    <th>販売数</th>
                                    <th>売上</th>
                                </tr>
                            </thead>
                            @if (count($month＿histories) > 0)
                            @foreach($month＿histories as $key => $value)
                            <tr>
                                <td>{{ $key }}</td>
                                <td>{{ $value[1]}}個</td>
                                <td>{{ number_format($value[0])}}円</td>
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
                    <div id="history" class="tab-pane" role="tabpanel" aria-labelledby="history-tab">
                        <table class="table table-striped small center">
                            <thead class="thead-dark">
                                <tr>
                                    <th>日毎</th>
                                    <th>販売数</th>
                                    <th>売上</th>
                                </tr>
                            </thead>
                            @if (count($day＿histories) > 0)
                            @foreach($day＿histories as $key => $value)
                            <tr>
                                <td>{{ $key }}</td>
                                <td>{{ $value[1]}}個</td>
                                <td>{{ number_format($value[0])}}円</td>
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
        </div>
    </div>
</section>
@endsection