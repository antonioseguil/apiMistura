<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class TipoPlato extends Model
{
    protected $table = "tipoplato";
    protected $primaryKey = "ncodtipoplato";

    protected $fillable = [
        'ncodtipoplato',
        'cnombretipoplato',
        'ncodpersona', 
        'privacidad',
    ];

    protected $hidden = ['created_at', 'updated_at'];
}
