<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComplexControlTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('complex_control', function (Blueprint $table) {
            $table->id();
            $table->foreignId('complex_id')->constrained();
            $table->text('url')->nullable();
            $table->text('api_uuid')->nullable();
            $table->text('api_key')->nullable();
            $table->text('pi_id')->nullable();
            $table->text('pi_access_token')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->timestamp('last_ping')->nullable();
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

        Schema::dropIfExists('complex_control');
    }
}
