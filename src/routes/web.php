<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'namespace' => 'Modules\Wallet\Http\Controllers',
    'prefix'    => 'panel',
    'middleware'=> ['web', 'auth', 'verified']
],function () {
    Route::resource('wallet', 'WalletController');
    Route::resource('transaction', 'UserWalletTransactionController');
});
Route::group([
    'namespace' => 'Modules\Wallet\Http\Controllers',
    'prefix' => 'account',
    'middleware' => ['web', 'auth', 'verified']
], function (){
    Route::get('wallet/withdraw', 'WithdrawController@index')->name('account.wallet.withdraw.index');
    Route::get('wallet', 'UserWalletTransactionController@walletsIndex')->name('account.walletsIndex');
    Route::get('wallet/{id}', 'UserWalletTransactionController@wallet')->name('account.wallet');
    Route::get('wallet/{user_wallet}/withdraw/create', 'WithdrawController@create')->name('account.wallet.withdraw.create');
    Route::post('wallet/{user_wallet}/withdraw/create', 'WithdrawController@store')->name('account.wallet.withdraw.store');
});
