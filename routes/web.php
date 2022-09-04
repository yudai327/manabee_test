<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Yutudemy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Push;



Route::get('/', 'TopController@index')->name('index');
// Route::get('/', 'TopController@search')->name('index');
// Route::get('/course/{id}', 'CourseController@index')->name('course');
// Route::post('/course/{id}', 'CourseController@store')->name('course');
Route::get('/profile', 'ProfileController@index')->name('profile');
Route::get('/userpages/{id}', 'UserPageController@index')->name('userpages');
Route::get('/manual/privacy', 'ManualController@privacy')->name('privacy');
Route::get('/manual/terms', 'ManualController@terms')->name('terms');
Route::get('/manual/transaction', 'ManualController@transaction')->name('transaction');
Route::get('/manual/faq', 'ManualController@faq')->name('faq');
Route::get('/manual/sample', 'ManualController@sample')->name('sample');



//入力ページ
Route::get('/contacts', 'ContactController@index')->name('contacts.index');
//確認ページ
Route::post('/contacts/confirm', 'ContactController@confirm')->name('contacts.confirm');
//送信完了ページ
Route::post('/contacts/thanks', 'ContactController@thanks')->name('contacts.thanks');

Route::get('/item/view/{id}', 'ItemViewController@index')->name('item.view');
Route::post('/item/view/{id}', 'ItemViewController@store')->name('item.view');

Route::get('/item/detail/{id}', 'ItemDetailController@index')->name('item.detail');

Route::post('/item/ajaxlike', 'AjaxLikeItemController@ajaxlike')->name('item.ajaxlike');

Route::get("reset/{token}", "ChangeEmailController@reset");

Auth::routes(['verify' => true]);

Route::get('/login/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('login/{provider}/callback', 'Auth\LoginController@handleProviderCallback');


Route::middleware('verified')->group(function() {
    // 本登録ユーザーだけ表示できるページ
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/push', 'HomeController@push')->name('push');
    Route::get('/change', 'HomeController@change')->name('change');
    Route::post('/delete', 'HomeController@deleteUser')->name('home.delete_user');
    Route::post('/delete/thanks', 'HomeController@thanks')->name('home.thanks');
    Route::get('/home/{page}', 'HomeController@useredit')->name('home.edit');
    Route::post('/home/{id}', 'HomeController@update')->name('home.update');
    Route::post('/email', 'ChangeEmailController@sendChangeEmailLink');
    Route::post('/changepassword', 'ChangePasswordController@changePassword');
    // Route::resource('home', 'HomeController',['except' => ['edit']]);
    Route::get('/item/regist', 'ItemRegistController@index')->name('item.regist');
    Route::post('/item/regist', 'ItemRegistController@post')->name('regist');
    Route::get('/item/edit/{id}', 'ItemRegistController@edit')->name('item.edit');
    Route::post('/item/update', 'ItemRegistController@update')->name('item.update');
    Route::post('/item/delete', 'ItemRegistController@delete')->name('item.delete');
    Route::get('/favorited/{id}', 'FavoriteItemController@index')->name('favoritedMovie');
    Route::get('/purchased/{id}', 'PurchasedMovieController@index')->name('PurchasedMovie');
    Route::get('/posted/{id}', 'PostMovieController@index')->name('PostMovie');
    Route::get('/settlement/{id}', 'SettlementController@index')->name('settlement');
    Route::post('/settlement/{id}', 'SettlementController@post');
    Route::get('/transfer/{id}', 'TransferController@index')->name('transfer');
    Route::get('/transfer/form/{id}', 'TransferController@form')->name('transfer.form');
    Route::post('/transfer/{id}', 'TransferController@store')->name('transfer.store');
    Route::get('/sales/{id}', 'SalesController@sales')->name('sales');
    Route::get('/sales/request/{id}', 'SalesController@request')->name('sales.request');
    Route::post('/sales/request/{id}', 'SalesController@post')->name('sales.request');
    Route::get('/sales/item/{id}/{item_id}', 'SalesController@item')->name('sales.item');
    Route::post('/sales/{id}', 'SalesController@store')->name('sales.store');
    Route::get('/transfer/edit/{id}', 'TransferController@edit')->name('transfer.edit');
    Route::post('/transfer/update/{id}', 'TransferController@update')->name('transfer.update');
    Route::post('/read', 'PushReadController@index')->name('read');
});

//管理側
Route::group(['middleware' => ['auth.admin']], function () {

    //管理側トップ
    Route::get('/admin', 'admin\AdminTopController@show')->name('admin.index');
    //ログアウト実行
    Route::post('/admin/logout', 'admin\AdminLogoutController@logout');
    //ユーザー一覧
    Route::get('/admin/user_list', 'admin\ManageUserController@showUserList');
    //退会ユーザー一覧
    Route::get('/admin/delete_user_list', 'admin\ManageDeleteUserController@showUserList');
    //ユーザー詳細
    Route::get('/admin/user/{id}', 'admin\ManageUserController@showUserDetail');
    Route::get('/admin/user/sales_item/{id}/{item_id}', 'admin\ManageUserSalesController@item')->name('admin.sales_item');
    Route::get('/admin/user/sales_detail/{id}', 'admin\ManageUserSalesController@sales')->name('admin.user_sales_detail');

    //投稿動画一覧
    Route::get('/admin/item_list', 'admin\ManageItemController@showItemList');
    //投稿動画詳細
    Route::get('/admin/item/{id}', 'admin\ManageItemController@showItemDetail');

    //お知らせ通知
    Route::get('/admin/push_list', 'admin\ManagePushController@list')->name('admin.push_list');
    Route::get('/admin/push', 'admin\ManagePushController@show');
    Route::post('/admin/push', 'admin\ManagePushController@post')->name('admin.push');

    //振込依頼管理
    Route::get('/admin/transfer_list', 'admin\ManageTransferController@list')->name('admin.transfer_list');
    Route::get('/admin/transfer/{id}', 'admin\ManageTransferController@transfer')->name('admin.transfer');
    Route::post('/admin/transfer', 'admin\ManageTransferController@post')->name('admin.transfer_post');

});

//管理側ログイン
Route::get('/admin/login', 'admin\AdminLoginController@showLoginform');
Route::post('/admin/login', 'admin\AdminLoginController@login');