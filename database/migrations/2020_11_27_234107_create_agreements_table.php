<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgreementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agreements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('complex_id')->constrained('complexes', 'id');
            $table->foreignId('created_by')->constrained('users', 'id');
            $table->foreignId('owner_id')->constrained('users', 'id');
            $table->foreignId('occupant_id')->constrained('users', 'id');
            $table->foreignId('property_id')->constrained('properties', 'id');

            $table->string('name');
            $table->string('description');
            $table->decimal('amount',12,2);
            $table->decimal('total',12,2);
            $table->text('document')->nullable()->default(NULL);
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
        Schema::dropIfExists('agreements');
    }
}
