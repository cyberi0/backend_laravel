<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertyGuestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_guests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('created_by')->constrained('users', 'id');
            $table->foreignId('guest_id')->constrained('guests', 'id');
            $table->foreignId('property_id')->constrained('properties', 'id');

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
        Schema::dropIfExists('property_guests');
    }
}
