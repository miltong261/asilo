<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSignosVitalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('signos_vitales', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users');

            $table->unsignedBigInteger('residente_id');
            $table->foreign('residente_id')
                ->references('id')
                ->on('residentes');

            $table->date('fecha_registro');
            $table->time('hora_registro');
            $table->string('respiraciones');
            $table->string('presion');
            $table->string('pulso');
            $table->decimal('peso', 5, 2);
            $table->decimal('temperatura', 5,2);
            $table->string('observacion', 70)->nullable();

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
        Schema::dropIfExists('signos_vitales');
    }
}
