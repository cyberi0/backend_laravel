<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComplexAdministrationRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('complex_administration_roles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('administration_id')->nullable()->references('id')->on('complex_administrations');
            $table->foreignId('user_id')->constrained();
            $table->text('role');
            $table->text('description');
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

        Schema::dropIfExists('complex_administration_roles');
    }
}
