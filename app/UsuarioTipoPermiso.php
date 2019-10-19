<?php
namespace App;


use Illuminate\Database\Eloquent\Model;

class UsuarioTipoPermiso extends Model
{
    protected $table = "tipousuariopermiso";
    protected $primaryKey = "ncodtipousuariopermiso";

    protected $fillable = ['ncodtipousuario','ncodpermiso',];

}
