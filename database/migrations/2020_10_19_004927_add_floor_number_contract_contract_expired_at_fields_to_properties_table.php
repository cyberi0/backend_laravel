<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFloorNumberContractContractExpiredAtFieldsToPropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->text('name')->nullable()->change();
            $table->text('proportions')->nullable()->change();
            $table->text('document')->nullable()->change();
            $table->text('book')->nullable()->change();
            $table->char('floor', 255)->after('name')->nullable();
        });

        Schema::table('properties', function (Blueprint $table) {
            $table->char('number', 255)->after('floor')->nullable();
        });

        Schema::table('properties', function (Blueprint $table) {
            $table->char('contract', 255)->after('number')->nullable();
        });

        Schema::table('properties', function (Blueprint $table) {
            $table->date('contract_expired_at')->after('contract')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('properties', function (Blueprint $table) {
            //
        });
    }
}
