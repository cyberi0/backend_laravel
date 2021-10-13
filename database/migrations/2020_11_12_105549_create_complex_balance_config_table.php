<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComplexBalanceConfigTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('complex_balance_config', function (Blueprint $table) {
      $table->id();
      $table->foreignId('complex_id')->unique()->constrained();
      $table->decimal('percentage', 12, 2)->default(4.49);
      $table->decimal('fixed', 12, 2)->default(8);
      $table->enum('client', [0, 1])->default(0)->comment('Si es 0, se le cargará la comisión al Complejo. Si es 1, se le cargará al cliente.');
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

    Schema::dropIfExists('complex_balance_config');
  }
}
