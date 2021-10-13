<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddChargeColumnToPaymentsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('payments', function (Blueprint $table) {
      $table->decimal('charge', 12, 2)->after('fee')->nullable();
      $table->decimal('paid', 12, 2)->nullable()->default(NULL)->change();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('payments', function (Blueprint $table) {
      //
    });
  }
}
