@extends('layouts.layout')
@include('layouts.header')

@section('title', '振込申請を行うページです')
@section('keywords', '振込申請')
@section('description', '売上金から振込申請を行うページです。')

@section('content')

<section class="lg-box py-4 content-width">
    <div class="container mt-5 p-lg-5 bg-white w-sm-75 py-5">
        <h2 class="center">振込申請</h2>
        <!-- @if(count($errors) > 0)
        <div>
            <ul>
                @foreach($errors->all() as $error)
                <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
        @endif -->
        <div class="center">
            <p class="h4">振込申請が可能な金額：<span class="h2">{{ number_format($possible_sum_transfer) }}円</span></p>
            <small>*振込申請金額から振込手数料として{{ number_format($transfer_fee) }}円引かれます。<br>
                *最低申請金額は1000円です。</small>
        </div>
        @if($possible_sum_transfer >= 1000)
        <form action="{{ route('sales.store', ['id' => $id])}}" id="regist_form" method="post" enctype="multipart/form-data">
            @csrf
            <!--氏名-->
            <div class="form-row mb-4 justify-content-center">
                <div class="col-md-6 form-group">
                    <label for="price">振込申請金額</label>
                    <div class="input-group">
                        <input type="number" min="1000" max="{{$possible_sum_transfer}}" class="form-control text-right" id="price" name="price" placeholder="例）1,0000円" vulue=" {{old('price')}}" aria-describedby="price-addon" required>
                        <div class="input-group-append">
                            <span class="input-group-text" id="price-addon">円</span>
                        </div>
                    </div>
                    <span class="help-block small text-danger">{{$errors->first('price')}}</span>
                </div>
            </div>
            <div class="col-lg-8 p-0 m-auto">
                <h4 class="center">振込口座の確認</h4>
                <table class="table small">
                    <tr>
                        <th scope="row">金融機関名</th>
                        <td>{{$bank->bank_name}}</td>
                    </tr>
                    <tr>
                        <th scope="row">支店名</th>
                        <td>{{$bank->branch_name}}</td>
                    </tr>
                    <tr>
                        <th scope="row">預金種別</th>
                        <td>{{$bank->deposit_type}}</td>
                    </tr>
                    <tr>
                        <th scope="row">口座番号</th>
                        <td>{{$bank->bank_num}}</td>
                    </tr>
                    <tr>
                        <th scope="row">口座名義</th>
                        <td>{{$bank->name}}</td>
                    </tr>
                </table>
            </div>

            <div class="form-group row justify-content-center">
                <div class="col-sm-12">
                    <input type="hidden" name="transfer_fee" value="{{$transfer_fee}}">
                    <input type="hidden" name="bank_id" value="{{$bank_id}}">
                    <button type="submit" id="regist_btn" class="btn btn-primary btn-block" onclick="return btn_click()">申請を行う</button>
                </div>
            </div>
        </form>
        @else
        <p class="my-3 text-center small text-muted">※振込申請が可能な金額が1,000円未満のため振込申請はできません。</p>
        @endif

    </div>
</section>

<script>
    function btn_click() {
        if (confirm('この内容でよろしいですか？')) {
            $('#regist_btn').prop('disabled', true);
            $('#regist_form').submit();
            return true;
        } else {
            return false;
        }
    }
</script>
@endsection