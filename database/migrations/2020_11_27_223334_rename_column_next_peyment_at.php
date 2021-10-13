<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameColumnNextPeymentAt extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('complex_plans', function (Blueprint $table) {
            $table->renameColumn('next_peyment_at', 'next_payment_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('complex_plans', function (Blueprint $table) {
            $table->renameColumn('next_peyment_at', 'next_payment_at');
        });
    }
}
