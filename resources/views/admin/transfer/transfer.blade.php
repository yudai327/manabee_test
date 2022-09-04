@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">入金確認
        </div>
        <div class="card-body">
            <ul class="list-group">
                <table class="table table-hover">
                    <tr>
                        <th>申請者（ニックネーム）</th>
                        <th>申請金額</th>
                        <th>申請日時</th>
                        <th>振込日時</th>
                    </tr>
                    <tr>
                        <td>
                            {{ $transfer->user->nickname }}
                        </td>
                        <td>
                            {{ $transfer->price }}
                        </td>
                        <td>
                            {{ $transfer->request_at }}
                        </td>
                        <td>
                            @if($transfer->transfer_at !== null)
                            {{ $transfer->transfer_at }}
                            @else
                            未振込
                            @endif

                        </td>
                    </tr>
                </table>
            </ul>
            <form action="{{ route('admin.transfer_post') }}" method="post">
                @csrf
                <div class="center">
                    <input type="radio" name="transfer_fee" value="300" checked="checked">300円
                    <input type="radio" name="transfer_fee" value="0">0円（まとめて振り込む場合）<br>
                    <input type="text"" name="transfer_fee_real">実際にかかった振り込み手数料<br>
                    <input type="hidden" name="id" value="{{$transfer->id}}">
                    <button type="submit" class="btn btn-primary" onclick='return confirm("振込確認。完了したならOKを！");'>振込完了</button>
                </div>
            </form>
            <h4>銀行口座情報</h4>
            <table class="table">
                <tr>
                    <th>銀行名</th>
                    <td>{{ $transfer->bank->bank_name }}</td>
                </tr>
                <tr>
                    <th>支店名</th>
                    <td>{{ $transfer->bank->branch_name }}</td>
                </tr>
                <tr>
                    <th>口座種別</th>
                    <td>{{ $transfer->bank->deposit_type }}</td>
                </tr>
                <tr>
                    <th>口座番号</th>
                    <td>{{ $transfer->bank->bank_num }}</td>
                </tr>
                <tr>
                    <th>口座氏名</th>
                    <td>{{ $transfer->bank->name }}</td>
                </tr>
                <tr>
                    <th>銀行口座登録日</th>
                    <td>{{ $transfer->bank->created_at }}</td>
                </tr>
                <tr>
                    <th>銀行口座登録更新日</th>
                    <td>{{ $transfer->bank->updated_at }}</td>
                </tr>
            </table>
        </div>
    </div>
</div>
@endsection