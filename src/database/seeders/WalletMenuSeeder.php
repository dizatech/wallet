<?php

namespace Wallet\database\seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WalletMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (DB::table('module_menus')->where('name','wallet')->count() == 0){
            $wallet = DB::table('module_menus')->insertGetId([
                'name' => 'wallet',
                'title' => 'کیف پول',
                'icon' => 'fa fa-money',
                'route' => 'wallet.index',
                'parent_id' => '0',
                'creator_id' => '1',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
                'deleted_at' => null,
            ]);
        }

        if (DB::table('module_menus')->where('name','wallet_manage')->count() == 0){
            DB::table('module_menus')->insert([
                'name' => 'wallet_manage',
                'title' => 'مدیریت کیف پول',
                'icon' => 'fa fa-circle-o',
                'route' => 'wallet.index',
                'parent_id' => $wallet,
                'creator_id' => '1',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
                'deleted_at' => null,
            ]);
        }


        if (DB::table('module_menus')->where('name','transaction_index')->count() == 0){
            DB::table('module_menus')->insert([
                'name' => 'transaction_index',
                'title' => 'تراکنش‌ها',
                'icon' => 'fa fa-circle-o',
                'route' => 'transaction.index',
                'parent_id' => $wallet,
                'creator_id' => '1',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
                'deleted_at' => null,
            ]);
        }

    }
}
