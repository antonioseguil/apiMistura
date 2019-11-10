<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class Stand extends Model
{
    protected $table = "stand";
    protected $primaryKey = "ncodstand";

    protected $fillable = ['ncodstand','ncodevento','ncodnegocio','ncodseccionstand',
                           'cnumerosstand','ccalificacion','clongitud','clatitud','cestado'];
}
