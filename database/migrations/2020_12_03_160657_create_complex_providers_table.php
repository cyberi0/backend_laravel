<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComplexProvidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('complex_providers');
        Schema::create('complex_providers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('complex_provider_categories', 'id');
            $table->string('company');
            $table->string('contact_names');
            $table->string('contact_surnames');
            $table->string('email');
            $table->string('phone');
            $table->string('mobile');

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
        Schema::dropIfExists('complex_providers');
    }
}
