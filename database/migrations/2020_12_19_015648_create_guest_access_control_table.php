<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuestAccessControlTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guest_access_control', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_guest_id')->constrained('property_guests', 'id');
            $table->foreignId('conceded_type_id')->constrained('guest_access_control_conceded_types', 'id');
            $table->foreignId('conceded_by')->nullable()->references('id')->on('users');
            $table->dateTime('access_at');
            $table->foreignId('created_by')->constrained('users', 'id');

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
        Schema::dropIfExists('guest_access_control');
    }
}
