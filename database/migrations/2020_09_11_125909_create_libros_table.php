<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLibrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('libros', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre',150);
            $table->string('codigo',50);
            $table->integer('cant');
            $table->date('ano_publi');
            $table->string('num_pag',7);
            $table->string('ubicacion',100);
            $table->string('edicion',5);
            $table->integer('id_categoria')->unsigned();
            $table->integer('id_idioma')->unsigned();
            $table->integer('id_autor')->unsigned();
            $table->integer('id_editorial')->unsigned();

            $table->foreign('id_categoria')->references('id')->on('categorias');
            $table->foreign('id_idioma')->references('id')->on('idiomas');
            $table->foreign('id_autor')->references('id')->on('autors');
            $table->foreign('id_editorial')->references('id')->on('editorials');
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
        Schema::dropIfExists('libros');
    }
}
