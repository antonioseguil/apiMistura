<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = "cliente";
    protected $primaryKey = "ncodcliente";
    protected $fillable = ['cusuario','cpassword','cnombre','capellidopaterno','capellidomaterno',
        'cdni','ccorreo','apitoken'];

    protected $hidden = ['cpassword'];
}
