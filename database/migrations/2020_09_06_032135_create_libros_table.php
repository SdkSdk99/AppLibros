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
            $table->integer('id')->primary();
            $table->string('nombre', 20);
            $table->string('codigo', 20);
            $table->integer('cantidad');
            $table->date('ano_publi');
            $table->string('num_pag', 20);
            $table->string('ubicacion', 20);
            $table->string('edicion', 20);

            $table->integer('id_editoriale')->signed();            
            $table->integer('id_categoria')->signed();            
            $table->integer('id_autore')->signed();            
            $table->integer('id_idioma')->signed();   

            $table->foreign('id_editoriale')->references('id')->on('editoriales');
            $table->foreign('id_categoria')->references('id')->on('categorias');
            $table->foreign('id_autore')->references('id')->on('autores');
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
