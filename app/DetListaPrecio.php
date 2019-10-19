<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class DetListaPrecio extends Model
{
    protected $table = "detlistaprecio";
    protected $primaryKey = "ncodsetlistaprecio";
    protected $fillable = ['ncodlistaprecio','ncodplato','cprecio'];
}
