<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComplexBalancePaymentsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('complex_balance_payments', function (Blueprint $table) {
      $table->id();
      $table->foreignId('withdrawal_id')->constrained('complex_balance_withdrawals', 'id');
      $table->foreignId('payment_id')->constrained('payments', 'id');
      $table->timestamps();
      $table->softDeletes();
    });

    Schema::enableForeignKeyConstraints();
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::disableForeignKeyConstraints();

    Schema::dropIfExists('complex_balance_payments');
  }
}
