<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProviderAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('provider_accounts');
        Schema::create('provider_accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('method_id')->constrained('methods', 'id');
            $table->foreignId('provider_id')->constrained('complex_providers', 'id');
            $table->foreignId('bank_id')->constrained('banks', 'id');
            $table->text('owner');
            $table->text('number');
            $table->text('card');
            $table->text('clabe');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('provider_accounts');
    }
}
