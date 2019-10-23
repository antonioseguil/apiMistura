<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class ListaPrecio extends Model
{

    protected $table = "listaprecio";
    protected $primaryKey = "ncodlistaprecio";
    protected $fillable = ['ncodstand','cnombrelista','cespecificaciones'];
}
