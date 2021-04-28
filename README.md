# Laravel Wallet Package
[![GitHub issues](https://img.shields.io/github/issues/dizatech/wallet?style=flat-square)](https://github.com/dizatech/wallet/issues)
[![GitHub stars](https://img.shields.io/github/stars/dizatech/wallet?style=flat-square)](https://github.com/dizatech/wallet/stargazers)
[![GitHub forks](https://img.shields.io/github/forks/dizatech/wallet?style=flat-square)](https://github.com/dizatech/wallet/network)
[![GitHub license](https://img.shields.io/github/license/dizatech/wallet?style=flat-square)](https://github.com/dizatech/wallet/blob/master/LICENSE)


A laravel package for wallet transaction

## How to install and config [dizatech/wallet](https://github.com/dizatech/wallet) package?

#### Installation

```
PHP Package:
composer require dizatech/wallet


packagist : https://packagist.org/packages/dizatech/wallet
```
#### Publish Config file
```
php artisan vendor:publish --provider="dizatech/wallet"
php artisan vendor:publish --tag=wallet
```

#### Migrate tables, to add wallet and wallet tables to database
```
php artisan migrate
```
#### seed tables
```
/*add to DatabaseSeeder  the following lines to function run 
     WalletMenuSeeder::class,
     WalletMenuPermissionsSeeder::class,
     WalletPermissionsSeeder::class,
     WalletRolePermissionsSeeder::class
*/

php artisan db:seed
```
#### require
```
        "php": "^7.2",
        "laravel/framework": "7.*|8.*|9.*",
        "dizatech/module-menu": "^1.0"
    
```