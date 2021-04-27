<?php

namespace Wallet\database\seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WalletPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (DB::table('permissions')->where('name','wallet')->count() == 0){
            DB::table('permissions')->insert([
                'name' => 'wallet',
                'display_name' => 'کیف پول',
                'description' => 'دسترسی به کیف پول',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString()
            ]);
        }

        if (DB::table('permissions')->where('name','wallet_manage')->count() == 0){
            DB::table('permissions')->insert([
                'name' => 'wallet_manage',
                'display_name' => 'مدیریت کیف پول',
                'description' => 'دسترسی به مدیریت کیف پول',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString()
            ]);
        }


        if (DB::table('permissions')->where('name','transaction_index')->count() == 0){
            DB::table('permissions')->insert([
                'name' => 'transaction_index',
                'display_name' => 'لیست تراکنش‌ها',
                'description' => 'دسترسی به لیست لیست تراکنش‌ها',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString()
            ]);
        }

    }
}
