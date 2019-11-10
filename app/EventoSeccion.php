<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class EventoSeccion extends Model
{
    protected $table = "eventoseccion";
    protected $primaryKey = "ncodeventoseccion";
    public $timestamps = false; // momentanio
    protected $fillable = ['ncodeventoseccion','ncodseccionstand','ncodevento','ncantidadstand','cestado'];
}
