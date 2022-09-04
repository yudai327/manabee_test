@extends('layouts.layout')
@include('layouts.header')

@section('title', 'お問い合わせフォーム')
@section('keywords', 'お問い合わせフォーム')
@section('description', 'お問い合わせフォーム')

@section('content')

<section class="lg-box py-4 content-width">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4 d-none d-md-block">
                @include('home.sidebar',['type' => 'contacts'])
            </div>
            <div class="col-md-8">
                <div class="contact_form">
                    <h2>お問い合わせフォーム</h2>
                    <form method="POST" action="{{ route('contacts.confirm') }}">
                        @csrf
                        <div class="form-group">
                            <label for="exampleFormControlInput1" class="mb-0">名前</label>
                            @error('name')
                            <p class="left small text-danger mb-0">{{$message}}</p>
                            @enderror
                            <input type="text" name="name" class="form-control" id="exampleFormControlInput1" placeholder="平田太郎" value="{{ Auth::check() ? $auth->name:  ''}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput2" class="mb-0">メールアドレス</label>
                            @error('email')
                            <p class="left small text-danger mb-0">{{$message}}</p>
                            @enderror
                            <input type="text" name="email" class="form-control" id="exampleFormControlInput2" placeholder="name@example.com" value="{{ Auth::check() ? $auth->email:  ''}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1" class="mb-0">お問い合わせ内容</label>
                            @error('comment')
                            <p class="left small text-danger mb-0">{{$message}}</p>
                            @enderror
                            <textarea name="comment" class="form-control" id="exampleFormControlTextarea1" rows="5"></textarea>
                        </div>
                        <div class="center">
                            <button type="submit" class="btn btn-primary">確認</button><br>
                            <a href="{{ route('contacts.index') }}">キャンセル</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

</section>


@endsection