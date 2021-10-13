<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOxxoOrderPaymentsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('oxxo_order_payments', function (Blueprint $table) {
      $table->id();
      $table->foreignId('order_id')->constrained('oxxo_orders', 'id');
      $table->foreignId('payment_id')->constrained();
      $table->timestamps();
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

    Schema::dropIfExists('oxxo_order_payments');
  }
}
