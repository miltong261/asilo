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

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users');

            $table->unsignedBigInteger('departamento_origen');
            $table->foreign('departamento_origen')
                ->references('id')
                ->on('departamentos');

            $table->unsignedBigInteger('departamento_dpi');
            $table->foreign('departamento_dpi')
                ->references('id')
                ->on('departamentos');

            $table->date('fecha_ingreso');
            $table->string('nombre', 35);
            $table->string('apellido', 35);
            $table->date('fecha_nacimiento');
            $table->integer('dpi', false, true)->length(13)->unique();
            $table->string('familia', 70)->nullable();
            $table->integer('telefono_familia', false, true)->length(8)->nullable();
            $table->string('persona_referida', 70)->nullable();
            $table->integer('telefono_persona_referida', false, true)->length(8)->nullable();
            $table->text('padecimientos');
            $table->string('motivo');
            $table->text('estado');
            $table->string('signos_vitales', 35);
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
