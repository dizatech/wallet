<?php

namespace Wallet;

use Illuminate\Support\ServiceProvider;
use Wallet\Models\UserWalletTransaction;
use Wallet\Observers\WalletObserver;

class WalletServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
     public function boot()
     {
         $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
         $this->loadViewsFrom(__DIR__ . '/views','mahamaxWallet');
         $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
         $this->mergeConfigFrom(__DIR__ . '/config/wallet.php', 'wallet');
//         $this->publishes([
//                __DIR__.'/config/mahamaxWallet.php' =>config_path('mahamaxWallet')
//         ], 'mahamaxWallet');

         UserWalletTransaction::observe(WalletObserver::class);
         \ModuleMenu::init('mahamaxWallet');
     }
}
