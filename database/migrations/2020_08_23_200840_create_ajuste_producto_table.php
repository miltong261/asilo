<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAjusteProductoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ajuste_producto', function (Blueprint $table) {
            $table->bigIncrements('id');

            // $table->unsignedBigInteger('user_id');
            // $table->foreign('user_id')
            //     ->references('id')
            //     ->on('users');

            $table->unsignedBigInteger('producto_id');
            $table->foreign('producto_id')
                ->references('id')
                ->on('productos');

            $table->string('codigo', 20);
            $table->date('fecha_registro');
            $table->integer('cantidad');
            $table->boolean('entrada')->nullable();
            $table->boolean('salida')->nullable();
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
        Schema::dropIfExists('ajuste_producto');
    }
}
