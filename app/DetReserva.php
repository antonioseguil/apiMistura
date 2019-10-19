<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class DetReserva extends Model
{
    protected $table = "detreserva";
    protected $primaryKey = "ncoddetreserva";
    protected $fillable = ['ncodreserva','ncantidad','nprecio'];
}
