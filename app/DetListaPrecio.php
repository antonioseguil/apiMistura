<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class DetListaPrecio extends Model
{
    protected $table = "detlistaprecio";
    protected $primaryKey = "ncoddetlistaprecio";
    protected $fillable = ['ncodlistaprecio','ncodplato','cprecio'];
    protected $hidden = ['created_at', 'updated_at'];
}
