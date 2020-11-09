<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Editoriales;

class EditorialController extends Controller
{
    //mostrar datos de la tabla
    public function index(Request $request)
    {
        $buscar=$request->nombre;
        $criterio=$request->criterio;

        if ($buscar=='') {
            $editoriales= Editoriales::orderBy('nombre','asc')->paginate(7);
        }else {
            $editoriales= Editoriales::where($criterio, 'like', '%'.$buscar. '%')->orderBy('nombre','asc')->paginate(7);
        }

        // GET para obtener
        // POST guardar en la bd
        // PUT actualizar o eliminar

        return [
            'pagination'=>[
                'total'=> $editoriales -> total(),
                'current_page'=> $editoriales -> currentPage(),
                'per_page'=> $editoriales -> perPage(),
                'last_page'=> $editoriales -> lastPage(),
                'from'=> $editoriales -> firstItem(),
                'to'=> $editoriales -> lastItem(),
            ],
            'editoriales'=>$editoriales
        ];
    }
    //muestra los datos en las llaves foraneas
    public function getEditoriales(Request $request)
    {
        $editoriales = Editoriales::select('id','nombre')
            ->orderBy('nombre', 'asc')->get();
        return [
            'editoriales' => $editoriales
        ];
    }

    //guardar datos en la bd
    public function store(Request $request)
    {
        $editoriales= new Editoriales();
        $editoriales->nombre = $request->nombre;
        $editoriales->save();
    }
    
    //actualizar datos
    public function update(Request $request)
    {
        $editoriales= Editoriales::findOrfail($request->id);
        $editoriales->nombre = $request->nombre;
        $editoriales->save();
    }

    //eliminar datos
    public function destroy(Request $request)
    {
        $editoriales= Editoriales::findOrfail($request->id);
        $editoriales->delete();
    }
}
