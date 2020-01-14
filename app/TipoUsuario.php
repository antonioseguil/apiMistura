<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class TipoUsuario extends Model
{
    protected $table = "tipousuario";
    protected $primaryKey = "ncodtipousuario";

    protected $fillable = ['ncodtipousuario','ctipousuario'];
    protected $hidden = ['created_at', 'updated_at'];
}
