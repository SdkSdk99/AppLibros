<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Editoriales;

class EditorialController extends Controller
{
    public function index()
    {
        //
        $editoriales= Editoriales::all();
        return $editoriales;
    }

    public function store(Request $request)
    {
        
        $editoriales= new Editoriales();
        $editoriales->nombre=$request->nombre;
        $editoriales->save();

    }    

    public function update(Request $request)
    {
        $editoriales=Editoriales::findOrFail($request->id);
        $editoriales->nombre=$request->nombre;
        $editoriales->save();
    }

    public function destroy(Request $request)
    {
        $editoriales=Editoriales::findOrFail($request->id);
        $editoriales->delete();
    }
}
