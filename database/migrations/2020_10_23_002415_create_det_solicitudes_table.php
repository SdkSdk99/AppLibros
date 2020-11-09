<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetSolicitudesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('det_solicitudes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cant');
            $table->integer('id_solicitud')->unsigned();
            $table->foreign('id_solicitud')->references('id')->on('solicitud_libros');
            $table->integer('id_libro')->unsigned();
            $table->foreign('id_libro')->references('id')->on('libros');
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
        Schema::dropIfExists('det_solicitudes');
    }
}
