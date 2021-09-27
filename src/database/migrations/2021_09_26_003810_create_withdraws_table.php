<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWithdrawsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('withdraws', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_wallet_id');
            $table->decimal('amount', 13, 2);
            $table->string('bank_name');
            $table->string('iban')->nullable();
            $table->string('pan')->nullable();
            $table->string('acc_num')->nullable();
            $table->enum('status', ['pending', 'cancelled', 'rejected', 'completed'])->default('pending');
            $table->text('description')->nullable();
            $table->text('admin_note')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('withdraws');
    }
}
