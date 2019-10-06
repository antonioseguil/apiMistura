<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class SeccionStand extends Model
{
    protected $table = "seccionstand";
    protected $primaryKey = "ncodseccionstand";

    protected $fillable = ['ncodseccionstand','cnombredescripcion','ncantidadstand','cestado'];
}
