<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('complex_id')->nullable()->constrained();
            $table->enum('way', [1, 2])->default(1)->comment('1 = Ingreso, 2 = Egreso');
            $table->text('name');
            $table->text('description');
            $table->decimal('amount', 12, 2);
            $table->decimal('paid', 12, 2)->comment('Cantidad total pagada, por lo general es el total pero puede contener recargos o descuentos.');
            $table->text('receipt');
            $table->text('comments');
            $table->timestamps();
            $table->softDeletes();
            $table->timestamp('registered_at')->nullable();
            $table->date('paid_at')->nullable();
            $table->date('expired_at')->nullable();
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
        Schema::disableForeignKeyConstraints();

        Schema::dropIfExists('payments');
    }
}
