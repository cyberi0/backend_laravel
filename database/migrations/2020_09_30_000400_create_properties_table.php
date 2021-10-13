<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('complex_id')->nullable()->constrained();
            $table->foreignId('owner_id')->nullable()->references('id')->on('users');
            $table->foreignId('occupant_id')->nullable()->references('id')->on('users');
            $table->text('name');
            $table->text('proportions');
            $table->text('document');
            $table->text('book');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('addresses', function(Blueprint $table) {
            $table->foreignId('property_id')->nullable()->after('complex_id')->references('id')->on('properties');
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

        Schema::dropIfExists('properties');
    }
}
