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

            $table->string('codigo', 15);
            $table->date('fecha_ingreso');
            $table->string('nombre', 35);
            $table->string('apellido', 35);
            $table->date('fecha_nacimiento');
            $table->integer('dpi', false, true)->length(13)->unique();
            $table->string('familia', 70)->nullable();
            $table->string('direccion', 70)->nullable();
            $table->integer('telefono_familia', false, true)->length(8)->nullable();
            $table->string('persona_referida', 70)->nullable();
            $table->string('direccion_persona_referida', 70)->nullable();
            $table->integer('telefono_persona_referida', false, true)->length(8)->nullable();
            $table->string('motivo');
            $table->text('estado');
            $table->text('historial');
            $table->string('pulso', 15);
            $table->string('temperatura', 15);
            $table->string('presion', 35);
            $table->decimal('peso', 5, 2);
            $table->text('observacion')->nullable();

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
