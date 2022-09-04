@extends('layouts.layout')
@include('layouts.header')

@section('title', 'よくある質問')
@section('keywords', 'よくある質問')
@section('description', 'よくある質問')

@section('content')

<section class="lg-box py-4 content-width">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4 d-none d-md-block">
                @include('home.sidebar',['type' => 'faq'])
            </div>
            <div class="col-md-8">
                <h2>よくある質問</h2>

                <div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
                    <div class="card">
                        <div class="card-header" role="tab" id="heading1">
                            <h5 class="mb-0">
                                <a class="collapsed text-body d-block p-3 m-n3" data-toggle="collapse" href="#collapse1" role="button" aria-expanded="true" aria-controls="collapse1">
                                    動画を販売する際に引かれる手数料
                                </a>
                            </h5>
                        </div><!-- /.card-header -->
                        <div id="collapse1" class="collapse" role="tabpanel" aria-labelledby="heading1" data-parent="#accordion">
                            <div class="card-body">
                                <p>
                                    <u>決済手数料</u><br>
                                    <b>売上金額の3.25%</b><br>
                                    <br>
                                    <u>プラットフォーム利用料</u><br>
                                    ※売上金額から決済手数料を引いた金額から10%<br>
                                    <b>売上金額-決済手数料の10%</b><br>
                                    <br>
                                    <u>振込手数料（売上金のお支払い時）</u><br>
                                    <b>300円</b><br>
                                </p>
                            </div><!-- /.card-body -->
                        </div><!-- /.collapse -->
                    </div><!-- /.card -->
                    <div class="card">
                        <div class="card-header" role="tab" id="heading2">
                            <h5 class="mb-0">
                                <a class="collapsed text-body d-block p-3 m-n3" data-toggle="collapse" href="#collapse2" role="button" aria-expanded="false" aria-controls="collapse2">
                                    売上金はいつ振込まれますか？
                                </a>
                            </h5>
                        </div><!-- /.card-header -->
                        <div id="collapse2" class="collapse" role="tabpanel" aria-labelledby="heading2" data-parent="#accordion">
                            <div class="card-body">
                                毎月25日までに振込申請をしていただくことで、前月末までの売上金額から、決済手数料・プラットフォーム利用料、振込み手数料300円を引いた金額が月末（最終営業日）に振込まれます。
                            </div><!-- /.card-body -->
                        </div><!-- /.collapse -->
                    </div><!-- /.card -->
                    <div class="card">
                        <div class="card-header" role="tab" id="heading3">
                            <h5 class="mb-0">
                                <a class="collapsed text-body d-block p-3 m-n3" data-toggle="collapse" href="#collapse3" role="button" aria-expanded="false" aria-controls="collapse3">
                                    いくらから申請できますか？
                                </a>
                            </h5>
                        </div><!-- /.card-header -->
                        <div id="collapse3" class="collapse" role="tabpanel" aria-labelledby="heading3" data-parent="#accordion">
                            <div class="card-body">
                                前月末までの未振り込みの売上金額が合計1,000円以上の場合にお振込が可能です。
                            </div><!-- /.card-body -->
                        </div><!-- /.collapse -->
                    </div><!-- /.card -->
                </div><!-- /#accordion -->

            </div>
        </div>
    </div>
</section>
@endsection