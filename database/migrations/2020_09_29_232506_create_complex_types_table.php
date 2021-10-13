<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComplexTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('complex_types', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->text('description');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('complexes', function (Blueprint $table) {
            $table->foreignId('type_id')->nullable()->after('admin_id')->references('id')->on('complex_types');
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

        Schema::dropIfExists('complex_types');
    }
}
