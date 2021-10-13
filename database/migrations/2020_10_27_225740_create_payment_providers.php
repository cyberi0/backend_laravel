<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentProviders extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('payment_providers', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->string('description');
      $table->enum('default', [0, 1])->default(1);
      $table->timestamps();
      $table->softDeletes();
    });

    Schema::table('payments', function (Blueprint $table) {
      $table->foreignId('provider_id')->after('account_id')->nullable()->references('id')->on('payment_providers');
    });

    Schema::table('payments', function (Blueprint $table) {
      $table->string('cdr')->after('registered_by')->nullable();
    });

    Schema::table('payments', function (Blueprint $table) {
      $table->string('reference')->after('cdr')->nullable();
    });

    Schema::table('payments', function (Blueprint $table) {
      $table->decimal('fee', 12, 2)->after('paid')->nullable();
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

    Schema::dropIfExists('payment_providers');
  }
}
