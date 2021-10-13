<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComplexBalanceAccountsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('complex_balance_accounts', function (Blueprint $table) {
      $table->id();
      $table->foreignId('complex_id')->constrained();
      $table->foreignId('bank_id')->constrained();
      $table->string('owner', 255);
      $table->string('interbank', 255);
      $table->string('number', 255)->nullable()->default(NULL);
      $table->string('branch', 255)->nullable()->default(NULL);
      $table->string('card', 255)->nullable()->default(NULL);
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

    Schema::dropIfExists('complex_balance_accounts');
  }
}
