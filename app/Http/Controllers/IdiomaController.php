<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Idiomas;

class IdiomaController extends Controller
{ 
    public function index()
    {
        //
        $idiomas= Idiomas::all();
        return $idiomas;
    }

    public function store(Request $request)
    {
        
        $idiomas= new Idiomas();
        $idiomas->nombre=$request->nombre;
        $idiomas->save();

    }    

    public function update(Request $request)
    {
        $idiomas=Idiomas::findOrFail($request->id);
        $idiomas->nombre=$request->nombre;
        $idiomas->save();
    }

    public function destroy(Request $request)
    {
        $idiomas=Idiomas::findOrFail($request->id);
        $idiomas->delete();
    }
}
