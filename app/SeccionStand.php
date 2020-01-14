<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class SeccionStand extends Model
{
    protected $table = "seccionstand";
    protected $primaryKey = "ncodseccionstand";

    protected $fillable = [
        'ncodseccionstand',
        'cseccion',
        'codPersona',
        'privacidad',
        'cdescripcion'
    ];
    protected $hidden = ['created_at', 'updated_at'];
}
