<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpleadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleados', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('puesto_id');
            $table->foreign('puesto_id')->references('id')->on('puestos');

            $table->string('codigo', 15);
            $table->date('fecha_ingreso');
            $table->string('nombre', 35);
            $table->string('apellido', 35);
            $table->date('fecha_nacimiento');
            $table->integer('dpi', false, true)->length(13);
            $table->string('direccion', 70);
            $table->integer('telefono', false, true)->length(8)->nullable();
            $table->string('email')->unique()->nullable();
            $table->boolean('estado')->default(1);

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
        Schema::dropIfExists('empleados');
    }
}
