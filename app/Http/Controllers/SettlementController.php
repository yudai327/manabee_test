<?php

namespace App\Http\Controllers;

use App\Item;
use App\User;
use App\Settlement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Vendor\Autoload;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Mail\SettlementSendMail;
use App\Mail\Settlement2SendMail;
use Illuminate\Support\Facades\Mail;

class SettlementController extends Controller
{

	public function index($id)
    {
		// ロケーション調べ --start--
		// テスト環境
/*
		$access_token = 'EAAAEFDuywsFtazpaTCIQJ62vNnG5-93h99fOePPwNPBlIDDN16XLUV7AS67pnBp';	//本番
//		$access_token = 'EAAAEGgRIUBImTdouob-6SeQHgI8rGOB6bPOIgq_a3ce0AZ-IO4JvPk5q9WkBN-N';	//テスト
		# setup authorization
		$api_config = new \SquareConnect\Configuration();
		$api_config->setHost("https://connect.squareup.com");			//本番
//		$api_config->setHost("https://connect.squareupsandbox.com");	//テスト
		$api_config->setAccessToken($access_token);
		$api_client = new \SquareConnect\ApiClient($api_config);
		# create an instance of the Location API
		$locations_api = new \SquareConnect\Api\LocationsApi($api_client);

		$locations = $locations_api->listLocations();
		print_r($locations->getLocations());
		exit;
*/
		// ローカル本番 0B3G21S64S89N
		// ローカルテスト 8PYXDAN9XJGN7
		// --end--
		$item = Item::findOrFail($id);
        return view('settlement.index', compact('item'));
    }

	public function post(Request $request, $id)
    {
		// 決済済みか検索用
		$count = Settlement::where([
			['item_id', $id],
			['user_id', Auth::id()]
		])->count();

		if($count){
			$message = "既に決済済みです。";
			return view('message.index', compact('message'));
		}

		$access_token = config('const.settlement_access_token');
		$api_config = new \SquareConnect\Configuration();
		$api_config->setHost(config('const.settlement_host'));
		$api_config->setAccessToken($access_token);
		$api_client = new \SquareConnect\ApiClient($api_config);

		$nonce = $_POST['nonce'];
		$item = Item::findOrFail($id);

		$payments_api = new \SquareConnect\Api\PaymentsApi($api_client);

		$request_body = array (
		  "source_id" => $nonce,
		  "amount_money" => array (
		    "amount" => $item->price,
		    "currency" => "JPY"
		  ),
		  "idempotency_key" => uniqid()
		);

		try {
		  $result = $payments_api->createPayment($request_body);
		} catch (\SquareConnect\ApiException $e) {
			$message = "決済処理が失敗しました。";
			return view('message.index', compact('message'));
		}

		$card_detail = $result['payment']['card_details']['card'];

		$settlement = new Settlement;
		$data = array();
		$data['user_id'] = Auth::id();
		$data['item_id'] = $id;
		$data['payment_id'] = 1;	//$result['payment'] ...?;
		$data['price'] = $item->price;
		$data['settlement_fee'] = intval($item->price * 0.0325);//square決済手数料　３.２５％ 小数点以下切り捨て
		$data['platform_fee'] = intval(($item->price - $data['settlement_fee']) * 0.1);// （売上-スクエア決済手数料）＊プラットフォーム手数料　１０％　小数点以下切り捨て
		$data['brand'] = $card_detail['card_brand'];
		$data['last_4'] = $card_detail['last_4'];
		$settlement->fill($data)->save();
		// 追加-------ステータス関係-----
		$now = Carbon::now();
		$s_user = $settlement->user_id;//購入者
		$i_user = $item->user_id;//出品者
		$push_data = [
			['status' => 1, 'item_id' => $id, 'user_id' => $s_user, 'created_at' => $now, 'updated_at' => $now],
			['status' => 3, 'item_id' => $id, 'user_id' => $i_user, 'created_at' => $now, 'updated_at' => $now],
		];
		DB::table('pushes')
			->insert($push_data);
		// ここまで追加-------ステータス関係-----

		//メール　購入者、出品者両方に購入されたら送信
		$user_1 = User::findOrFail($s_user);//購入者
		$user_2 = User::findOrFail($i_user);//出品者
		Mail::to($user_1->email)->send(new SettlementSendMail($user_1['nickname'], $user_2['nickname'], $now, $item, $data));//購入者へ送るメール
		Mail::to($user_2->email)->send(new Settlement2SendMail($user_1['nickname'], $user_2['nickname'], $now, $item, $data));//出品者へ送るメール
		// ここまでメール関係



		return redirect('/item/view/'.$id);

    }

}
