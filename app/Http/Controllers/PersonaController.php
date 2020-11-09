<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Personas;

class PersonaController extends Controller
{

    public function index(Request $request)
    {
        $buscar=$request->nombres;
        $criterio=$request->criterio;

        if ($buscar=='') {
            $personas= Personas::orderBy('nombres','asc')->paginate(4);
        }else {
            $personas= Personas::where($criterio, 'like', '%'.$buscar. '%')->orderBy('nombres','asc')->paginate(4);
        }
        return [
            'pagination'=>[
                'total'=> $personas -> total(),
                'current_page'=> $personas -> currentPage(),
                'per_page'=> $personas -> perPage(),
                'last_page'=> $personas -> lastPage(),
                'from'=> $personas -> firstItem(),
                'to'=> $personas -> lastItem(),
            ],
            'personas'=>$personas
        ];
    }

    public function getPersonas(Request $request)
    {
        $personas = Personas::select('id','nombres','apellidos','nomCom')
            ->orderBy('nombres', 'asc')->get();
        return [
            'personas' => $personas
        ];
    }

    public function store(Request $request)
    {
        $personas= new Personas();
        $personas->nombres = $request->nombres;
        $personas->apellidos = $request->apellidos;
        $personas->dir = $request->dir;
        $personas->tel = $request->tel;
        $personas->email = $request->email;
        $personas->save();
    }
    

    public function update(Request $request)
    {
        $personas= Personas::findOrfail($request->id);
        $personas->nombres = $request->nombres;
        $personas->apellidos = $request->apellidos;
        $personas->dir = $request->dir;
        $personas->tel = $request->tel;
        $personas->email = $request->email;
        $personas->save();
    }

    public function destroy(Request $request)
    {
        $personas= Personas::findOrfail($request->id);
        $personas->delete();
    }
}
