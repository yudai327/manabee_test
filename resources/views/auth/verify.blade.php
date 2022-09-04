@extends('layouts.app')
@include('layouts.header')

@section('content')
<section class="py-4 content-width">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <img class="w-100" src="{{asset(config('const.step2'))}}" alt="ステップ２">
                    <div class="card-body text-center">
                        <p class="my-3 h2 text-danger">メールアドレスの認証を行いましょう。</p>
                        @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            新しく認証確認メールが送信されました。
                        </div>
                        @endif
                        <p class="h5 my-3">仮会員登録が完了しました。メールをご確認ください。</p>
                        <hr>
                        ご登録いただいたメールアドレス宛に本登録のご案内メールをお送りしました。メールに記載された内容に従って本登録をお願いします。
                        <div class="card bg-light my-3">
                            <div class="card-body">
                                <p class="text-danger">ご案内をお送りしたメールアドレス</p>
                                <p class="h4 font-weight-bold">{{ $user->email }}</p>
                            </div>
                        </div>
                        もしメールを受け取っていない場合は、
                        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                            <button type="submit" class="btn btn-primary p-2 m-2 align-baseline">ここをクリック</button>してください.
                        </form>
                        @if (session('resent'))
                        <hr>
                        <h4>メールが届かない場合</h4>
                        「docomo.ne.jp」など携帯電話用メールの場合、迷惑メール機能でmanabeeからのメールが拒否されることがあります。<br>
                        お手数ですが、別のアドレスでご登録いただくか、「<a href="mailto:manabee.info&#64;gmail.com">manabee.info&#64gmail.com</a>」を受信リストに入れていただき、再度
                        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                            <button type="submit" class="btn btn-link p-0 m-0 align-baseline">ここをクリック</button>し登録手続きをお試しください.
                        </form>
                        <div class="card my-3">
                            <div class="card-body">
                                迷惑メール機能の指定受信リスト設定については、利用している携帯電話会社やメールサービスのページをご参照ください。<br>
                                <a href="https://www.nttdocomo.co.jp/info/spam_mail/domain/" class="text-info">docomo</a><br>
                                <a href="https://www.au.com/support/service/mobile/trouble/mail/email/filter/detail/domain/" class="text-info">au</a><br>
                                <a href="https://www.softbank.jp/mobile/service/photovision/email/safety/" class="text-info">softbank</a>
                            </div>
                        </div>
                        @endif
                        <div class="my-3">
                            <p>不明点がございましたら、お問い合わせページよりお問い合わせください。</p>
                            <button type="button" class="btn btn-block btn-outline-info" onclick='location.href="{{ route('contacts.index') }}"'>お問い合わせページへ</button>
                        </div>
                        <hr>
                        <h4>メールアドレスを間違えた場合</h4>
                        お手数ですが、一度ログアウトしてから無料会員登録ページに戻り、改めて手続きを行ってください。
                        <a class="btn btn-block btn-outline-secondary" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            ログアウト
                        </a>
                        <button type="button" class="btn btn-secondary my-5 btn-sm" onclick='location.href="{{ route('index') }}"'>トップページへ戻る</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection