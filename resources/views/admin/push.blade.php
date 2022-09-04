@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">お知らせ通知</div>
        <div class="card-body">
            <form action="{{ route('admin.push') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="exampleFormControlSelect1">宛先</label>
                    <select name="user_id" class=" form-control" id="exampleFormControlSelect1">
                        <option value="0">全体</option>
                        @foreach($user_list as $user)
                        <option value="{{$user ->id}}">{{$user ->id}}:{{$user -> nickname}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">お知らせ内容</label>
                    <textarea name="comment" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
                <div class="center">
                    <button type="submit" class="btn btn-primary" onclick='return confirm("送信確認。送信するならOKを！");'>送信</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection