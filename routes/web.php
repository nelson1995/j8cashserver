<?php

use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AirtimeController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\TransferController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\ExchangeRateController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;


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
Route::get('/', [LoginController::class,'showLoginForm'])->name('login');
Route::post('/', [LoginController::class,'login'])->name('postlogin');

// Registration routes ...
Route::get('register', [RegisterController::class,'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class,'register'])->name('postregister');

// Password reset routes ... 
Route::get('password/reset', [ForgotPasswordController::class,'showLinkRequestForm'])->name('password.reset');
Route::post('password/email', [ForgotPasswordController::class,'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class,'showResetForm'])->name('password.reset.token');
Route::post('password/reset', [ResetPasswordController::class,'reset'])->name('password.update');

Route::group(['middleware'=>['role:super-administrator|administrator']],function(){
    Route::middleware(['auth:web'])->group(function (){
        Route::get('logout', [LoginController::class,'logout'])->name('logout');
        Route::get('/home',[DashboardController::class,'index'])->name('home');
        Route::get('/home/charts',[DashboardController::class,'charts'])->name('charts');

        Route::get('/deposits',[DepositController::class,'index'])->name('deposits');
        Route::get('/airtime',[AirtimeController::class, 'index'])->name('airtime');
        Route::get('/transfers',[TransferController::class,'index'])->name('transfers');
        Route::get('/withdraws', [WithDrawController::class,'index'])->name('withdraws');

        Route::get('/user', [UserController::class,'index'])->name('user');
        Route::get('/users',[UserController::class, 'showUsers'])->name('users');
        Route::get('/users/edit/{id}',[UserController::class,'edit'])->name('edit_user');
        Route::post('/users/update',[UserController::class,'update'])->name('update_user');
        Route::get('/users/delete/{id}',[UserController::class,'destroy'])->name('delete_user');
        Route::get('/users',[UserController::class,'showUsers'])->name('users');
        Route::get('/users/editUser/{id}',[UserController::class, 'editUser'])->name('edit_users');
        Route::post('/users/update_user',[UserController::class,'updateUser'])->name('update_usr');
        
        Route::get('/agents', [UserController::class,'showAgents'])->name('agents');
        Route::get('/agents/edit/{id}', [UserController::class,'editAgent'])->name('edit_agent');
        Route::post('/agents/update', [UserController::class,'updateAgent'])->name('update_agent');

        Route::get('/exchange_rates', [ExchangeRateController::class,'index'])->name('exchange_rates');
        Route::get('/exchange_rates/create', [ExchangeRateController::class,'create'])->name('create_exchangerates');
        Route::post('/exchange_rates/store', [ExchangeRateController::class,'store'])->name('store_exchangerates');
        Route::get('/exchange_rates/edit/{id}', [ExchangeRateController::class,'edit'])->name('edit_exchangerate');
        Route::post('/exchange_rates/update',[ExchangeRateController::class,'update'])->name('update_forex');
        Route::get('/exchange_rates/delete/{id}',[ExchangeRateController::class,'destroy'])->name('delete_exchangerate');

        Route::group(['middleware'=>['role:super-administrator']],function(){
            Route::get('/roles', [RoleController::class,'index'])->name('roles');
            Route::get('/roles/create',[RoleController::class,'create'])->name('create_role');
            Route::post('/roles/store', [RoleController::class,'store'])->name('store_role');
            Route::get('/roles/edit/{id}',[RoleController::class,'edit'])->name('edit_roles');
            Route::post('/roles/update', [RoleController::class,'update'])->name('update_roles');
            Route::get('/roles/delete/{id}', [RoleController::class,'destroy'])->name('delete_roles');
            Route::get('/permission', [PermissionsController::class,'index'])->name('permissions');
            Route::get('/permission/create', [PermissionsController::class,'create'])->name('create_permission');
            Route::post('create', [PermissionsController::class,'store'])->name('store_permission');
            Route::get('/permission/edit/{id}', [PermissionsController::class,'edit'])->name('edit_permission');
            Route::post('/permission/update', [PermissionsController::class,'update'])->name('update_permission');
            Route::get('/permission/delete/{id}', [PermissionsController::class,'destroy'])->name('delete_permission');
        }); 
    });
});


