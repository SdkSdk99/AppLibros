<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Autores;

class AutorController extends Controller
{
    public function index()
    {
        //
        $autores= Autores::all();
        return $autores;
    }

    public function store(Request $request)
    {
        
        $autores= new Autores();
        $autores->nombre=$request->nombre;
        $autores->save();

    }    

    public function update(Request $request)
    {
        $autores=Autores::findOrFail($request->id);
        $autores->nombre=$request->nombre;
        $autores->save();
    }

    public function destroy(Request $request)
    {
        $autores=Autores::findOrFail($request->id);
        $autores->delete();
    }
}
