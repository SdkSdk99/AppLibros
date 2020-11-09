<?php

namespace App\Http\Controllers;

use App\Libros;
use Illuminate\Http\Request;

class LibroController extends Controller
{
    public function index(Request $request)
    {
        $buscar   = $request->buscar;
        // $criterio = $request->criterio;
        $libros = Libros::orderBy('nombre', 'asc')->get();
        


        if ($buscar == '') {
            $libros = Libros::join('categorias','libros.id_categoria','=','categorias.id')
        ->join('idiomas', 'libros.id_idioma', '=', 'idiomas.id')
        ->join('autores', 'libros.id_autor', '=', 'autores.id')
        ->join('editoriales', 'libros.id_editorial', '=', 'editoriales.id')
            ->select('libros.id',
            'libros.nombre',
            'libros.codigo',
            'libros.cant',
            'libros.ano_publi',
            'libros.num_pag',
            'libros.ubicacion',
            'libros.edicion',
                'categorias.nombre as nomCat',
                'idiomas.nombre as nomIdi',
                'autores.nombre as nomAut',
                'editoriales.nombre as nomEdi'
            ) 
            ->orderBy('nombre','asc')->paginate(2);
        } else {
            $libros = Libros::join('categorias','libros.id_categoria','=','categorias.id')
        ->join('idiomas', 'libros.id_idioma', '=', 'idiomas.id')
        ->join('autores', 'libros.id_autor', '=', 'autores.id')
        ->join('editoriales', 'libros.id_editorial', '=', 'editoriales.id')
            ->select('libros.id',
            'libros.nombre',
            'libros.codigo',
            'libros.cant',
            'libros.ano_publi',
            'libros.num_pag',
            'libros.ubicacion',
            'libros.edicion',
                'categorias.nombre as nomCat',
                'idiomas.nombre as nomIdi',
                'autores.nombre as nomAut',
                'editoriales.nombre as nomEdi',
            )->where('libros.nombre','like', '%'.$buscar.'%')
            ->orwhere('libros.codigo','like', '%'.$buscar.'%')

             ->orderBy('nombre','asc')->paginate(2);
        }

        return [
            'pagination' => [
                'total'        => $libros->total(),
                'current_page' => $libros->currentPage(),
                'per_page'     => $libros->perPage(),
                'last_page'    => $libros->lastPage(),
                'from'         => $libros->firstItem(),
                'to'           => $libros->lastItem(),

            ],
            'libros'  => $libros,
        ];
    }

    public function GetLibro(Request $request)
    {
        $buscar   = $request->buscar;
        // $criterio = $request->criterio;
        $libros = Libros::orderBy('nombre', 'asc')->get();

        $libros = Libros::join('autores', 'libros.id_autor', '=', 'autores.id')
        ->join('editoriales', 'libros.id_editorial', '=', 'editoriales.id')
        ->select( 'libros.id','libros.codigo','libros.nombre','libros.cant','autores.nombre as nomAut',
        'editoriales.nombre as nomEdi',)
        ->where('libros.codigo',$buscar)
            ->orwhere('libros.nombre','like', '%'.$buscar.'%')
            ->orderBy('nombre','asc')->take(1)->get(); // take solo toma el primer valor buscado
        return [
            'libros'  => $libros
        ];
    }

    public function store(Request $request)
    {
        $libros = new Libros();
        $libros->nombre = $request->nombre;
        $libros->codigo = $request->codigo;
        $libros->cant = $request->cant;
        $libros->ano_publi = $request->ano_publi;
        $libros->num_pag = $request->num_pag;
        $libros->ubicacion = $request->ubicacion;
        $libros->edicion = $request->edicion;
        $libros->id_categoria = $request->id_categoria;
        $libros->id_idioma = $request->id_idioma;
        $libros->id_autor = $request->id_autor;
        $libros->id_editorial = $request->id_editorial;

        $libros->save();
    }
    
    public function update(Request $request)
    {
        $libros = Libros::findOrFail($request->id);
        $libros->nombre = $request->nombre;
        $libros->codigo = $request->codigo;
        $libros->cant = $request->cant;
        $libros->ano_publi = $request->ano_publi;
        $libros->num_pag = $request->num_pag;
        $libros->ubicacion = $request->ubicacion;
        $libros->edicion = $request->edicion;
        $libros->id_categoria = $request->id_categoria;
        $libros->id_idioma = $request->id_idioma;
        $libros->id_autor = $request->id_autor;
        $libros->id_editorial = $request->id_editorial;
        $libros->save();
    }

    public function destroy(Request $request)
    {
        $libros = Libros::findOrFail($request->id);
        $libros->delete();
    }
}
