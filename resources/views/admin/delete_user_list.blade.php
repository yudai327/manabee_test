@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">退会ユーザー一覧</div>
        <div class="card-body">

            <ul class="list-group">
                <table class="table table-hover">
                    <tr>
                        <th>ID</th>
                        <th>名前</th>
                    </tr>
                    @foreach ($user_list as $user)
                    <tr>
                        <td>
                            <a href="{{ url('admin/user/' . $user->id) }}">
                                {{ $user->id }}
                            </a>
                        </td>
                        <td>
                            <a href="{{ url('admin/user/' . $user->id) }}">
                                {{ $user->name }}
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </ul>
            <div class="mt-3">
                {{ $user_list->links() }}
            </div>

        </div>
    </div>
</div>
@endsection