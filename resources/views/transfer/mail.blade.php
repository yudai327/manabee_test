いつもご利用ありがとうございます。<br><br>

振り込み申請を受け付けました。<br>
<br>
■金融機関名<br>
{{$bank_name}}<br>
■支店名<br>
{{$branch_name}}<br>
■預金種別<br>
{{$deposit_type}}<br>
■口座番号<br>
{{$bank_num}}<br>
■口座名義<br>
{{$name}}<br>
■金額<br>
{{number_format($price)}}円<br>
■手数料<br>
{{number_format($transfer_fee)}}円

@include('mails.footer')