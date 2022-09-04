@extends('layouts.layout')
@include('layouts.header')

@section('title', 'お問い合わせ内容確認')
@section('keywords', 'お問い合わせ内容確認')
@section('description', 'お問い合わせ内容確認ページです。')

@section('content')
<section class="lg-box py-4 content-width">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4 d-none d-md-block">
                @include('home.sidebar',['type' => 'contacts'])
            </div>
            <div class="col-md-8">
                <div class="contact_form">
                    <h2>お問い合わせ内容確認</h2>
                    @if ($errors->any())
                    <div>
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif


                    <form method="POST" id="contact_form" action="{{ route('contacts.thanks') }}">
                        @csrf
                        <div class="form-group">
                            <label class="sub_color" for="exampleFormControlInput1">名前</label>
                            <input type="text" name="name" class="form-control" id="exampleFormControlInput1" value="{{ $inputs['name'] }}" readonly>

                        </div>
                        <div class="form-group">
                            <label class="sub_color" for="exampleFormControlInput2">メールアドレス</label>
                            <input type="text" name="email" class="form-control" id="exampleFormControlInput2" value="{{ $inputs['email'] }}" readonly>
                        </div>
                        <div class="form-group">
                            <label class="sub_color" for="exampleFormControlTextarea1">お問い合わせ内容</label>
                            <textarea name="comment" class="form-control" id="exampleFormControlTextarea1" rows="5" readonly>{{ $inputs['comment'] }}</textarea>
                        </div>
                        <div class="center my-2">
                            <button type="submit" id="btn_back" class="btn btn-danger" onclick="btn_click('back')">
                                入力内容修正
                            </button>
                        </div>
                        <div class="center my-2">
                            <button type="submit" id="btn_submit" class="btn btn-primary" onclick="btn_click('submit')">
                                送信する
                            </button>
                        </div>
                        <input type="hidden" name="action" id="action">
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    function btn_click(val) {
        $('#btn_submit').prop('disabled', true);
        $('#btn_back').prop('disabled', true);
        $('#action').val(val);
        $('#contact_form').submit();
    }
</script>
@endsection