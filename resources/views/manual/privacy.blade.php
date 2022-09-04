@extends('layouts.layout')
@include('layouts.header')

@section('title', 'プライバシーポリシー')
@section('keywords', 'プライバシーポリシー')
@section('description', 'プライバシーポリシー')

@section('content')

<section class="lg-box py-4 content-width">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4 d-none d-md-block">
                @include('home.sidebar',['type' => 'privacy'])
            </div>
            <div class="col-md-8">
                <h2>プライバシーポリシー</h2>
                <div>
                    <p> 当サイトは、お客様の個人情報保護の重要性について認識し、個人情報の保護に関する法律（以下「個人情報保護法」といいます。）を遵守すると共に、以下のプライバシーポリシー（以下「本プライバシーポリシー」といいます。）に従い、適切な取扱い及び保護に努めます。
                    </p>
                    <ol>
                        <li>個人情報の定義
                            <p>本プライバシーポリシーにおいて、個人情報とは、個人情報保護法第2条第1項により定義された個人情報、すなわち、生存する個人に関する情報であって、当該情報に含まれる氏名、生年月日その他の記述等により特定の個人を識別することができるもの（他の情報と容易に照合することができ、それにより特定の個人を識別することができることとなるものを含みます。）もしくは個人識別符号が含まれる情報を意味するものとします。</p>
                        </li>
                        <li>個人情報の利用目的</li>
                        <p>当サイトは、お客様の個人情報を、以下の目的で利用致します。</p>
                        <ol class="list_parentheses">
                            <li>当サイトサービスの提供のため</li>
                            <li>当サイトサービスに関するご案内、お問い合わせ等への対応のため</li>
                            <li>当サイトの商品、サービス等のご案内のため</li>
                            <li>当サイトサービスに関する当サイトの規約、ポリシー等（以下「規約等」といいます。）に違反する行為に対する対応のため</li>
                            <li>当サイトサービスに関する規約等の変更などを通知するため</li>
                            <li>当サイトサービスの改善、新サービスの開発等に役立てるため</li>
                            <li>当サイトサービスに関連して、個別を識別できない形式に加工した統計データを作成するため</li>
                            <li>その他、上記利用目的に付随する目的のため</li>
                        </ol>
                        <li>個人情報利用目的の変更</li>
                        <p>当サイトは、個人情報の利用目的を、関連性を有すると合理的に認められる範囲内において変更することがあり、変更した場合にはお客様に通知又は公表します。</p>
                        <li>個人情報利用の制限</li>
                        <p>当サイトは、個人情報保護法その他の法令により許容される場合を除き、お客様の同意を得ず、利用目的の達成に必要な範囲を超えて個人情報を取り扱いません。但し、次の場合はこの限りではありません。</p>
                        <ol class="list_parentheses">
                            <li>法令に基づく場合</li>
                            <li>人の生命、身体又は財産の保護のために必要がある場合であって、お客様の同意を得ることが困難であるとき</li>
                            <li>公衆衛生の向上又は児童の健全な育成の推進のために特に必要がある場合であって、お客様の同意を得ることが困難であるとき</li>
                            <li>国の機関もしくは地方公共団体又はその委託を受けた者が法令の定める事務を遂行することに対して協力する必要がある場合であって、お客様の同意を得ることにより当該事務の遂行に支障を及ぼすおそれがあるとき</li>
                        </ol>
                        <li>個人情報の適正な取得</li>
                        <p>当サイトは、適正に個人情報を取得し、偽りその他不正の手段により取得しません。</p>
                        <li>個人情報の安全管理</li>
                        <p>当サイトは、個人情報の紛失、破壊、改ざん及び漏洩などのリスクに対して、個人情報の安全管理が図られるよう、当サイトの従業員に対し、必要かつ適切な監督を行います。また、当サイトは、個人情報の取扱いの全部又は一部を委託する場合は、委託先において個人情報の安全管理が図られるよう、必要かつ適切な監督を行います。</p>
                        <li>第三者提供</li>
                        <p>当サイトは、個人情報保護法その他の法令に基づき開示が認められる場合を除くほか、あらかじめお客様の同意を得ないで、個人情報を第三者に提供しません。但し、次に掲げる場合は上記に定める第三者への提供には該当しません。</p>
                        <ol class="list_parentheses">
                            <li>当サイトが利用目的の達成に必要な範囲内において個人情報の取扱いの全部又は一部を委託することに伴って個人情報を提供する場合</li>
                            <li>合併その他の事由による事業の承継に伴って個人情報が提供される場合</li>
                            <li>個人情報保護法の定めに基づき共同利用する場合</li>
                        </ol>
                        <li>個人情報の開示</li>
                        <p>当サイトは、お客様から、個人情報保護法の定めに基づき個人情報の開示を求められたときは、お客様ご本人からのご請求であることを確認の上で、お客様に対し、遅滞なく開示を行います（当該個人情報が存在しないときにはその旨を通知いたします。）。但し、個人情報保護法その他の法令により、当サイトが開示の義務を負わない場合は、この限りではありません。</p>
                        <li>個人情報の訂正等</li>
                        <p>当ショップは、お客様から、個人情報が真実でないという理由によって、個人情報保護法の定めに基づきその内容の訂正、追加又は削除（以下「訂正等」といいます。）を求められた場合には、お客様ご本人からのご請求であることを確認の上で、利用目的の達成に必要な範囲内において、遅滞なく必要な調査を行い、その結果に基づき、個人情報の内容の訂正等を行い、その旨をお客様に通知します（訂正等を行わない旨の決定をしたときは、お客様に対しその旨を通知いたします。）。但し、個人情報保護法その他の法令により、当ショップが訂正等の義務を負わない場合は、この限りではありません。</p>
                        <li>個人情報の利用停止等</li>
                        <p>当サイトは、お客様から、お客様の個人情報が、あらかじめ公表された利用目的の範囲を超えて取り扱われているという理由又は偽りその他不正の手段により取得されたものであるという理由により、個人情報保護法の定めに基づきその利用の停止又は消去（以下「利用停止等」といいます。）を求められた場合において、そのご請求に理由があることが判明した場合には、お客様ご本人からのご請求であることを確認の上で、遅滞なく個人情報の利用停止等を行い、その旨をお客様に通知します。但し、個人情報保護法その他の法令により、当サイトが利用停止等の義務を負わない場合は、この限りではありません。</p>
                        <li>お問い合わせ</li>
                        <p>開示等のお申出、ご意見、ご質問、苦情のお申出その他個人情報の取扱いに関するお問い合わせは、当ショップの「特定商取引法に基づく表記」内にある連絡先へご連絡いただくか、サイトページ内のお問い合わせフォームよりお問い合わせください。</p>
                        <li>継続的改善</li>
                        <p>当サイトは、個人情報の取扱いに関する運用状況を適宜見直し、継続的な改善に努めるものとし、必要に応じて、本プライバシーポリシーを変更することがあります。</p>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection