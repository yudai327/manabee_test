@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <a href="{{ url('admin/user_list') }}">ユーザー一覧</a> &gt; ユーザー詳細
        </div>
        <div class="card-body">
            <table class="table table-hover">
                <tr>
                    <td>名前</td>
                    <td>{{ $user->name }}</td>
                </tr>
                <tr>
                    <td>ニックネーム</td>
                    <td>{{ $user->nickname }}</td>
                </tr>
                <tr>
                    <td>メール</td>
                    <td>{{ $user->email }}</td>
                </tr>
                <tr>
                    <td>これまでの売上</td>
                    <td>{{ number_format($sum) }}円</td>
                </tr>
                <tr>
                    <td>現在の振込申請中（未振込）の合計金額</td>
                    @if($not_transferred !== 0)
                    <td>{{ number_format($not_transferred) }}円</td>
                    @else
                    <td>振込申請はされていません</td>
                    @endif

                </tr>
                @if($bank !== null)
                <tr>
                    <th scope="row">銀行口座</th>
                    <td>
                        <button class="btn btn-primary" data-toggle="collapse" data-target="#example-1" aria-expand="false" aria-controls="example-1">登録済み</button>
                        <div class="collapse" id="example-1">
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
                    </td>
                </tr>
                @else
                <tr>
                    <th>銀行口座</th>
                    <td>銀行はまだ登録されていません</td>
                </tr>
                @endif

                <tr>
                    <td>作成日</td>
                    <td>{{ $user->created_at->format('Y/m/d H:i:s') }}</td>
                </tr>
                <tr>
                    <td>更新日</td>
                    <td>{{ $user->updated_at->format('Y/m/d H:i:s') }}</td>
                </tr>
                <tr>
                    <td>退会日</td>
                    @if($user->deleted_at !== null)
                    <td>{{ $user->deleted_at }}</td>
                    @else
                    <td class="text-muted">未退会</td>
                    @endif
                </tr>
            </table>
        </div>
    </div>

    <div class="center my-3">
        <a class="btn btn-outline-info btn-sm" href="{{ route('admin.user_sales_detail', ['id' => $id]) }}">期間毎の売り上げ詳細</a>
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
                            <a class="btn btn-sm btn-info text-white py-0" href="{{ route('admin.sales_item', ['id' => $id,'item_id' => $item->id]) }}">詳細</a>
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
@endsection