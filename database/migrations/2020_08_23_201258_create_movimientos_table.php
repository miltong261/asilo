<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movimientos', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('caja_id');
            $table->foreign('caja_id')
                ->references('id')
                ->on('caja');

            $table->unsignedBigInteger('tipo_movimiento_id');
            $table->foreign('tipo_movimiento_id')
                ->references('id')
                ->on('tipo_movimiento');

            $table->string('no_transaccion', 20);
            $table->date('fecha_registro');
            $table->decimal('monto', 8, 2);
            $table->string('observacion', 70);

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
        Schema::dropIfExists('movimientos');
    }
}
