<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComplexesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('complexes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('owner_id')->nullable()->references('id')->on('users');
            $table->foreignId('admin_id')->nullable()->references('id')->on('users');
            $table->text('name');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('addresses', function (Blueprint $table) {
            $table->foreignId('complex_id')->nullable()->after('id')->constrained();
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

        Schema::dropIfExists('complexes');
    }
}
