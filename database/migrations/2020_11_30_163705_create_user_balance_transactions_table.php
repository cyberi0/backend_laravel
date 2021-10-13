<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserBalanceTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_balance_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('balance_id')->constrained('user_balances', 'id');
            $table->foreignId('payment_id')->constrained('payments', 'id');
            $table->enum('type', [1, 2]);
            $table->decimal('amount',12,2);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_balance_transactions', function (Blueprint $table) {
            //
        });
    }
}
