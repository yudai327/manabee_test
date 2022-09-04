@extends('layouts.layout')
@include('layouts.header')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mt-3">
                <div class="card-header">パスワードの再設定</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}<br>メール内容を確認しパスワード再設定を行ってください。
                    </div>
                    @else
                    <p class="small text-muted">登録済のメールアドレスからパスワードの再設定を行います。<br>登録済のメールアドレスを入力しパスワードの再設定を行ってください。</p>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">登録済{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="m-auto">
                                <button type="submit" class="btn btn-primary">
                                    パスワード再設定メールを送る
                                    <!-- {{ __('Send Password Reset Link') }} -->
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection