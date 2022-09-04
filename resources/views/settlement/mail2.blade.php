{{$my_name}}様<br>
いつもmanabeeのご利用ありがとうございます。<br><br>
投稿中の動画が購入されました。<br>
<br>
■購入された動画<br>
{{$title}}<br>
■購入された動画のURL<br>
<a href="https://{{config('const.domain')}}/item/view/{{$item_id}}/">https://{{config('const.domain')}}/item/view/{{$item_id}}/</a>
<br>
■購入者<br>
{{$your_name}}<br>
■売り上げ<br>
{{number_format($price)}}円<br>
■購入日時<br>
{{$now->format('Y/m/d H:i:s')}}<br><br>

@include('mails.footer')