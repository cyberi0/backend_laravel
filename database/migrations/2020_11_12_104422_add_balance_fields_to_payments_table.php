<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBalanceFieldsToPaymentsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('payments', function (Blueprint $table) {
      $table->timestamp('withdrawal_requested_at')->comment('Fecha en que se Solicitó el Retiro del Dinero')->nullable();
      $table->timestamp('withdrawn_at')->comment('Fecha en que se Retiró el Dinero a la cuenta del Complejo')->nullable();
      $table->timestamp('chargedback_at')->comment('Fecha en que se Solicitó un contracargo por el cliente que realizó el pago')->nullable();
      $table->timestamp('chargeback_covered_at')->comment('Fecha en que se cubrió el contracargo por parte del Complejo')->nullable();
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
