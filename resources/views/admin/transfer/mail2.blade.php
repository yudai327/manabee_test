{{$user_name}}様への銀行口座振り込みが完了いたしました。<br>
<br><br>
■金額<br>
{{number_format($price)}}円<br>
■仮の振込手数料<br>
{{number_format($transfer_fee)}}円
<br>
■実質の振込手数料<br>
{{number_format($transfer_fee_real)}}円
<br>
<br>
振込口座情報<br>
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

@include('mails.footer')