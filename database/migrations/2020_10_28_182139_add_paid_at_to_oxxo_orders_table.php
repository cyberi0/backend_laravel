<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPaidAtToOxxoOrdersTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('oxxo_orders', function (Blueprint $table) {
      $table->dateTime('paid_at')->nullable()->default(NULL);
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('oxxo_orders', function (Blueprint $table) {
      //
    });
  }
}
