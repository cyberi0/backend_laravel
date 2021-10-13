<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComplexBalanceWithdrawalsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('complex_balance_withdrawals', function (Blueprint $table) {
      $table->id();
      $table->foreignId('complex_id')->constrained();
      $table->foreignId('account_id')->nullable()->default(NULL)->constrained('complex_balance_accounts', 'id');
      $table->decimal('amount', 12, 2)->nullable();
      $table->text('receipt')->nullable()->default(NULL);
      $table->timestamps();
      $table->softDeletes();
      $table->timestamp('withdrawn_at')->nullable()->default(NULL);
      $table->foreignId('withdrawn_by')->nullable()->default(NULL)->constrained('users', 'id');
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

    Schema::dropIfExists('complex_balance_withdrawals');
  }
}
