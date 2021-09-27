<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'namespace' => 'Modules\Wallet\Http\Controllers',
    'prefix'    => 'panel',
    'middleware'=> ['web', 'auth', 'verified']
],function () {
    Route::get('wallet/withdraw', 'WithdrawAdminController@index')->name('wallet.withdraw.index');
    Route::patch('wallet/withdraw/{withdraw}/ajax_cancel', 'WithdrawAdminController@cancel')->name('wallet.withdraw.cancel');
    Route::patch('wallet/withdraw/{withdraw}/ajax_complete', 'WithdrawAdminController@complete')->name('wallet.withdraw.complete');
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
