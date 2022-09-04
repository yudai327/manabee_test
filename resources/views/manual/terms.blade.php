@extends('layouts.layout')
@include('layouts.header')

@section('title', 'ご利用規約')
@section('keywords', 'ご利用規約')
@section('description', 'ご利用規約')
@section('content')
<section class="lg-box py-4 content-width">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4 d-none d-md-block">
                @include('home.sidebar',['type' => 'terms'])
            </div>
            <div class="col-md-8">
                <h2>ご利用規約</h2>
                <p>このManabeeご利用規約（以下、「本利用規約」といいます。）は、株式会社Bei（以下、「Bei」といいます。）が提供するManabee（以下、「本サービス」といいます。）の利用者に適用されるサービス利用の契約です。</p>
                <p>その他Manabeeのウェブサイト（以下、「本サイト」といいます。）上に掲載するManabeeの利用に関わるルール等についても、本利用規約の一部を構成するものとし、適用されるものとします。本サービスをご利用いただく前に利用規約をよくお読み頂き、同意下さいますようお願いします。</p>
                <h3>Manabee総則規約</h3>
                <ol>
                    <li>定義</li>
                    <ol class="list_parentheses">
                        <li>クリエイターが本サービス上に配信したデジタルコンテンツまたは本サービス上で運営する各種サービスを利用する者を「ユーザー」といいます。</li>
                        <li>ユーザーのうち本サービスの会員登録を行わないで本サービスを利用する者を「ゲストユーザー」といいます。</li>
                        <li>デジタルコンテンツの制作および配信または各種サービスの運営をし、本サービス上でユーザーに対し購読・閲覧その他の利用をさせる者を「クリエイター」といいます。</li>
                    </ol>
                    <li>本サービスの機能とBeiの役割</li>
                    <ol class="list_parentheses">
                        <li>本サービスは、Beiが管理・運営する、クリエイターとユーザーを直接つなげるデジタルコンテンツの市場をつくることを目的としたウェブサービスです。</li>
                        <li>Beiは、プロモーション等を通じて本サービスの認知向上、ユーザーの利便性の向上およびクリエイターの収益向上に寄与できるよう努力します。</li>
                    </ol>
                    <li>デジタルコンテンツの取扱い</li>
                    <ol class="list_parentheses">
                        <li>ユーザーは、本サービス上で、クリエイターと取引契約を締結し、本サービスを利用します。</li>
                        <li>クリエイターが制作したデジタルコンテンツの著作権は、クリエイターに帰属します。Beiは、本利用規約に基づくメディアおよびプラットフォームとしての機能を提供する立場であって、ユーザーに対しデジタルコンテンツの著作権の譲渡、貸与等を認めるものではありません。</li>
                    </ol>
                    <li>利用資格</li>
                    <p>本サービスは、以下のすべてを満たす方がご利用いただけます。</p>
                    <ol class="list_parentheses">
                        <li>デジタルコンテンツを制作するクリエイター、ユーザーおよびBeiが互いに協力してインターネット上にこれからのデジタルコンテンツ市場を作るという、本サービスの理念に同意できる方</li>
                        <li>インターネット接続環境を自己の責任と負担で用意できる方</li>
                        <li>本利用規約に同意の上継続して遵守できる方</li>
                        <li>契約締結について法的な責任能力のある方</li>
                        <li>Beiが指定する方法による支払決済を利用できる支払い能力のある方</li>
                        <li>利用者は、自己の責任において本サービスを利用するものとし、本サービスを利用してなされた一切の行為およびその結果について一切の責任を負うものとします。</li>
                    </ol>
                    <li>本利用規約への同意</li>
                    <ol class="list_parentheses">
                        <li>本サービスの利用申込みと登録に当たっては、本利用規約に同意していただくことが必要です。</li>
                        <li>ゲストユーザーは、クリエイターのデジタルコンテンツを購入する場合、本利用規約に同意していただくことが必要です。</li>
                    </ol>
                    <li>申込みの方法</li>
                    <ol class="list_parentheses">
                        <li>本サービスの利用申込みにあたっては、Beiが定める所定のフォームから登録が必要となります。</li>
                        <li>利用者からの利用申込みに対し、Beiが承諾の通知を送信した時点で登録が完了となり、本サービスを利用することができる状態となります。</li>
                        <li>申込み内容を確認させていただいた結果、本サービスへの登録をお受けできない場合があります。</li>
                        <li>Beiは、過去に本利用規約違反等によってBeiから利用停止等の処分を受けた利用者について、利用者の登録の申込みを拒むことができます。</li>
                    </ol>
                    <li>取引契約</li>
                    <ol class="list_parentheses">
                        <li>本サービスにおいてクリエイターが有料または無料でデジタルコンテンツを販売または各種サービスを運営する場合は、クリエイターとユーザーとの間において直接契約が成立することになります。Beiはクリエイターにコンテンツの販売および各種サービスの運営の場を提供する立場になります。Beiは、当該契約について契約の当事者とはならず、当該契約に関する責任は負いません。したがって、当該契約に際し万一トラブルが生じた際には、ユーザーとクリエイターとの間で解決していただくことになります。ただしBeiは当事者間のトラブルに関し、その解決に向け最大限努力します。</li>
                    </ol>
                    <li>デジタルコンテンツの購入契約の性質</li>
                    <ol class="list_parentheses">
                        <li>デジタルコンテンツを配信する内容および配信頻度は、個々のクリエイターが定めるとおりとします。</li>
                        <li>個々のクリエイターの事情により、デジタルコンテンツを配信する内容もしくは配信頻度を変更または配信を停止する場合があります。</li>
                    </ol>
                    <li>退会</li>
                    <p>利用者が退会を希望する場合には、利用者は、本サービス内の所定の方法により、Beiに退会の申出を行うものとします。</p>
                    <li>禁止事項</li>
                    <ol class="list_parentheses">
                        <li>利用者は、他の利用者およびBeiへの迷惑・損害やそのおそれを発生させる行為を行わないで下さい。以下特に気をつけていただきたい事項としてその一例を列挙いたしますが、これらに限りません。</li>
                        <li>クリエイターの承諾があるものを除き、デジタルコンテンツを複製、販売、出版、貸与、放送、公衆送信（送信可能化を含みます）、上映、改変、翻案する等、購読契約の範囲を超えて利用すること</li>
                        <li>デジタルコンテンツを保護するために施された技術的措置を回避 ・無効化すること</li>
                        <li>利用者以外の者にIDおよびパスワードを譲渡、貸与すること</li>
                        <li>IDを不特定多数で共有すること</li>
                        <li>法令や公序良俗に違反する行為を行うこと</li>
                        <li>他の利用者を不快にさせる行為を行うこと</li>
                        <li>Beiのサービスの障害となる行為を行うこと</li>
                        <li>他人のクレジットカードを不正に利用する行為を行うこと</li>
                    </ol>
                    <li>本サービスの利用および停止等</li>
                    <ol class="list_parentheses">
                        <li>Beiは、利用者が本利用規約に違反した場合は、その利用者について本サービスの一部または全部を停止することがあります。この場合、Beiは利用者に対し何ら通知する義務を負いません。</li>
                        <li>Beiは、本サービスの障害復旧対応や定期メンテナンス等を行う場合は、本サービスの一部または全部を停止することがあります。この場合、Beiは利用者に対し合理的な手段によりサービスを停止する旨の通知をします。</li>
                        <li>Beiは、利用者に対して事前に通知することなく、本サービスの機能の一部を停止し、または中断することができます。</li>
                        <li>Beiは、過去に本利用規約違反等によってBeiから利用停止等の処分を受けた利用者について、本サービスの利用の停止をすることができます。</li>
                    </ol>
                    <li>責任</li>
                    <ol class="list_parentheses">
                        <li>本サービスに対する不正アクセス・ハッキング等のサイバー攻撃、本サービスを運用するハードウェアの障害、バグを含むソフトウェアの障害について、Beiは合理的な範囲でそれらが発生しないよう管理いたしますが、保証はできません。また、利用者が独自に契約して利用するインターネット回線との接続障害、自然災害等の不可抗力によって発生した損害についても、Beiは責任を負いかねます。</li>
                        <li> 利用者が本サービスに関連して何らか損害が生じた場合であっても、Beiは利用者がそれにより直接かつ通常生じる範囲内の損害に限り責任を負い、その他の特別損害については責任を負いません。また、いかなる場合においてもBeiが利用者に対して負う責任の総額は、Beiに対しお支払いいただいた本サービスにおけるプラットフォーム利用料の過去1年間における合計累積額または10,000円のいずれか低い金額を上限とします。ただし、Beiの故意または重過失によって発生した損害については、この上限を適用するものではありません。</li>
                        <li> Beiは、クリエイターが投稿した本サービス上のデジタルコンテンツの中に、コンピュータウィルス等有害なものが含まれていないことを保証するものではありません。また、クリエイターが投稿した本サービス上のデジタルコンテンツ、ファイル等から、利用者のコンピューター、ソフトウェアその他の機器がコンピュータウィルス等有害なものに感染した場合であっても、Beiは、それにより利用者に生じた損害について、一切責任を負いません。</li>
                    </ol>
                    <li>個人情報</li>
                    <ol class="list_parentheses">
                        <li>Beiは、本サービスの運営に必要な最低限の個人情報を収集し、合理的な方法により安全に管理します。個人情報の取扱いについては、プライバシーポリシーに従います。</li>
                        <li>ユーザーがデジタルコンテンツを購入した場合、特段の設定をしない限り、購入者情報としてユーザー名およびアカウントURLがクリエイターに通知されます。また、Beiは法令上認められる場合を除き、上記以外のユーザーの個人情報をクリエイターに対して開示することはできません。</li>
                    </ol>
                    <li>利用者ID等</li>
                    <ol class="list_parentheses">
                        <li>利用者は、自己の責任において、本サービスにかかる利用者のIDおよびパスワード（以下、「アカウント情報」といいます。）を管理および保管するものとし、これを第三者に利用させたり、貸与、譲渡、名義変更、売買等してはなりません。</li>
                        <li>アカウント情報の管理の不十分、使用上の過誤、第三者の使用等による損害の責任は利用者が負うものとし、Beiは一切の責任を負いません。</li>
                        <li>利用者は、アカウント情報が盗まれ、又は第三者に使用されていることが判明した場合には、直ちにその旨をBeiに通知するとともに、Beiの指示に従うものとします。</li>
                        <li>利用者は、Beiの指定する方法によりIDを変更することができます。なお、Beiは、本サービスの運営において必要が生じた場合、利用者に通知のうえ、利用者のIDを変更することがあります。</li>
                    </ol>
                    <li>利用者へのお知らせ</li>
                    <ol class="list_parentheses">
                        <li>Beiは利用者に、Beiが提供する全てのサービスのコンテンツ更新やおすすめコンテンツのお知らせのため定期的にメールマガジン、スマートフォン・タブレットアプリのプッシュ通知を行います。利用者は、スマートフォンやタブレットの設定を変更していただくことにより、いずれも停止することができます。</li>
                        <li>Beiは利用者のサイト・アプリ内の行動履歴に基づいて、おすすめコンテンツを上記手段にてお知らせすることがあります。</li>
                        <li>メールマガジン、プッシュ通知内容は、Beiが提供する全てのサービスに関する情報になります。</li>
                    </ol>
                    <li>本サービス内容および本利用規約の変更</li>
                    <ol class="list_parentheses">
                        <li>Beiは、Beiの判断において、本サービスの内容の変更をする可能性があります。また、Beiは、Beiの判断により、本利用規約を変更することがあります。変更後の本利用規約は、Beiが別途定める場合を除いて、本サイト上に表示した時点より効力を生じるものとします。</li>
                        <li>Beiは、本利用規約を変更する場合は、利用者に対し電子メールまたはその他周知に適した方法により通知した上で、所定のURLに変更後の本利用規約を掲示します。</li>
                        <li>上記にかかわらず、利用者が本利用規約の変更通知を受け取った後または本利用規約の変更日以後に本サービスを利用した場合は、その変更内容について異議なく同意したものとみなします。</li>
                    </ol>
                    <li>地位譲渡</li>
                    <ol class="list_parentheses">
                        <li>利用者は、Beiの書面による承諾がなければ、契約上の地位または権利・義務について、第三者に対して譲渡、移転、担保設定、その他の処分をすることはできません。</li>
                    </ol>
                    <li>事業譲渡</li>
                    <ol class="list_parentheses">
                        <li>Beiは本サービスにかかる事業を他社に譲渡した場合には、当該事業譲渡に伴い契約上の地位、本利用規約に基づく権利及び義務並びに利用者の情報その他の顧客情報を当該事業譲渡の譲受人に譲渡することができるものとし、利用者は、かかる譲渡につき予め同意したものとします。なお、本規定における事業譲渡には、通常の事業譲渡のみならず、会社分割その他事業が移転するあらゆる場合を含むものとします。</li>
                    </ol>
                    <li>準拠法と裁判管轄</li>
                    <ol class="list_parentheses">
                        <li>本利用規約は日本法を準拠法とします。</li>
                        <li>本利用規約の各事項に関連して紛争が生じた場合は、東京地方裁判所を第一審の専属的合意管轄裁判所とします。</li>
                    </ol>
                </ol>
                <h3>Manabeeクリエイター規約</h3>
                <ol>
                    <li>有料・無料の自由</li>
                    <p>クリエイターは、デジタルコンテンツの提供を、本利用規約に従う限りで、有料・無料いずれも行うことができます。</p>
                    <li>特定商取引に関する表示</li>
                    <p>クリエイターは、自身のページに特定商取引に関する法律その他の法令に従った表示を行います。</p>
                    <li>販売価格</li>
                    <ol>
                        <li>有料でデジタルコンテンツの提供をする場合には、１件当たりのデジタルコンテンツの販売価格は、Beiの指定する範囲で、クリエイターが自由に設定することができます。</li>
                        <li>各種サービスの運営を行う場合には、1人当たりの月額会費その他のサービスの価格は、Beiの指定する範囲で、クリエイターが自由に設定することができます。</li>
                        <li>さらに、追加で「サポート機能」の利用をクリエイターが設定した場合、Beiが定める方法によりユーザー自らが設定した金額を足した金額が、デジタルコンテンツの販売価格となります。</li>
                    </ol>
                    <li>代金およびnote利用料率</li>
                    <ol class="list_parentheses">
                        <li>デジタルコンテンツの販売価格および各種サービスの価格（以下併せて「代金」といいます。なお、消費税相当額を含みます。）はユーザーからBeiの所定口座に振り込まれます。Beiは、クリエイターから支払いの申請があった場合、代金から決済手数料、プラットフォーム利用料、および金融機関の振込手数料を差し引いた残額（以下「支払金額」といいます。）をクリエイターにお支払いします。</li>
                        <li>プラットフォーム利用料は、代金から決済手数料を控除した金額に10％を乗じた金額になります。</li>
                        <li>クリエイターが支払金額の受け取りを希望する場合は、当月25日までにBeiに所定の申請手続きを行うことにより、前月までの支払金額を当月末に受け取ることが出来ます。なお、当該支払金額受け取りの申請は、支払金額が5,000円以上となった場合にのみ行うことが出来ます。また、支払金額の受け取りは過去の支払金額全額とし、支払金額の一部の受け取りの申請をすることはできません。</li>
                        <li>共同運営マガジンの販売代金は、クリエイターのうち管理者がその他のクリエイターへの支払配分割合を設定するものとし、Beiはその割合に応じた金額を各クリエイターに支払うものとします。なお、ここで設定された割合に応じた金額は、上記「代金」に関する定めに従い処理されるものとします。</li>
                        <li>退会その他の理由によりクリエイターが本サービスの利用者としての地位を失った場合には、クリエイターは、その時点において未払いの支払金額を受け取る権利を喪失するものとします。</li>
                    </ol>
                    <li>Beiによるプロモーション</li>
                    <ol class="list_parentheses">
                        <li>Beiは、クリエイターやユーザーのみなさんが本サービスに公開したデジタルコンテンツ・プロフィール・コメント等をより多くの方々に楽しんで頂くために、他メディア及びSNSへの転載などの手段を通じて紹介させて頂くことがあります。なお、有料のデジタルコンテンツについては、コンテンツの中の無料公開部分のみキャプチャー画像をご紹介させて頂きます。また、ご紹介の対象となりますのは「設定」画面より「宣伝のための外部サイトへの配信を許諾する」をONにしている方とさせて頂きます。</li>
                        <li>Beiは、デジタルコンテンツ、ユーザー情報、行動履歴等を統計的処理や機械学習などの手法で解析し、リコメンド等のプロモーションに利用することがあります。</li>
                    </ol>
                    <li>デジタルコンテンツ</li>
                    <ol class="list_parentheses">
                        <li>本サービスのプラットフォーム上でクリエイターが配信し、ユーザーが購入することのできるデジタルコンテンツは、Beiが指定するデータ形式またはファイル形式によるデジタルコンテンツに限られます。</li>
                        <li>クリエイターは、自己の責任と負担でデジタルコンテンツを制作するものとします。クリエイターがBeiの指定するウェブインターフェースからアップロードすることにより、Beiが本サービス上で配信し、ユーザーに対し、デジタルコンテンツを販売することを許諾したものとみなします。</li>
                        <li>Beiは、本サービス内でのインデキシングの最適化を目的として、クリエイターがアップロードしたデジタルコンテンツの一部（原則としてタイトルおよびトップページ）を、本サービスが設定する表示アルゴリズムに基づいて変更、切除その他の改変をすることがあります。なお、表示アルゴリズムは、Beiの判断に基づき変更することがあります。</li>
                        <li>Beiは、プラットフォームとしての本サービスのプロモーションを目的として、クリエイターがアップロードしたデジタルコンテンツを、必要な範囲内で無償にて公開させていただくことがあります。</li>
                        <li>Beiは、クリエイターが本サービスを利用する際の利便性を高めるために、オートリンク機能、校正機能などをBeiの裁量で適宜提供するものとし、これらの機能がデジタルコンテンツに適用されることについてクリエイターは異議を唱えないものとします。</li>
                    </ol>
                    <li>定期購読サービス</li>
                    <ol class="list_parentheses">
                        <li>クリエイターは、本サイトでBeiが別途定めるManabeeプレミアム会員サービスを、Beiが定める利用料金を支払うことにより、本利用規約に従って、利用できるものとします。</li>
                        <li>Manabeeプレミアム会員サービスの中の１つのサービスである定期購読サービス（以下「定期購読サービス」といいます。）をご利用できる方は、クリエイターのうちBeiが指定する決済手段を有する方で、本利用規約を遵守できる方とします。</li>
                        <li>定期購読サービスのご利用希望者は本サイト内の所定の方法に従いご利用申請を行うものとします。POCは、ご利用申請内容に基づき審査を行い、ご利用希望者が定期購読サービスを利用いただける状態となったことをもって、ご利用の手続きが完了したものとします。なお、Beiが不適切であると判断した場合には、定期購読サービスをご利用できない場合があります。</li>
                        <li>Manabeeプレミアム会員は、定期購読サービスにより運営するマガジン等のサービスにおけるデジタルコンテンツの更新頻度について、ご利用申請時に申請した通りにデジタルコンテンツを発行するものとします。</li>
                        <li>以下に該当する場合、BeiはManabeeプレミアム会員の定期購読サービスの利用を停止することができるものとし、Beiが悪質であると判断した場合、代金の支払を拒否し、違約金として没収することがあります。</li>
                        <ol class="list_parentheses">
                            <li>定期購読サービスのご利用申請時に申請したコンテンツ内容または更新頻度が著しく異なる場合。</li>
                            <li>Manabeeプレミアム会員からの利用料金の支払がない場合。</li>
                            <li>本利用規約に違反しているとManabeeが判断した場合。</li>
                            <li>ユーザーからの不満・不評・クレームが多く、かつ、定期購読サービスにふさわしくないとBeiが判断した場合。</li>
                            <li>その他、Beiが定期購読サービスの運営に支障が生じると判断した場合。</li>
                        </ol>
                    </ol>
                    <li>禁止事項</li>
                    <ol class="list_parentheses">
                        <li>以下に該当するデジタルコンテンツの掲載、サークルにおける投稿その他本サービスにおける情報の送信は禁止します。</li>
                        <li>盗作、剽窃など、他者の著作権等を侵害しているもの。</li>
                        <li>上記のほか、他者の財産権、著作権・商標権等の知的財産権、肖像権、名誉・プライバシー等を侵害するもの。</li>
                        <li>詐欺やそのおそれがあるもの。</li>
                        <li>アダルト、性的、わいせつ的、暴力的な表現行為、その他過度の不快感を及ぼすおそれのあるもの、およびそれらのサイトへのリンクがあるもの。</li>
                        <li>差別につながる民族・宗教・人種・性別・年齢等に関するもの。</li>
                        <li>自殺、集団自殺、自傷、違法薬物使用、脱法薬物使用等を勧誘・誘発・助長するおそれのあるもの。</li>
                        <li>マルチ商法等、Beiがユーザーに不利益をもたらすと判断する情報商材。</li>
                        <li>株式の銘柄推奨、その他金融商品取引法に抵触するもの。</li>
                        <li>「必ずもうかる」等、ユーザーに著しい誤解を招く表現を用いたもの。</li>
                        <li>コンピュータウィルスその他有害なコンピューター・プログラムを含むもの。</li>
                        <li>オンラインゲーム等のアカウント、キャラクター、アイテム、通貨及び仮想通貨などを譲渡しようとするもの。</li>
                        <li>不当景品類及び不当表示防止法、医薬品、医療機器等の品質、有効性及び安全性の確保等に関する法律、並びに医療法その他の広告に関する法令に違反するもの、またはそのおそれのあるもの。</li>
                        <li>特定の個人、特定のグループまたは組織になりすますもの。</li>
                        <li>マルチ商法等Beiがユーザーに対して不利益をもたらすものであると判断する情報商材の宣伝に直接若しくは間接的に利用するもの。</li>
                        <li>未成年者を犯罪行為またはそのおそれのある行為に勧誘するもの。</li>
                        <li>法令に違反するもの。</li>
                        <li>公序良俗に反するもの。</li>
                        <li>その他、Beiが不適切と判断するもの。</li>
                    </ol>
                    <li>ご利用の停止およびデジタルコンテンツの削除等</li>
                    <p>クリエイターが以下に該当するとBeiが判断した場合、クリエイターに事前に通知することなくBeiはクリエイターのご利用を停止させて頂き、デジタルコンテンツを削除、または検索結果からの除外などの措置をすることがあります。かかる利用の停止またはデジタルコンテンツの削除等によりクリエイターに損害が生じた場合であっても、Beiは損害賠償責任その他一切の責任を負わないものとします。</p>
                    <ol class="list_parentheses">
                        <li>本利用規約に違反しているとBeiが独自に判断した場合。</li>
                        <li>前項の規定に違反するデジタルコンテンツをManabeeに掲載した場合。</li>
                        <li>スパム投稿、スパム行為であるとBeiが判断した場合。</li>
                        <li>反社会的勢力またはそれに準ずるとBeiが独自に判断した場合。</li>
                        <li>掲載したデジタルコンテンツが不適切な内容であるとBeiが独自に判断した場合。</li>
                        <li>本サービスのサーバーに過度に負担をかける場合。</li>
                        <li>本サービスの運営に支障が生じるとBeiが独自に判断した場合。</li>
                    </ol>
                    <li>本利用規約違反の場合の代金不払及び違約金の支払い</li>
                    <ol class="list_parentheses">
                        <li>本利用規約に違反していて、かつ悪質なデジタルコンテンツを販売しているクリエイターまたは悪質な各種サービスの運営をしているクリエイターについては、Beiは販売したコンテンツ代金及び各種サービスの代金の支払いを拒否し、違約金として没収させていただくことがあります。また、決済時に発生した手数料もクリエイターへ請求いたします。なお、既に支払い済みの場合には、返金の請求をさせていただきます。</li>
                        <li>クリエイターが、本利用規約に違反している疑いがあるとBeiが合理的に判断した場合には、BeiはBeiの裁量によりクリエイターに対する代金の支払いを一時差し控えることができ、クリエイターはあらかじめこれを了承するものとします。Beiは、当該措置によりクリエイターに生じた損害について、一切責任を負うものではありません。</li>
                        <li>11.1の規定により、クリエイターがBeiに返金をしなければならない場合、Beiは、Beiの裁量で当該返金の額を、クリエイターに対して支払われるべき金額から控除することができるものとします。</li>
                    </ol>
                    <li>契約の解約等</li>
                    <ol class="list_parentheses">
                        <li>クリエイターとユーザーとの間において、取引契約が成立した後、取消し、解除その他の理由により当該取引契約が効力を失ったときは、Beiは、クリエイターに対して、返金することを請求できるものとします。また、この返金処理を行う場合、Beiは、Beiの裁量で当該返金金額をクリエイターに支払われるべき金額から差し引くことができるものとします。</li>
                        <li>クリエイターとユーザーとの間における取引契約が取消し、解除その他の理由により、効力を失う可能性があるとBeiが合理的に判断した場合には、BeiはBeiの裁量によりクリエイターに対する代金の支払いを一時差し控えることができ、クリエイターはあらかじめこれを了承するものとします。Beiは、当該措置によりクリエイターに生じた損害について、一切責任を負うものではありません。</li>
                        <li>クレジット会社等が、ユーザーのクリエイターに対する代金の支払いにつき、他人のクレジットカードの不正利用等（チャージバック事由）があると判定したときは、Beiは、クリエイターに対して、返金することを請求できるものとします。また、この返金処理を行う場合、Beiは、Beiの裁量で当該返金金額をクリエイターに支払われるべき金額から控除することができるものとします。</li>
                        <li>ユーザーのクレジットカードの不正利用等（チャージバック事由）がある疑いがあるとBeiが合理的に判断した場合には、BeiはBeiの裁量によりクリエイターに対する代金の支払いを一時差し控えることができ、クリエイターはあらかじめこれを了承するものとします。Beiは、当該措置によりクリエイターに生じた損害について、一切責任を負うものではありません。</li>
                    </ol>
                    <li>責任</li>
                    <p>クリエイターは、自己の責任において本サービスを利用するものとし、本サービスを利用してなされた一切の行為およびその結果について一切の責任を負うものとします。</p>
                </ol>
                <h3>Manabeeユーザー規約</h3>
                <ol>
                    <li>購入金額</li>
                    <ol class="list_parentheses">
                        <li>ユーザーがデジタルコンテンツを購入または各種サービスを利用する場合、デジタルコンテンツ購入の対価または各種サービスの対価として、本サービス上の購入申込み画面において表示される金額を、クレジットカード決済あるいはスマートフォン・タブレットアプリ内課金などBeiが定める決済方法のうち、ユーザーが選択した方法により、Beiが課金し徴収することに同意します。</li>
                        <li>同様に「サポート」機能についても、そのデジタルコンテンツの購入の対価として、Beiが定める方法に従いユーザー自らが決定した金額を、上記と同様の方法で支払うことに同意するものとします。</li>
                    </ol>
                    <li>コメントの削除</li>
                    <p>ユーザーは自由にコメント欄にコメントすることができます。ただし、本利用規約に違反している内容であるとBeiが独自に判断した場合、Beiがユーザーのコメントを削除する場合があります。また、クリエイターが独自の判断でユーザーのコメントを削除等する場合があります。Beiはユーザーのコメントが削除等されたことによりユーザーに生じた一切の損害について、損害賠償責任その他の責任を負わないものとします。</p>
                    <li>返金</li>
                    <ol class="list_parentheses">
                        <li> ユーザーは、本サービスおよび取引契約の性質上、Manabeeクリエイター規約12.1に基づき取引契約の解除が認められた場合を除き、Beiに対しお支払いいただいた料金の返金等を受けられないことを了承します。なお、Manabeeクリエイター規約12.1に基づきデジタルコンテンツの取引契約の解約が認められた後にユーザーが当該デジタルコンテンツを再度購入した場合には、ユーザーは再度取引契約の解除をすることができないことを了承します。</li>
                        <li> ゲストユーザーは、3.1の規定にかかわらず、Beiに対しお支払いいただいた料金の返金等を受けることができないことを了承します。</li>
                        <li> ユーザーがManabeeクリエイター規約12.1に基づく返金を濫用したとBeiが判断した場合、ユーザーに事前に通知することなくBeiはユーザーのご利用を停止させて頂くことがあります。かかる利用の停止によりユーザーに損害が生じた場合であっても、Beiは損害賠償責任その他一切の責任を負わないものとします。</li>
                    </ol>
                    <li>責任</li>
                    <p>ユーザーは、自己の責任において本サービスを利用するものとし、本サービスを利用してなされた一切の行為およびその結果について一切の責任を負うものとします。</p>
                </ol>
            </div>
        </div>
    </div>
</section>

@endsection