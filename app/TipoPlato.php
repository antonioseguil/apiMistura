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
        'codpersona', 
        'privacidad'
    ];
}
