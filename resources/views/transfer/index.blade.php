@extends('layouts.layout')
@include('layouts.header')

@section('title', '振り込み申請')
@section('keywords', '振り込み申請,売上金額')
@section('description', '売上金の振り込み申請ページです。銀行を登録し振込申請を行おう。')


@section('content')
<section class="py-4 content-width">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4 d-none d-md-block">
                @include('home.sidebar',['type' => 'transfer'])
            </div>
            <div class="col-md-8 p-0">
                <h2>振り込み申請</h2>
                <div class="card card-body center">
                    <p>これまでの売上金額<br><span class="h2">{{ number_format($sum) }}円</span></p>
                    <p>今月の売上金額<br>
                        <span class="small">（{{date('Y年m月d日', strtotime($first))}}〜{{date('Y年m月d日', strtotime($last))}}）</span><br>
                        <span class="h2">{{ number_format($sum_month) }}円</span>
                    </p>
                    <fieldset style="border: 1px dashed #000000; padding: 10px;">
                        <legend class="w-auto m-0 h6">振込申請が可能な金額</legend><span class="h2">{{ number_format($possible_sum_transfer) }}円</span><br>
                        <p class="small">未振込の{{ number_format($sum_transfer) }}円から各種手数料を引いた金額です</p>
                        @isset($bank)
                        @if($possible_sum_transfer >= 1000)
                        <form action="{{ route('sales.request', ['id' => $id])}}" method="get">
                            <input type="hidden" name="possible_sum_transfer" value="{{$possible_sum_transfer}}">
                            <input type="hidden" name="transfer_fee" value="{{$transfer_fee}}">
                            <input type="hidden" name="bank_id" value="{{$bank->id}}">
                            <button class="btn btn-success" type="submit">振り込み申請</button>
                        </form>
                        @else
                        <p class="small text-muted">※振込申請が可能な金額が1,000円未満のため振込申請はできません。</p>
                        @endif
                        @endisset
                        <p>現在、振込申請中の金額は{{ number_format($not_transferred) }}円</p>
                    </fieldset>
                    <br>
                    @empty($bank)
                    <a class="btn btn-success shadow" href="{{ route('transfer.form', ['id' => $id])}}">振り込み申請前にまずは、<br>振り込み口座を登録！</a>
                    @endempty
                    @isset($bank)
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8 p-0">
                                <h4 class="center">登録済み口座</h4>
                                <table class="table small">
                                    <tr>
                                        <th scope="row">金融機関名</th>
                                        <td>{{$bank->bank_name}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">支店名</th>
                                        <td>{{$bank->branch_name}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">預金種別</th>
                                        <td>{{$bank->deposit_type}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">口座番号</th>
                                        <td>{{$bank->bank_num}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">口座名義</th>
                                        <td>{{$bank->name}}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <a class="btn btn-outline-info btn-sm" href="{{ route('transfer.edit', ['id' => $id]) }}">口座を変更する</a>
                    <p class="left">
                        ○振り込み申請時の登録口座へ振り込みします。<br>
                        ○毎月25日までに振込申請をしていただくことで、前月末までの売上金額から、決済手数料・プラットフォーム利用料、振込み手数料300円を引いた金額が月末（最終営業日）に振込まれます。
                    </p>
                    @if($possible_sum_transfer >= 1000)
                    <form action="{{ route('sales.request', ['id' => $id])}}" method="get">
                        <input type="hidden" name="possible_sum_transfer" value="{{$possible_sum_transfer}}">
                        <input type="hidden" name="transfer_fee" value="{{$transfer_fee}}">
                        <input type="hidden" name="bank_id" value="{{$bank->id}}">
                        <button class="btn btn-success" type="submit">振り込み申請</button>
                    </form>
                    @else
                    <p class="small text-muted">※振込申請が可能な金額が1,000円未満のため振込申請はできません。</p>
                    @endif

                    @endisset
                </div>
                <div class="center my-3">
                    <a class="btn btn-outline-info btn-sm" href="{{ route('sales', ['id' => $id]) }}">期間毎の売り上げ詳細</a>
                </div>
                <!-- タブ部分 -->
                <ul id="myTab" class="nav nav-tabs" role="tablist">
                    <li class="nav-item w-25 center" role="presentation">
                        <a href="#item" id="item-tab" class="nav-link active small" role="tab" data-toggle="tab" aria-controls="item" aria-selected="true">動画毎の売上</a>
                    </li>
                    <li class="nav-item w-25 center" role="presentation">
                        <a href="#day" id="day-tab" class="nav-link small" role="tab" data-toggle="tab" aria-controls="day" aria-selected="false">今月の売上</a>
                    </li>
                    <li class="nav-item w-25 center" role="presentation">
                        <a href="#detail" id="detail-tab" class="nav-link small" role="tab" data-toggle="tab" aria-controls="detail" aria-selected="false">月毎の売上</a>
                    </li>
                    <li class="nav-item w-25 center" role="presentation">
                        <a href="#history" id="history-tab" class="nav-link small" role="tab" data-toggle="tab" aria-controls="history" aria-selected="false">振り込み履歴</a>
                    </li>
                </ul>

                <!-- パネル部分 -->
                <div id="myTabContent" class="tab-content mt-0">
                    <div id="item" class="tab-pane active" role="tabpanel" aria-labelledby="item-tab">
                        <table class="table table-striped small">
                            <thead class="thead-dark">
                                <tr>
                                    <th class="w-50 center">タイトル</th>
                                    <th class="px-0 center">購入者</th>
                                    <th class="center">売上</th>
                                </tr>
                            </thead>
                            @foreach($my_items as $item)
                            <tr>
                                <td>
                                    {{ $item -> title }}
                                    <p class="center m-0">
                                        <small>{{ number_format($item -> price) }}円</small>
                                        @if($item -> preview_flg === 1)
                                        <small>プレビュー</small>
                                        @endif
                                        <a class="btn btn-sm btn-info text-white py-0" href="{{ route('sales.item', ['id' => $id,'item_id' => $item->id]) }}">詳細</a>
                                    </p>
                                </td>
                                <td class="px-0 center">
                                    <p class="small m-0">{{count($item -> settlements)}}人<br>
                                        (今月:{{count($item -> settlements->whereBetween('created_at', [$first, $last]))}}人)
                                    </p>
                                </td>
                                <td class="center">
                                    <p class="small m-0">{{number_format($item -> settlements->sum('price'))}}円<br>
                                        (今月:{{number_format($item->settlements->whereBetween('created_at', [$first, $last])->sum('price'))}}円)</p>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                        <div class="d-flex justify-content-center small">
                            {{ $my_items->links() }}
                        </div>
                        <p class="center">{{ $my_items->total() }}件</p>
                    </div>
                    <div id="day" class="tab-pane" role="tabpanel" aria-labelledby="day-tab">
                        <table class="table table-striped small center">
                            <thead class="thead-dark">
                                <tr>
                                    <th>日付</th>
                                    <th class="w-50">タイトル</th>
                                    <th>売上</th>
                                </tr>
                            </thead>
                            @foreach($nowhistories as $history)
                            <tr>
                                <td>{{ $history->created_at->format('Y-m-d') }}</td>
                                <td class="left">{{ $history->items_title }}</td>
                                <td>{{ number_format($history->settlements_price) }}円</td>
                            </tr>
                            @endforeach
                        </table>
                        <div class="d-flex justify-content-center small">
                            {{ $nowhistories->links() }}
                        </div>
                        <p class="center">{{ $nowhistories->total() }}件</p>

                    </div>
                    <div id="detail" class="tab-pane" role="tabpanel" aria-labelledby="detail-tab">
                        <table class="table table-striped small center">
                            <thead class="thead-dark">
                                <tr>
                                    <th>年月</th>
                                    <th>販売数</th>
                                    <th>売上</th>
                                </tr>
                            </thead>
                            @foreach($timehistories as $key => $value)
                            <tr>
                                <td>{{ $key }}</td>
                                <td>{{ $value[1]}}個</td>
                                <td>{{ number_format($value[0])}}円</td>
                            </tr>
                            @endforeach
                        </table>

                    </div>
                    <div id="history" class="tab-pane" role="tabpanel" aria-labelledby="history-tab">
                        <table class="table table-striped small center">
                            <thead class="thead-dark">
                                <tr>
                                    <th>申請日</th>
                                    <th>振込日</th>
                                    <th>申請額</th>
                                    <th>状態</th>
                                </tr>
                            </thead>
                            @foreach($hurikomies as $hurikomi)
                            <tr>
                                <td>{{date('Y-m-d', strtotime($hurikomi->request_at))}}</td>
                                <td>
                                    @if($hurikomi->transfer_at !== null)
                                    {{date('Y-m-d', strtotime($hurikomi->transfer_at))}}
                                    @endif
                                </td>
                                <td>{{number_format($hurikomi->price)}}円</td>
                                <td>
                                    @if($hurikomi->transfer_flg === 0)
                                    未振込
                                    @else
                                    振込済
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </table>
                        <div class="d-flex justify-content-center small">
                            {{ $hurikomies->links() }}
                        </div>
                        <p class="center">{{ $hurikomies->total() }}件</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection