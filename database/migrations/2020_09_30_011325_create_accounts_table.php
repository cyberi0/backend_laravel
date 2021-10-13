<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('complex_id')->nullable()->constrained();
            $table->text('owner');
            $table->text('number');
            $table->text('card');
            $table->text('clabe');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('payments', function(Blueprint $table) {
            $table->foreignId('account_id')->nullable()->after('id')->constrained();
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

        Schema::dropIfExists('accounts');
    }
}
