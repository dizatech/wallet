<?php

namespace Modules\Wallet;

use Illuminate\Support\ServiceProvider;
use Modules\Wallet\Models\UserWalletTransaction;
use Modules\Wallet\Observers\WalletObserver;
use Modules\Wallet\Facades\UserWalletFacade;
use Modules\Wallet\Repositories\UserWalletRepository;

class WalletServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        UserWalletFacade::shouldProxyTo(UserWalletRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
     public function boot()
     {
         $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
         $this->loadViewsFrom(__DIR__ . '/views','wallet');
         $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
         $this->mergeConfigFrom(__DIR__ . '/config/wallet.php', 'wallet');
         $this->publishes([
             __DIR__.'/config/wallet.php' => config_path('wallet.php'),
             __DIR__.'/views/frontWallet/wallet.blade.php' => resource_path('views/vendor/wallet/home/wallet.blade.php'),
             __DIR__.'/views/frontWallet/walletUser.blade.php' => resource_path('views/vendor/wallet/home/walletUser.blade.php'),

             __DIR__.'/views/transaction/create.blade.php' => resource_path('views/vendor/wallet/panel/transaction/create.blade.php'),
             __DIR__.'/views/transaction/index.blade.php' => resource_path('views/vendor/wallet/panel/transaction/index.blade.php'),
             __DIR__.'/views/wallet/create.blade.php' => resource_path('views/vendor/wallet/panel/wallet/create.blade.php'),
             __DIR__.'/views/wallet/edit.blade.php' => resource_path('views/vendor/wallet/panel/wallet/edit.blade.php'),
             __DIR__.'/views/wallet/index.blade.php' => resource_path('views/vendor/wallet/panel/wallet/index.blade.php'),
         ], 'wallet');

         UserWalletTransaction::observe(WalletObserver::class);
         \ModuleMenu::init('wallet');
     }
}
