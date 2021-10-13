<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserCardsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('user_cards', function (Blueprint $table) {
      $table->id();
      $table->foreignId('user_id')->nullable()->constrained();
      $table->foreignId('provider_id')->nullable()->references('id')->on('payment_providers');
      $table->string('brand')->nullable();
      $table->string('digits')->nullable();
      $table->string('bank')->nullable();
      $table->text('data')->nullable();
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

    Schema::dropIfExists('user_cards');
  }
}
