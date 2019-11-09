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

        //TODO * AGREGAND PERMISOS PARA ADMINISTRADOR EVENTO
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
            'ncodpermiso' => '3'
        ]);
        DB::table("tipousuariopermiso")->insert([
            'ncodtipousuario' => '2',
            'ncodpermiso' => '4'
        ]);

        DB::table("tipousuariopermiso")->insert([
            'ncodtipousuario' => '2',
            'ncodpermiso' => '5'
        ]);

        DB::table("tipousuariopermiso")->insert([
            'ncodtipousuario' => '2',
            'ncodpermiso' => '6'
        ]);

        DB::table("tipousuariopermiso")->insert([
            'ncodtipousuario' => '2',
            'ncodpermiso' => '7'
        ]);

        DB::table("tipousuariopermiso")->insert([
            'ncodtipousuario' => '2',
            'ncodpermiso' => '8'
        ]);

        DB::table("tipousuariopermiso")->insert([
            'ncodtipousuario' => '2',
            'ncodpermiso' => '9'
        ]);

        DB::table("tipousuariopermiso")->insert([
            'ncodtipousuario' => '2',
            'ncodpermiso' => '10'
        ]);

        //TODO * ADMINISTRADOR DE EVENTO

        DB::table("tipousuariopermiso")->insert([
            'ncodtipousuario' => '3',
            'ncodpermiso' => '10'
        ]);

        DB::table("tipousuariopermiso")->insert([
            'ncodtipousuario' => '3',
            'ncodpermiso' => '11'
        ]);

        DB::table("tipousuariopermiso")->insert([
            'ncodtipousuario' => '3',
            'ncodpermiso' => '13'
        ]);

        DB::table("tipousuariopermiso")->insert([
            'ncodtipousuario' => '3',
            'ncodpermiso' => '9'
        ]);

        DB::table("tipousuariopermiso")->insert([
            'ncodtipousuario' => '3',
            'ncodpermiso' => '7'
        ]);


        //TODO * AUN FALTA LOS TIPOS USUARIO RESTANTE



    }
}
