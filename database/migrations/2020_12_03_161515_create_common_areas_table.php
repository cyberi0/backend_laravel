<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommonAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('common_areas');

        Schema::create('common_areas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('complex_id')->constrained('complexes', 'id');
            $table->string('name');
            $table->string('description');
            $table->decimal('price',12,2);
            $table->enum('price_type', [1, 2]);
            $table->string('price_unit');

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
        Schema::dropIfExists('common_areas');
    }
}
