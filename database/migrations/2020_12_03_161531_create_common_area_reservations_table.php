<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommonAreaReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('common_area_reservations');

        Schema::create('common_area_reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('common_area_id')->constrained('common_areas', 'id');
            $table->foreignId('property_id')->constrained('properties', 'id');
            $table->foreignId('payment_id')->nullable()->default(NULL)->constrained('payments', 'id');
            $table->dateTime('starts_at');
            $table->dateTime('ends_at');
            $table->decimal('amount',12,2)->nullable()->default(NULL);

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
        Schema::dropIfExists('common_area_reservations');
    }
}
