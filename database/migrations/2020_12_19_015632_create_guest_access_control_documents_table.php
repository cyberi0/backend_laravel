<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuestAccessControlDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guest_access_control_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('guest_id')->constrained('guests', 'id');
            //$table->foreignId('guest_access_control_id')->references('id')->on('guest_access_control');

            $table->foreignId('type_id')->constrained('guest_access_control_document_types', 'id');

            $table->text('identification');
            $table->foreignId('created_by')->constrained('users', 'id');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('guest_access_control_documents');
    }
}
