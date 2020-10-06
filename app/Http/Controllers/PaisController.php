<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pais;

class PaisController extends Controller
{
    public function index()
    {
        $pais=Pais::orderBy('nombre','asc')->get();
        return [
          'pais'=>$pais  
        ];
    }

    public function store(Request $request)
    {
        $pais = new Pais();
        $pais->nombre = $request->nombre;
        $pais->save();
    }

    public function update(Request $request)
    {
        $pais = Pais::findOrFail($request->id);
        $pais->nombre = $request->nombre;
        $pais->save();
    }
    
    public function destroy(Request $request)
    {
        $pais = Pais::findOrFail($request->id);
        $pais->delete();
    }
}
