<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOxxoOrdersTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('oxxo_orders', function (Blueprint $table) {
      $table->id();
      $table->foreignId('user_id')->constrained();
      $table->decimal('amount', 12, 2);
      $table->decimal('fee', 12, 2);
      $table->string('order_id');
      $table->string('charge_id');
      $table->string('bardcode');
      $table->string('reference');
      $table->date('expired_at');
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

    Schema::dropIfExists('oxxo_orders');
  }
}
