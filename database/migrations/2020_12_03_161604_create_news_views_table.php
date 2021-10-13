<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsViewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('news_views');

        Schema::create('news_views', function (Blueprint $table) {
            $table->id();
            $table->foreignId('news_id')->constrained('news', 'id');
            $table->foreignId('property_id')->constrained('properties', 'id');
            $table->foreignId('owner_id')->constrained('users', 'id');
            $table->foreignId('occupant_id')->constrained('users', 'id');

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
        Schema::dropIfExists('news_views');
    }
}
