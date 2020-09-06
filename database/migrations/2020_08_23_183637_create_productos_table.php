<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->bigIncrements('id');

            // $table->unsignedBigInteger('user_id');
            // $table->foreign('user_id')
            //     ->references('id')
            //     ->on('users');

            $table->unsignedBigInteger('unidad_medida_id');
            $table->foreign('unidad_medida_id')
                ->references('id')
                ->on('unidad_medida');

            $table->unsignedBigInteger('tipo_producto_id');
            $table->foreign('tipo_producto_id')
                ->references('id')
                ->on('tipo_producto');

            $table->string('codigo', 15);
            $table->string('nombre', 35);
            $table->text('observacion')->nullable();
            $table->boolean('asignacion');
            $table->date('fecha_creacion');
            $table->date('fecha_vencimiento');
            $table->date('fecha_ultima_compra')->nullable();
            $table->date('fecha_ultima_salida')->nullable();
            $table->date('fecha_ultimo_ajuste')->nullable();


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
        Schema::dropIfExists('productos');
    }
}
