<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('occupant_id')->constrained('users', 'id');
            $table->enum('type', [1, 2, 3, 4]);
            $table->string('name');
            $table->string('description');
            $table->enum('periodicity', [1, 2, 3]);
            $table->integer('day');
            $table->time('time');
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
        Schema::table('notifications', function (Blueprint $table) {
            //
        });
    }
}
