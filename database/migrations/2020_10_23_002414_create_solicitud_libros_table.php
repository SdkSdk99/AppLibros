<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSolicitudLibrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitud_libros', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp('fec_sol');
            $table->date('fec_entrega');
            $table->integer('id_persona')->unsigned();
            $table->foreign('id_persona')->references('id')->on('personas');
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
        Schema::dropIfExists('solicitud_libros');
    }
}
