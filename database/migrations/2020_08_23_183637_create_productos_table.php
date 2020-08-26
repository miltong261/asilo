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
            $table->id();

            $table->foreignId('user_id')
                ->references('id')
                ->on('users');

            $table->foreignId('unidad_media_id')
                ->references('id')
                ->on('unidad_medida');

            $table->foreignId('tipo_producto_id')
                ->references('id')
                ->on('tipo_producto');

            $table->string('nombre', 35);
            $table->text('observacion')->nullable();
            $table->date('fecha_creacion');
            $table->date('fecha_vencimiento');
            $table->date('fecha_ultima_compra');
            $table->date('fecha_ultima_salida');
            $table->date('fecha_ultimo_ajuste');


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
