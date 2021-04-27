<?php

namespace Modules\MahamaxWallet\database\seeders;

use App\Models\Permission;
use Dizatech\ModuleMenu\Models\ModuleMenu;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WalletMenuPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mahamaxWallet = ModuleMenu::where('name', 'mahamaxWallet')->first();
        $mahamax_Wallet_manage = ModuleMenu::where('name', 'mahamax_wallet_manage')->first();
        $mahamax_transaction_index = ModuleMenu::where('name', 'mahamax_transaction_index')->first();

        $mahamaxWallet->permissions()->sync(Permission::where('name', 'mahamax_wallet')->pluck('id'));
        $mahamax_Wallet_manage->permissions()->sync(Permission::where('name', 'mahamax_wallet_manage')->pluck('id'));
        $mahamax_transaction_index->permissions()->sync(Permission::where('name', 'mahamax_transaction_index')->pluck('id'));

    }
}
