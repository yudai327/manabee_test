@extends('layouts.layout')
@include('layouts.header')
@section('title', '決済画面')
@section('keywords', '決済,クレジットカード決済')
@section('description', 'クレジットカード決済を行うページです')



@section('content')
<script type="text/javascript" src="{{config('const.settlement_payment_form')}}"></script>

<link href="{{ asset('css/mysqpaymentform.css') }}" rel="stylesheet">

<br><br><br>
<form action="#" method="post" id="nonce-form">
    @csrf
    <div class="container">
        <div class="row">
            <div class="col-10">
            </div>
        </div>
    </div>
    <br>
    <br><br>
    <br>
    <br><br>
    <br>
    <br><br>
    <div id="form-container">
        <div class="mx-2">
            <label for="settle_title" class="mb-0">購入動画</label>
            <p id="settle_title" class="h4">{{$item->title}}</p>
            <label for="settle_price" class="mb-0">お支払い金額</label>
            <p id="settle_price" class="h4">{{$item->price}}円</p>
        </div>
        <div id="sq-card-number"></div>
        <div class="third" id="sq-expiration-date"></div>
        <div class="third2" id="sq-cvv"></div>
        <button id="sq-creditcard" class="button-credit-card" onclick="onGetCardNonce(event)">決済</button>
    </div>
    <input type="hidden" id="card-nonce" name="nonce">
</form>



<script type="text/javascript">
    const paymentForm = new SqPaymentForm({
        applicationId: "{{config('const.settlement_application_id')}}",
        inputClass: 'sq-input',
        autoBuild: false,
        postalCode: false,
        inputStyles: [{
            fontSize: '12px',
            lineHeight: '24px',
            padding: '16px',
            placeholderColor: '#a0a0a0',
            backgroundColor: 'transparent',
        }],
        cardNumber: {
            elementId: 'sq-card-number',
            placeholder: 'カード番号'
        },
        cvv: {
            elementId: 'sq-cvv',
            placeholder: 'セキュリティ番号'
        },
        expirationDate: {
            elementId: 'sq-expiration-date',
            placeholder: '有効期限（MM/YY）'
        },
        callbacks: {
            /*
             * callback function: cardNonceResponseReceived
             * Triggered when: SqPaymentForm completes a card nonce request
             */
            cardNonceResponseReceived: function(errors, nonce, cardData) {
                if (errors) {
                    console.error('Encountered errors:');
                    errors.forEach(function(error) {
                        console.error('  ' + error.message);
                    });
                    alert('Encountered errors, check browser developer console for more details');
                    return;
                }
                if (confirm("決済処理を行います。宜しいでしょうか？")) {
                    document.getElementById('card-nonce').value = nonce;
                    document.getElementById('nonce-form').submit();
                }
            }
        }
    });


    paymentForm.build();

    function onGetCardNonce(event) {
        event.preventDefault();
        paymentForm.requestCardNonce();
    }
</script>

@endsection