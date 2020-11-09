<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Solicitud_libros;
use App\Det_solicitudes;

class Solicitud_librosController extends Controller
{
    //
    public function index(Request $request)
    {
        $buscar   = $request->buscar;
        // $criterio = $request->criterio;

        if ($buscar == '') {
            $solicitud = Solicitud_libros::orderBy('id', 'asc')->paginate(1);
        } else {
            $solicitud = Solicitud_libros::where('criterio', '=', $buscar) -> orderBy('id', 'asc')->paginate(1);
        }

        return [
            'pagination' => [
                'total'        => $solicitud->total(),
                'current_page' => $solicitud->currentPage(),
                'per_page'     => $solicitud->perPage(),
                'last_page'    => $solicitud->lastPage(),
                'from'         => $solicitud->firstItem(),
                'to'           => $solicitud->lastItem(),

            ],
            'solicitud'  => $solicitud,
        ];
}

public function store(Request $request)
{
    try {
        DB::beginTransaction();
        
        $solicitud= new Solicitud_libros();
        $solicitud->fec_entrega = $request->fec_entrega;
        $solicitud->id_persona = $request->id_persona;
        $solicitud->save();

        $detalles=$request->data;

        foreach ($detalles as $key => $det){
            
            $detalle = new Det_solicitudes();
            $detalle->id_solicitud = $solicitud->id;
            $detalle->id_libro = $det['id'];
            $detalle->cant = $det['cant'];
            $detalle->save();
            
        }
        DB::commit();
    } catch (Exception $e) {
        DB::rollBack();
        console.log('Error', $e);
    }
}
}