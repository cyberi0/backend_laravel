<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProviderTaxDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('provider_tax_datas');

        Schema::create('provider_tax_data', function (Blueprint $table) {
            $table->id();
            $table->foreignId('provider_id')->constrained('complex_providers', 'id');
            $table->string('rfc');
            $table->string('name');
            $table->string('address');
            $table->string('postal_code');

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
        Schema::dropIfExists('provider_tax_datas');
    }
}
