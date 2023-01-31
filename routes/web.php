<?php

use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;

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
// Authentication routes ...
Route::get('/', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/', 'Auth\LoginController@login')->name('postlogin');

// Registration routes ...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register')->name('postregister');

// Password reset routes ... 
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset.token');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

Route::group(['middleware'=>['role:super-administrator|administrator']],function(){
    Route::middleware(['auth:web'])->group(function (){
        Route::get('logout', 'Auth\LoginController@logout')->name('logout');
        Route::get('/home','DashboardController@index')->name('home');
        Route::get('/home/charts','DashboardController@charts')->name('charts');

        Route::get('/deposits','DepositController@index')->name('deposits');
        Route::get('/airtime','AirtimeController@index')->name('airtime');
        Route::get('/transfers','TransferController@index')->name('transfers');
        Route::get('/withdraws','WithDrawController@index')->name('withdraws');

        Route::get('/user','UserController@index')->name('user');
        Route::get('/users','UserController@showUsers')->name('users');
        Route::get('/users/edit/{id}','UserController@edit')->name('edit_user');
        Route::post('/users/update','UserController@update')->name('update_user');
        Route::get('/users/delete/{id}','UserController@destroy')->name('delete_user');
        Route::get('/users','UserController@showUsers')->name('users');
        Route::get('/users/editUser/{id}','UserController@editUser')->name('edit_users');
        Route::post('/users/update_user','UserController@updateUser')->name('update_usr');
        
        Route::get('/agents','UserController@showAgents')->name('agents');
        Route::get('/agents/edit/{id}','UserController@editAgent')->name('edit_agent');
        Route::post('/agents/update','UserController@updateAgent')->name('update_agent');

        Route::get('/exchange_rates','ExchangeRateController@index')->name('exchange_rates');
        Route::get('/exchange_rates/create','ExchangeRateController@create')->name('create_exchangerates');
        Route::post('/exchange_rates/store','ExchangeRateController@store')->name('store_exchangerates');
        Route::get('/exchange_rates/edit/{id}','ExchangeRateController@edit')->name('edit_exchangerate');
        Route::post('/exchange_rates/update','ExchangeRateController@update')->name('update_forex');
        Route::get('/exchange_rates/delete/{id}','ExchangeRateController@destroy')->name('delete_exchangerate');

        Route::group(['middleware'=>['role:super-administrator']],function(){
            Route::get('/roles','RoleController@index')->name('roles');
            Route::get('/roles/create','RoleController@create')->name('create_role');
            Route::post('/roles/store','RoleController@store')->name('store_role');
            Route::get('/roles/edit/{id}','RoleController@edit')->name('edit_roles');
            Route::post('/roles/update','RoleController@update')->name('update_roles');
            Route::get('/roles/delete/{id}','RoleController@destroy')->name('delete_roles');
            Route::get('/permission','PermissionsController@index')->name('permissions');
            Route::get('/permission/create','PermissionsController@create')->name('create_permission');
            Route::post('create','PermissionsController@store')->name('store_permission');
            Route::get('/permission/edit/{id}','PermissionsController@edit')->name('edit_permission');
            Route::post('/permission/update','PermissionsController@update')->name('update_permission');
            Route::get('/permission/delete/{id}','PermissionsController@destroy')->name('delete_permission');
        }); 
    });
});


