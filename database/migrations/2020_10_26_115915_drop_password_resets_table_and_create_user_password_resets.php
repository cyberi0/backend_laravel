<?php

  use Illuminate\Database\Migrations\Migration;
  use Illuminate\Database\Schema\Blueprint;
  use Illuminate\Support\Facades\Schema;

  class DropPasswordResetsTableAndCreateUserPasswordResets extends Migration
  {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::disableForeignKeyConstraints();

      Schema::drop('password_resets');

      Schema::create('user_password_resets', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained();
        $table->string('token', 255);
        $table->timestamp('expired_at');
      });

      Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('password_resets', function (Blueprint $table) {
        //
      });
    }
  }
