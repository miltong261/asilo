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
            $table->id();

            $table->foreignId('user_id')
                ->references('id')
                ->on('users');

            $table->foreignId('departamento_origen')
                ->references('id')
                ->on('departamentos');

            $table->foreign('departamento_dpi')
                ->references('id')
                ->on('departamentos');

            $table->date('fecha_ingreso');
            $table->string('nombre', 35);
            $table->string('apellido', 35);
            $table->date('fecha_nacimiento');
            $table->integer('dpi', 13)->unique();
            $table->string('familia', 70);
            $table->integer('telefono_familia', 8);
            $table->string('persona_referida', 70)->nullable();
            $table->integer('telefono_persona_referida', 8)->nullable();
            $table->text('pedecimientos');
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
