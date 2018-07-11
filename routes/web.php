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

Route::get('/', 'MainController@index');

Route::get('/account/activate/{token}', 'Auth\RegisterController@activate')->name('activate');

Route::get('/merchant/perfectmoney', 'MerchantController@perfectMoney')->name('perfectMoney');



Route::group(['middleware' => 'auth'], function() {
    Route::get('/account/logout', 'Auth\LoginController@logout')->name('logout');
    Route::get('/account/profile', 'Account\AccountController@index')->name('profile');

    Route::group(['middleware' => 'confirm'], function() {
        //changePassword
        Route::get('/account/change', 'Account\AccountController@showChangeForm')->name('changePassword');
        Route::post('/account/change', 'Account\AccountController@change');
        //changeWallet
        Route::get('/account/changewallet', 'Account\AccountController@showChangeWalletForm')->name('changeWallet');
        Route::post('/account/changewallet', 'Account\AccountController@changeWallet');
        //buyTarrif
        Route::get('/buy{id}', 'Account\DashBoardController@showBuyForm')->where('id', '\d+')->name('buy');
        // Route::post('/buy{id}', 'Account\DashBoardController@buy')->where('id', '\d+');
        //history
        Route::get('/account/history', 'Account\DashBoardController@history')->name('history');
        //referals
        Route::get('/account/referals', 'Account\DashBoardController@referals')->name('referals');
        //responce Take Money
        Route::post('/account/profile', 'Account\AccountController@takeMoney')->name('takeMoney');

        //Admin
        Route::group(['middleware' => 'admin', 'prefix' => 'admin'], function() {
            Route::get('/', 'Admin\AdminController@index');
            //addTariff
            Route::get('/add', 'Admin\AdminController@showAddForm')->name('addTarif');
            Route::post('/add', 'Admin\AdminController@add');
            //editTariff
            Route::get('/edit/{id}', 'Admin\AdminController@showEditForm')->where('id', '\d+')->name('editTarif');
            Route::post('/edit/{id}', 'Admin\AdminController@edit')->where('id', '\d+');
            //deleteTariff
            Route::get('/delete/{id}', 'Admin\AdminController@delete')->where('id', '\d+')->name('deleteTarif');
            //history
            Route::get('/history', 'Admin\AdminController@history')->name('historyAdmin');
            //withdraw
            Route::get('/withdraw', 'Admin\AdminController@showWithdrawForm')->name('withdrawAdmin');
            Route::post('/withdraw', 'Admin\AdminController@withdraw');
        });
        
    });
});

Route::group(['middleware' => 'guest'], function() {
    //Register
    Route::get('/account/register/{ref?}', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('/account/register/{ref?}', 'Auth\RegisterController@register');
    //Login
    Route::get('/account/login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('/account/login', 'Auth\LoginController@login');
    //ForgetAccount
    Route::get('/account/forget', 'Account\AccountController@showForgetForm')->name('forget');
    Route::post('/account/forget', 'Account\AccountController@forget');

    Route::get('/account/forget/{token}', 'Account\AccountController@showRecoveryForm')->name('recovery');
    Route::post('/account/forget/{token}', 'Account\AccountController@recovery');
});
