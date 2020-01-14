<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $table = "venta";
    protected $primaryKey = "ncodventa";
    protected $fillable = ['codreserva', 'cserie', 'cnumero', 'dfechaemision', 'dhoraemision', 'estado'];
    protected $hidden = ['created_at', 'updated_at'];
}
