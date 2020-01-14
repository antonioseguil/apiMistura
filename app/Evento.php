<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{

    /*
    protected $table = "";
    protected $primaryKey = "";
     */

    protected $table = "evento";
    protected $primaryKey = "ncodevento";

    protected $fillable = [
        'ncodpersona',
        'cnombreevento',
        'cnombredescripcion',
        'dfechainicio',
        'dfechafinal',
        'dhorainicio',
        'dhorafinal',
        'cdireccion',
        'clongitud',
        'clatitud',
        'cestado'
    ];
    
    protected $hidden = ['created_at', 'updated_at'];
}
