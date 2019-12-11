<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class Negocio extends Model
{
    protected $table = "negocio";
    protected $primaryKey = "ncodnegocio";

    protected $fillable = ['crazonsocial','cnombredescripcion','cdireccion',
                           'cruc','cestado'];

}
