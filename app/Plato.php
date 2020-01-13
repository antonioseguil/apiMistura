<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class Plato extends Model
{
    protected $table = "plato";
    protected $primaryKey = "ncodplato";

    protected $fillable = [
        'ncodplato',
        'ncodtipoplato',
        'cnombreplato',
        'cdescresena',
        'curlimagen',
        'codpersona',
        'privacidad'
    ];
}
