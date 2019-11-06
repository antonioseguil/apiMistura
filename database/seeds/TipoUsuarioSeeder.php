<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoUsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //cliente -> el que asiste a los eventos
        DB::table("tipousuario")->insert([
            'ctipousuario' => 'Cliente'
        ]);
        //administrador -> el que genera los eventos, secciones, agrega negocios,etc...
        DB::table("tipousuario")->insert([
            'ctipousuario' => 'Administrador'
        ]);
        //administrador negocio -> el encargado de un negocio
        DB::table("tipousuario")->insert([
            'ctipousuario' => 'Administrador Negocio'
        ]);
        //usuario negocio -> el en ayudante de un negocio, lee la reservas hechas
        DB::table("tipousuario")->insert([
            'ctipousuario' => 'Usuario Negocio'
        ]);
    }
}
