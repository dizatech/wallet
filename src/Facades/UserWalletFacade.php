<?php

namespace Modules\Wallet\Facades;

/**
 * @class \Modules\Wallet\Facades\OrderFacade
 *
 * @method static array all()
 * @method static array allWithPaginate()
 * @method static array getActive()
 * @method static Modules\Wallet\Models\UserWalletTansaction withdraw(Modules\Wallet\Models\UserWallet $user_wallet, int $amount, string $description='')
 * @method static Modules\Wallet\Models\UserWalletTansaction deposit(Modules\Wallet\Models\UserWallet $user_wallet, int $amount, int $wallet_id, int $user_id, string $description='')
 *
 *
 * @see \Modules\Wallet\Repositories\UserWalletRepository
 */
class UserWalletFacade extends BaseFacade
{
}
