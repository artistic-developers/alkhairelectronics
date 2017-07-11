<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserRightsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_rights', function(Blueprint $table)
        {
            $table->increments('right_id');
            $table->integer('user_id')->unique();
            $table->tinyInteger('purchase_book')->default(1);
            $table->tinyInteger('reciept_book')->default(1);
            $table->tinyInteger('payment_voucher')->default(1);
            $table->tinyInteger('journal_voucher')->default(1);
            $table->tinyInteger('assets_ledger')->default(1);
            $table->tinyInteger('expenses_ledger')->default(1);
            $table->tinyInteger('liabilities_ledger')->default(1);
            $table->tinyInteger('capital_ledger')->default(1);
            $table->tinyInteger('stock_ledger')->default(1);
            $table->tinyInteger('account_ledger')->default(1);
            $table->tinyInteger('stock_manager')->default(1);
            $table->tinyInteger('trial_balance')->default(1);
            $table->tinyInteger('income_statement')->default(1);
            $table->tinyInteger('trial_balance_ageing')->default(1);
            $table->tinyInteger('balance_sheet')->default(1);
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
        Schema::dropIfExists('user_rights');
    }
}
