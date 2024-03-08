<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AirtimeController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\TransferController;
use App\Http\Controllers\WithDrawController;
use App\Http\Controllers\TransactionsController;
use App\Http\Controllers\PaymentMethodController;

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

Route::post('login', [UserController::class,'login']);
Route::post('register', [UserController::class,'register']);
Route::post('verify_phone', [UserController::class,'verify_phone']);
Route::post('confirm_code', [UserController::class,'confirm_code']);
Route::post('create_pin', [UserController::class,'create_pin']);

Route::get('payment_methods/{id}', [PaymentMethodController::class,'get_payment_methods']);

Route::post('callback_url', [WithDrawController::class,'callBack']);

Route::post('callback_url_deposit',[DepositController::class,'callback']);

Route::group(['middleware' => 'auth:api'], function() {
    Route::get('profile', [UserController::class,'profile']);
    Route::post('update_profile', [UserController::class,'update_profile']);
    Route::get('wallet', [UserController::class,'wallet']);
    Route::post('deposit', [DepositController::class,'make_deposit']);
    Route::get('get_deposits', [DepositController::class,'get_deposits']);
    Route::post('send', [TransferController::class,'send']);
    Route::get('get_transfers', [TransferController::class,'get_transfers']);
    Route::get('get_received', [TransferController::class,'get_received']);
    Route::post('change_pin', [UserController::class,'change_pin']);
    Route::post('reward_points',[UserController::class,'rewardPoints']);
    Route::get('users', [UserController::class,'get_users']);
    Route::post('buy_airtime', [AirtimeController::class,'buy']);
    Route::get('get_airtime', [AirtimeController::class, 'get_airtime_list']);
    Route::get('recent_transactions', [TransactionsController::class, 'recentTransactions']);
    Route::post('withdraw',[WithDrawController::class,'withDraw']);
    Route::get('get_withdraws', [WithDrawController::class,'getWithDraws']);
});
