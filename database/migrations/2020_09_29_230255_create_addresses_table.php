<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->text('street');
            $table->text('house_number');
            $table->text('suite_number')->nullable();
            $table->text('settlement');
            $table->text('postal_code');
            $table->text('locality');
            $table->text('town');
            $table->text('state');
            $table->text('country');
            $table->text('latitude');
            $table->text('longitude');
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

        Schema::dropIfExists('addresses');
    }
}
