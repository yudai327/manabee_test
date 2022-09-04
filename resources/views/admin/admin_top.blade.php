@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">管理側TOP</div>
        <div class="card-body">

            <p>登録者数：{{$users}}</p>
            <p>退会者数：{{$del_users}}</p>
            <p>動画登録数：{{$items}}(削除数{{$del_items}})</p>
            <p>購入数：{{$settlements}}</p>
            <p>総売上：{{number_format($total_sales)}}円 (今月{{number_format($this_month_sales)}}円)</p>
            <p>総決済手数料：{{number_format($total_settlement_fee)}}円 (今月{{number_format($this_month_settlement_fee)}}円)</p>
            <p>総[仮]振込手数料：{{number_format($total_transfer_fee)}}円 (今月{{number_format($this_month_transfer_fee)}}円)</p>
            <p>総[実質]振込手数料：{{number_format($total_transfer_fee_real)}}円 (今月{{number_format($this_month_transfer_fee_real)}}円)</p>
            <p>プラットホーム手数料：{{number_format($total_platform_fee)}}円 (今月{{number_format($this_month_platform_fee)}}円)</p>
            <p>総利益（プラットホーム手数料＋([仮]-[実質]振込手数料)）：{{number_format($total_platform_fee+($total_transfer_fee - $total_transfer_fee_real))}}円
                (今月{{number_format($this_month_platform_fee + ($this_month_transfer_fee - $this_month_transfer_fee_real) )}}円)</p>
            <p>振込申請数（未）：{{$before_sales}} , （済）：{{$after_sales}}</p>
            <div>
                <a href="{{ url('admin/user_list') }}" class="btn btn-primary">ユーザー一覧</a>
            </div>

            <form method="post" action="{{ url('admin/logout') }}">
                @csrf
                <input type="submit" class="btn btn-danger" value="ログアウト" />
            </form>
        </div>
    </div>
</div>
@endsection