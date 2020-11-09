<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Idiomas;

class IdiomaController extends Controller
{
    //mostrar datos de la tabla
    public function index(Request $request)
    {
        $buscar=$request->nombre;
        $criterio=$request->criterio;

        if ($buscar=='') {
            $idiomas= Idiomas::orderBy('nombre','asc')->paginate(7);
        }else {
            $idiomas= Idiomas::where($criterio, 'like', '%'.$buscar. '%')->orderBy('nombre','asc')->paginate(7);
        }
        // GET para obtener
        // POST guardar en la bd
        // PUT actualizar o eliminar

        return [
            'pagination'=>[
                'total'=> $idiomas -> total(),
                'current_page'=> $idiomas -> currentPage(),
                'per_page'=> $idiomas -> perPage(),
                'last_page'=> $idiomas -> lastPage(),
                'from'=> $idiomas -> firstItem(),
                'to'=> $idiomas -> lastItem(),
            ],
            'idiomas'=>$idiomas
        ];
    }
    //es para mostrar los datos de las llaves foraneas
    public function getIdiomas(Request $request)
    {
        $idiomas = Idiomas::select('id','nombre')
            ->orderBy('nombre', 'asc')->get();
        return [
            'idiomas' => $idiomas
        ];
    }

    //guardar datos en la bd
    public function store(Request $request)
    {
        $idiomas= new Idiomas();
        $idiomas->nombre = $request->nombre;
        $idiomas->save();
    }
    
    //actualizar datos
    public function update(Request $request)
    {
        $idiomas= Idiomas::findOrfail($request->id);
        $idiomas->nombre = $request->nombre;
        $idiomas->save();
    }

    //eliminar datos
    public function destroy(Request $request)
    {
        $idiomas= Idiomas::findOrfail($request->id);
        $idiomas->delete();
    }
}
