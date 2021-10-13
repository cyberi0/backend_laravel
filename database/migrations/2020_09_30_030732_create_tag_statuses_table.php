<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tag_statuses', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('tags', function (Blueprint $table) {
            $table->foreignId('status_id')->nullable()->after('number')->references('id')->on('tag_statuses');
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

        Schema::dropIfExists('tag_statuses');
    }
}
