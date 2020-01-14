<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    protected $table = "reserva";
    protected $primaryKey = "ncodreserva";
    protected $fillable = ['ncodpersona','ncantidadtotal','dfechareserva','dfecharecojo','cestado'];
    protected $hidden = ['created_at', 'updated_at'];
}
