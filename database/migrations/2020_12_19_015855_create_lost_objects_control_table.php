<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLostObjectsControlTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lost_objects_control', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->nullable()->references('id')->on('properties');
            $table->foreignId('common_area_id')->nullable()->references('id')->on('common_areas');
            $table->foreignId('reported_by_user')->nullable()->references('id')->on('users');
            $table->foreignId('reported_by_guest')->nullable()->references('id')->on('guests');
            $table->dateTime('reported_at');
            $table->foreignId('finded_by_user')->nullable()->references('id')->on('users');
            $table->foreignId('finded_by_guest')->nullable()->references('id')->on('guests');
            $table->dateTime('finded_at')->nullable();
            $table->text('comments')->nullable();
            $table->dateTime('lost_at');
            $table->foreignId('created_by')->references('id')->on('users');
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
        Schema::dropIfExists('lost_objects_control');
    }
}
