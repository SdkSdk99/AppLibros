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
            $table->string('nombre',100);
            $table->string('codigo',100);
            $table->integer('cant');
            $table->date('ano_publi');
            $table->string('num_pag',100);
            $table->string('ubicacion',100);
            $table->string('edicion',100);

            $table->integer('id_editorial')->unsigned();
            $table->foreign('id_editorial')->references('id')->on('editoriales');
            $table->integer('id_categoria')->unsigned();
            $table->foreign('id_categoria')->references('id')->on('categorias');
            $table->integer('id_autor')->unsigned();
            $table->foreign('id_autor')->references('id')->on('autores');
            $table->integer('id_idioma')->unsigned();
            $table->foreign('id_idioma')->references('id')->on('idiomas');
            
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
