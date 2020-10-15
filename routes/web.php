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

Route::get('categoria', 'CategoriaController@index'); 
Route::post('categoria/registrar', 'CategoriaController@store'); 
Route::put('categoria/actualizar', 'CategoriaController@update'); 
Route::post('categoria/eliminar', 'CategoriaController@destroy'); 

Route::get('editorial', 'EditorialController@index');
Route::post('editorial/registrar', 'EditorialController@store');
Route::put('editorial/actualizar', 'EditorialController@update');
Route::post('editorial/eliminar', 'EditorialController@destroy');

Route::get('idioma', 'IdiomaController@index');
Route::put('idioma/actualizar', 'IdiomaController@update');
Route::post('idioma/eliminar', 'IdiomaController@destroy');

Route::get('pais', 'PaisController@index');
Route::put('pais/actualizar', 'PaisController@update');
Route::post('/pais/eliminar', 'PaisController@destroy');

Route::get('autor', 'AutorController@index');
Route::post('/autor/registrar', 'AutorController@store');
Route::put('autor/actualizar', 'AutorController@update');
Route::post('/autor/eliminar', 'AutorController@destroy');
