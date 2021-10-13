<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserMercadopagoTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('user_mercadopago', function (Blueprint $table) {
      $table->id();
      $table->foreignId('user_id')->constrained();
      $table->string('email');
      $table->string('first_name');
      $table->string('last_name');
      $table->string('customer_id');
      $table->string('description')->default('Puede realizar Pagos para Tagger');
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

    Schema::dropIfExists('user_mercadopago');
  }
}
