<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donaciones', function (Blueprint $table) {
            $table->bigIncrements('id');

            // $table->unsignedBigInteger('user_id');
            // $table->foreign('user_id')
            //     ->references('id')
            //     ->on('users');

            $table->unsignedBigInteger('donante_id');
            $table->foreign('donante_id')
                ->references('id')
                ->on('donantes');

            $table->date('fecha_registro');
            $table->date('fecha_donacion');
            $table->date('fecha_anulacion')->nullable();
            $table->boolean('estado');

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
        Schema::dropIfExists('donaciones');
    }
}
