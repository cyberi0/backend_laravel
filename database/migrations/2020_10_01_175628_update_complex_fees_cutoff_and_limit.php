<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateComplexFeesCutoffAndLimit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('complex_fees', function (Blueprint $table) {
            $table->decimal('amount', 12, 2)->default(0)->change();
            $table->dropColumn(['cutoff', 'limit']);
        });

        Schema::table('complex_fees', function (Blueprint $table) {
            $table->tinyInteger('cutoff')->after('amount')->default(20)->nullable();
        });

        Schema::table('complex_fees', function (Blueprint $table) {
            $table->tinyInteger('limit')->after('cutoff')->default(5)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('complex_fees', function (Blueprint $table) {
            //
        });
    }
}
