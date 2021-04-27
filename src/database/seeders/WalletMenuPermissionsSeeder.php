<?php

namespace Modules\Wallet\database\seeders;

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
        $wallet = ModuleMenu::where('name', 'wallet')->first();
        $wallet_manage = ModuleMenu::where('name', 'wallet_manage')->first();
        $transaction_index = ModuleMenu::where('name', 'transaction_index')->first();

        $wallet->permissions()->sync(Permission::where('name', 'wallet')->pluck('id'));
        $wallet_manage->permissions()->sync(Permission::where('name', 'wallet_manage')->pluck('id'));
        $transaction_index->permissions()->sync(Permission::where('name', 'transaction_index')->pluck('id'));

    }
}
