{{$my_name}}様<br>
いつもmanabeeのご利用ありがとうございます。<br><br>
「{{$title}}」の購入が完了しました。<br><br>
以下のURLから購入した動画へのアクセスも可能です。お楽しみください。<br>
<a href="https://{{config('const.domain')}}/item/view/{{$item_id}}/">https://{{config('const.domain')}}/item/view/{{$item_id}}/</a>
<br>
<br>
■購入した動画<br>
{{$title}}<br>
■購入した動画のURL<br>
<a href="https://{{config('const.domain')}}/item/view/{{$item_id}}/">https://{{config('const.domain')}}/item/view/{{$item_id}}/</a>
<br>
■動画作成者<br>
{{$your_name}}<br>
■購入金額<br>
{{number_format($price)}}円<br>
■購入日時<br>
{{$now->format('Y/m/d H:i:s')}}<br><br>

@include('mails.footer')