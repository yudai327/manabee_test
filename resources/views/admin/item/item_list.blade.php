@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">投稿動画一覧</div>
        <div class="card-body">

            <ul class="list-group">
                <table class="table table-hover">
                    <tr>
                        <th>ID</th>
                        <th>作者</th>
                        <th>タイトル</th>
                    </tr>
                    @foreach ($item_list as $item)
                    <tr>
                        <td>
                            <a href="{{ url('admin/item/' . $item->id) }}">
                                {{ $item->id }}
                            </a>
                        </td>
                        <td>
                            <a href="{{ url('admin/item/' . $item->id) }}">
                                {{ $item->user->nickname }}
                            </a>
                        </td>
                        <td>
                            <a href="{{ url('admin/item/' . $item->id) }}">
                                {{ $item->title }}
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </ul>
            <div class="mt-3">
                {{ $item_list->links() }}
            </div>

        </div>
    </div>
</div>
@endsection