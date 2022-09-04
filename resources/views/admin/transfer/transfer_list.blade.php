@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">入金依頼一覧
        </div>
        <div class="card-body">
            <ul class="list-group">
                <table class="table table-hover">
                    <tr>
                        <th>申請者（ニックネーム）</th>
                        <th>銀行id</th>
                        <th>申請金額</th>
                        <th>申請日時</th>
                        <th>振込日時</th>
                    </tr>
                    @foreach ($transferes as $transfer)
                    <tr>
                        <td>
                            {{ $transfer->user->nickname }}
                        </td>
                        <td>
                            {{ $transfer->bank_id }}
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
                            未振込 <a href="{{ url('admin/transfer/' . $transfer->id) }}" class="btn btn-primary">振込へ</a>
                            @endif

                        </td>
                    </tr>
                    @endforeach
                </table>
            </ul>
            <div class="mt-3">
                {{ $transferes->links() }}
            </div>

        </div>
    </div>
</div>
@endsection