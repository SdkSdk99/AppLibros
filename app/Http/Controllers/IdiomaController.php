<?php

namespace App\Http\Controllers;

use App\Idioma;
use Illuminate\Http\Request;

class IdiomaController extends Controller
{
    public function index(Request $request)
    {
        $buscar   = $request->nombre;
        $criterio = $request->criterio;

        if ($buscar == '') {
            $idioma = Idioma::orderBy('nombre', 'asc')->paginate(9);
        } else {
            $idioma = Idioma::where('criterio', '=', $buscar) - orderBy('nomnbre', 'asc')->paginate(9);
        }

        return [
            'pagination' => [
                'total'        => $idioma->total(),
                'current_page' => $idioma->currentPage(),
                'per_page'     => $idioma->perPage(),
                'last_page'    => $idioma->lastPage(),
                'from'         => $idioma->firstItem(),
                'to'           => $idioma->lastItem(),

            ],
            'idioma'     => $idioma,
        ];
    }

    public function store(Request $request)
    {
        $idioma         = new Idioma();
        $idioma->nombre = $request->nombre;
        $idioma->save();
    }

    public function update(Request $request)
    {
        $idioma         = Idioma::findOrFail($request->id);
        $idioma->nombre = $request->nombre;
        $idioma->save();
    }

    public function destroy(Request $request)
    {
        $idioma = Idioma::findOrFail($request->id);
        $idioma->delete();
    }
}


