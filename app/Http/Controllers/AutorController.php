<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Autores;

class AutorController extends Controller
{
    //mostrar datos de la tabla
    public function index(Request $request)
    {
        $buscar=$request->nombre;
        $criterio=$request->criterio;
        $autores = Autores::orderBy('nombre', 'asc')->get();

        if($buscar == ''){
        $autores=Autores::join('paises','autores.id_pais','=','paises.id')
            ->select('autores.id','autores.nombre','paises.nombre as nomPais')
            ->orderBy('nombre','asc')->paginate(4);
        } else {$autores = Autores::join('paises','autores.id_pais','=','paises.id')
            ->select('autores.id','autores.nombre','paises.nombre as nomPais')->orderBy('nombre','asc')->paginate(4);
        }
        return [

            'pagination'=>[
                'total'=> $autores -> total(),
                'current_page'=> $autores -> currentPage(),
                'per_page'=> $autores -> perPage(),
                'last_page'=> $autores -> lastPage(),
                'from'=> $autores -> firstItem(),
                'to'=> $autores -> lastItem(),
            ],

            'autores'=>$autores,
        ];
    }
    public function getAutores(Request $request)
    {
        $autores = Autores::select('id','nombre')
            ->orderBy('nombre', 'asc')->get();
        return [
            'autores' => $autores
        ];
    }
    

    //guardar datos en la bd
    public function store(Request $request)
    {
        $autores= new Autores();
        $autores->nombre = $request->nombre;
        $autores->id_pais = $request->idPais;
        $autores->save();
    }
    
    //actualizar datos
    public function update(Request $request)
    {
        $autores= Autores::findOrfail($request->id);
        $autores->nombre = $request->nombre;
        $autores->id_pais = $request->idPais;
        $autores->save();
    }

    //eliminar datos
    public function destroy(Request $request)
    {
        $autores= Autores::findOrfail($request->id);
        $autores->delete();
    }
}
