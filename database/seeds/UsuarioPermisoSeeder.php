<?php

use Illuminate\Database\Seeder;

class UsuarioPermisoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //TODO* AGREGANDO PERMISOS AL USUARIO TIPO CLIENTE...
        DB::table("tipousuariopermiso")->insert([
            'ncodtipousuario' => '1',
            'ncodpermiso' => '1'
        ]);

        DB::table("tipousuariopermiso")->insert([
            'ncodtipousuario' => '1',
            'ncodpermiso' => '2'
        ]);

        DB::table("tipousuariopermiso")->insert([
            'ncodtipousuario' => '1',
            'ncodpermiso' => '2'
        ]);

        //TODO * AUN FALTA LOS TIPOS USUARIO RESTANTES
    }
}
