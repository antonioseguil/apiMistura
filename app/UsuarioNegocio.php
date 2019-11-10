<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class UsuarioNegocio extends Model
{
    protected $table = "usuario_negocio";
    protected $primaryKey = "ncodusuarionegocio";
    protected $fillable = ['ncodpersona','ncodnegocio','cestado'];

}
