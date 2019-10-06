<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class Negocio extends Model
{
    protected $table = "negocio";
    protected $primaryKey = "ncodnegocio";

    protected $fillable = ['ncodnegocio','cnombrenegocio','cnombredescripcion','cdireccion',
                           'cnombreusuario','cpassword','ncantidadusuarios'];

    protected $hidden = ['cpassword'];

}
