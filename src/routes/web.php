<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'namespace' => 'Wallet\Http\Controllers',
    'prefix'    => 'panel',
    'middleware'=> ['web', 'auth', 'verified']
],function () {
    Route::resource('wallet', 'WalletController');
    Route::resource('transaction', 'UserWalletTransactionController');
});
Route::group([
    'namespace' => 'Wallet\Http\Controllers',
    'prefix' => 'account',
    'middleware' => ['web', 'auth', 'verified']
], function (){
    Route::get('account/wallet', 'UserWalletTransactionController@walletsIndex')->name('account.walletsIndex');
    Route::get('account/wallet/{id}', 'UserWalletTransactionController@wallet')->name('account.wallet');
});
