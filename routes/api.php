<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', 'UserController@login');
Route::post('register', 'UserController@register');
Route::post('verify_phone', 'UserController@verify_phone');
Route::post('confirm_code', 'UserController@confirm_code');
Route::post('create_pin', 'UserController@create_pin');

Route::get('payment_methods/{id}', 'PaymentMethodController@get_payment_methods');

Route::post('callback_url','WithDrawController@callBack');

Route::post('callback_url_deposit','DepositController@callback');

Route::group(['middleware' => 'auth:api'], function() {
    Route::get('profile', 'UserController@profile');
    Route::post('update_profile', 'UserController@update_profile');
    Route::get('wallet', 'UserController@wallet');
    Route::post('deposit', 'DepositController@make_deposit');
    Route::get('get_deposits', 'DepositController@get_deposits');
    Route::post('send', 'TransferController@send');
    Route::get('get_transfers', 'TransferController@get_transfers');
    Route::get('get_received', 'TransferController@get_received');
    Route::post('change_pin', 'UserController@change_pin');
    Route::post('reward_points', 'UserController@rewardPoints');
    Route::get('users', 'UserController@get_users');
    Route::post('buy_airtime', 'AirtimeController@buy');
    Route::get('get_airtime', 'AirtimeController@get_airtime_list');
    Route::get('recent_transactions','TransactionsController@recentTransactions');
    Route::post('withdraw','WithDrawController@withDraw');
    Route::get('get_withdraws','WithDrawController@getWithDraws');
});
