<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResidentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('residentes', function (Blueprint $table) {
            $table->bigIncrements('id');

            // $table->unsignedBigInteger('user_id');
            // $table->foreign('user_id')
            //     ->references('id')
            //     ->on('users');

            $table->unsignedBigInteger('municipio_origen');
            $table->foreign('municipio_origen')
                ->references('id')
                ->on('municipios');

            $table->unsignedBigInteger('municipio_dpi');
            $table->foreign('municipio_dpi')
                ->references('id')
                ->on('municipios');

            $table->string('codigo', 20);
            $table->date('fecha_ingreso');
            $table->string('nombre', 35);
            $table->string('apellido', 35);
            $table->date('fecha_nacimiento');
            $table->bigInteger('dpi')->unique();
            $table->string('familia', 70)->nullable();
            $table->string('direccion', 70)->nullable();
            $table->bigInteger('telefono_familia')->nullable();
            $table->string('persona_referida', 70)->nullable();
            $table->string('direccion_persona_referida', 70)->nullable();
            $table->bigInteger('telefono_persona_referida')->nullable();
            $table->string('motivo');
            $table->string('estado');
            $table->string('historial');
            $table->string('observacion')->nullable();

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
        Schema::dropIfExists('residentes');
    }
}
