<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComplexFeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('complex_fees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('complex_id')->nullable()->constrained();
            $table->decimal('amount', 12, 2);
            $table->tinyInteger('cutoff')->comment('Día corte del mes');
            $table->tinyInteger('limit')->comment('Día límite para el pago del mes');
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

        Schema::dropIfExists('complex_fees');
    }
}
