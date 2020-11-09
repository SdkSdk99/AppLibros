<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Solicitud_libros extends Model
{
    //
    protected $table = 'solicitud_libros'; 
    protected $fillable=['id','fec_sol','fec_entrega','id_persona'];
    public $timestamps=false;
}
