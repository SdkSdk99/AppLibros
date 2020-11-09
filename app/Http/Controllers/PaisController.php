<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Paises;

class PaisController extends Controller
{
 
    public function index(Request $request)
    {
        $buscar=$request->nombre;
        $criterio=$request->criterio;

        if ($buscar=='') {
            $paises= Paises::orderBy('nombre','asc')->paginate(6);
        }else {
            $paises= Paises::where($criterio, 'like', '%'.$buscar. '%')->orderBy('nombre','asc')->paginate(6);
        }

        return [
            'pagination'=>[
                'total'=> $paises -> total(),
                'current_page'=> $paises -> currentPage(),
                'per_page'=> $paises -> perPage(),
                'last_page'=> $paises -> lastPage(),
                'from'=> $paises -> firstItem(),
                'to'=> $paises -> lastItem(),
            ],
            'paises'=>$paises
        ];
    }
    public function getPais(Request $request)
    {
        $paises = Paises::select('id','nombre')
            ->orderBy('nombre', 'asc')->get();
        return [
            'paises' => $paises];
    }


    public function store(Request $request)
    {
        $paises= new Paises();
        $paises->nombre = $request->nombre;
        $paises->save();
    }
    

    public function update(Request $request)
    {
        $paises= Paises::findOrfail($request->id);
        $paises->nombre = $request->nombre;
        $paises->save();
    }

    public function destroy(Request $request)
    {
        $paises= Paises::findOrfail($request->id);
        $paises->delete();
    }
}
