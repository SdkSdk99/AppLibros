<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Personas extends Model
{
    //
    protected $fillable=['id','nombres','apellidos','dir','tel','email','nomCom'];
    public $timestamps=false;
}
