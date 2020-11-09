<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categorias;

class CategoriaController extends Controller
{
    //mostrar datos de la tabla
    public function index(Request $request)
    {

        $buscar=$request->nombre;
        $criterio=$request->criterio;

        if ($buscar=='') {
            $categorias= Categorias::orderBy('nombre','asc')->paginate(4);
        }else {
            $categorias= Categorias::where($criterio, 'like', '%'.$buscar. '%')->orderBy('nombre','asc')->paginate(4);
        }


        // GET para obtener
        // POST guardar en la bd
        // PUT actualizar o eliminar.
        
        
        return [

            'pagination'=>[
                'total'=> $categorias -> total(),
                'current_page'=> $categorias -> currentPage(),
                'per_page'=> $categorias -> perPage(),
                'last_page'=> $categorias -> lastPage(),
                'from'=> $categorias -> firstItem(),
                'to'=> $categorias -> lastItem(),
            ],

            'categorias'=>$categorias
        ];
    }
    //trae los datos de las llaves foraneas
    public function getCategorias(Request $request)
    {
        $categorias = Categorias::select('id','nombre')
            ->orderBy('nombre', 'asc')->get();
        return [
            'categorias' => $categorias
        ];
    }

    //guardar datos en la bd
    public function store(Request $request)
    {
        $categorias= new Categorias();
        $categorias->nombre = $request->nombre;
        $categorias->save();
    }
    
    //actualizar datos
    public function update(Request $request)
    {
        $categorias= Categorias::findOrfail($request->id);
        $categorias->nombre = $request->nombre;
        $categorias->save();
    }

    //eliminar datos
    public function destroy(Request $request)
    {
        $categorias= Categorias::findOrfail($request->id);
        $categorias->delete();
    }
}
