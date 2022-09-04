@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">全体へのお知らせ通知一覧
        </div>
        <div class="card-header center"><button type="button" class="btn btn-primary" onclick='location.href="{{ url('admin/push') }}"'>お知らせ通知を送る</button>
        </div>
        <div class="card-body">
            <ul class="list-group">
                <table class="table table-hover" style="table-layout:fixed;">
                    <tr class="w-100">
                        <th class="w-25">ID</th>
                        <th class="w-50">コメント</th>
                        <th class="w-25">日時</th>
                    </tr>
                    @foreach ($pushes as $push)
                    <tr class="w-100">
                        <td class="w-25">
                            <p>{{ $push->id }}</p>
                        </td>
                        <td class="w-50">
                            <div>
                                @if($push->user_id == null)
                                <p>[全ユーザー宛]</p>
                                @else
                                <p>[{{$push->user->nickname}}]</p>
                                @endif
                                <p class="pre_wrap">{{ $push->comment }}</p>
                            </div>
                        </td>
                        <td class="w-25">
                            <p>{{ $push->created_at }}</p>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </ul>
            <div class="mt-3">
                {{ $pushes->links() }}
            </div>

        </div>
    </div>
</div>
@endsection