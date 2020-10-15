<?php

namespace App\Http\Controllers;

use App\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index(Request $request)
    {
        $buscar   = $request->nombre;
        $criterio = $request->criterio;

        if ($buscar == '') {
            $categoria = Categoria::orderBy('nombre', 'asc')->paginate(4);
        } else {
            $categoria = Categoria::where('criterio', '=', $buscar) - orderBy('nombre', 'asc')->paginate(4);
        }

        return [
            'pagination' => [
                'total'        => $categoria->total(),
                'current_page' => $categoria->currentPage(),
                'per_page'     => $categoria->perPage(),
                'last_page'    => $categoria->lastPage(),
                'from'         => $categoria->firstItem(),
                'to'           => $categoria->lastItem(),

            ],
            'categoria'  => $categoria,
        ];
    }

    public function store(Request $request)
    {
        $categoria         = new Categoria();
        $categoria->nombre = $request->nombre;
        $categoria->save();
    }

    public function update(Request $request)
    {
        $categoria = Categoria::findOrFail($request->id);
        $categoria->nombre = $request->nombre;
        $categoria->save();
    }

    public function destroy(Request $request)
    {
        $categoria = Categoria::findOrFail($request->id);
        $categoria->delete();
    }
}
