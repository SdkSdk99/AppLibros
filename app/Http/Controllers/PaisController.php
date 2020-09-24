<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Paises;

class PaisController extends Controller
{
    public function index()
    {
        //
        $paises= Paises::all();
        return $paises;
    }

    public function store(Request $request)
    {
        
        $paises= new Paises();
        $paises->nombre=$request->nombre;
        $paises->save();

    }    

    public function update(Request $request)
    {
        $paises=Paises::findOrFail($request->id);
        $paises->nombre=$request->nombre;
        $paises->save();
    }

    public function destroy(Request $request)
    {
        $paises=Paises::findOrFail($request->id);
        $paises->delete();
    }
}
