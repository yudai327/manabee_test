@extends('layouts.layout')
@include('layouts.header')

@section('title', '銀行口座変更ページです。')
@section('keywords', '銀行口座変更')
@section('description', '既に登録してある銀行口座を別の銀行口座へ変更します。')

@section('content')

<section class="lg-box py-4 content-width">
    <div class="container mt-5 p-lg-5 bg-white w-sm-75 py-5">
        <h2 class="center">口座変更</h2>
        @if(count($errors) > 0)
        <div>
            <ul>
                @foreach($errors->all() as $error)
                <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form action="{{ route('transfer.update', ['id' => $id])}}" method="post" enctype="multipart/form-data">
            @csrf
            <!--氏名-->
            <div class="form-row mb-4 justify-content-center">
                <div class="col-md-6 form-group @if(!empty($errors->first('bank_name'))) has-error @endif">
                    <label for="bank_name">金融機関名</label>
                    <input type="text" class="form-control" name="bank_name" value="{{$date->bank_name}}" vulue="{{old('bank_name')}}" required>
                    <span class="help-block">{{$errors->first('bank_name')}}</span>
                </div>
            </div>
            <div class="form-row mb-4 justify-content-center">
                <div class="col-md-6 mb-3 form-group @if(!empty($errors->first('branch_name'))) has-error @endif">
                    <label for="branch_name">支店名</label>
                    <input type="text" class="form-control" name="branch_name" value="{{$date->branch_name}}" vulue="{{old('branch_name')}}" required>
                    <span class="help-block">{{$errors->first('branch_name')}}</span>
                </div>
            </div>
            <div class="form-group row justify-content-center">
                <div class="mb-4">
                    <legend class="col-form-label">預金種別</legend>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="customRadioInline1" name="deposit_type" class="custom-control-input" value="普通" @if($date->deposit_type =="普通" ) checked @endif>
                        <label class="custom-control-label" for="customRadioInline1">普通</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="customRadioInline2" name="deposit_type" class="custom-control-input" value="当座" @if($date->deposit_type =="当座" ) checked @endif>
                        <label class="custom-control-label" for="customRadioInline2">当座</label>
                    </div>
                    <div class="form-group @if(!empty($errors->first('deposit_type'))) has-error @endif">
                        <span class="help-block">{{$errors->first('deposit_type')}}</span>
                    </div>
                </div>
            </div>
            <div class="form-row mb-4 justify-content-center">
                <div class="col-md-6 form-group @if(!empty($errors->first('bank_num'))) has-error @endif">
                    <label for="bank_num">口座番号</label>
                    <input type="text" class="form-control" name="bank_num" value="{{$date->bank_num}}" placeholder="口座番号" required>
                    <span class="help-block">{{$errors->first('bank_num')}}</span>
                </div>
            </div>
            <div class="form-row mb-4 justify-content-center">
                <div class="col-md-6 mb-3 form-group @if(!empty($errors->first('name'))) has-error @endif">
                    <label for="name">口座名義</label>
                    <input type="text" class="form-control" name="name" value="{{$date->name}}" placeholder="口座名義" required>
                    <span class="help-block">{{$errors->first('name')}}</span>
                </div>
            </div>
            <div class="form-group row justify-content-center">
                <div class="col-sm-12">
                    <button type="submit" class="btn btn-primary btn-block">変更する</button>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection