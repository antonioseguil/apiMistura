<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    protected $table = "reserva";
    protected $primaryKey = "ncodreseva";
    protected $fillable = ['ncodcliente','ncantidadtotal','dfechareserva','cestado'];
}
