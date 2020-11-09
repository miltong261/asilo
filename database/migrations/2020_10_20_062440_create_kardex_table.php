<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKardexTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kardex', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users');

            $table->unsignedBigInteger('residente_id');
            $table->foreign('residente_id')
                ->references('id')
                ->on('residentes');

            $table->unsignedBigInteger('producto_id');
            $table->foreign('producto_id')
                ->references('id')
                ->on('productos');

            $table->date('fecha_registro');
            $table->time('hora');
            $table->decimal('cantidad');
            $table->string('unidad_medida');
            $table->text('observacion');

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
        Schema::dropIfExists('kardex');
    }
}
