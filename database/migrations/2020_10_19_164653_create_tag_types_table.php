<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tag_types', function (Blueprint $table) {
            $table->id();
            $table->char('name', 255);
            $table->char('description', 255);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('tags', function (Blueprint $table) {
            $table->foreignId('type_id')->after('id')->nullable()->references('id')->on('tag_types');
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

        Schema::dropIfExists('tag_types');
    }
}
