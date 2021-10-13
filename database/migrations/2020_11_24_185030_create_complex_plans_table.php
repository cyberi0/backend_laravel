<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComplexPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('complex_plans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('complex_id')->constrained('complexes', 'id');
            $table->foreignId('plan_id')->constrained('plans', 'id');

            $table->timestamp('last_payment_at')->nullable();
            $table->timestamp('next_peyment_at')->nullable();

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
        Schema::dropIfExists('complex_plans');
    }
}
