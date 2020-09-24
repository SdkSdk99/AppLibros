<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('contenido/contenido');
});

Route::get('categorias','CategoriaController@index');
Route::get('editoriales','EditorialController@index');
Route::get('autores','AutorController@index');
Route::get('idiomas','IdiomaController@index');
Route::get('paises','PaisController@index');