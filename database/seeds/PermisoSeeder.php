<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class PermisoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //insertando datos en la DB
        //TODO * PERMISOS PARA ADMINISTRADOR EVENTO
        //1
        DB::table('permiso')->insert([
            'cnombrepermiso' => 'Dashboard',
        ]);
//1
        DB::table('permiso')->insert([
            'cnombrepermiso' => 'Evento',
        ]);
//2
        DB::table('permiso')->insert([
            'cnombrepermiso' => 'Sección',
        ]);
//3
        DB::table('permiso')->insert([
            'cnombrepermiso' => 'Stand',
        ]);
//4
        DB::table('permiso')->insert([
            'cnombrepermiso' => 'Negocio',
        ]);
//5
        DB::table('permiso')->insert([
            'cnombrepermiso' => 'Usuario',
        ]);
//6
        DB::table('permiso')->insert([
            'cnombrepermiso' => 'Distribución de stand',
        ]);
//7
        DB::table('permiso')->insert([
            'cnombrepermiso' => 'Consultas',
        ]);
//8
        DB::table('permiso')->insert([
            'cnombrepermiso' => 'Reportes',
        ]);
//9
        DB::table('permiso')->insert([
            'cnombrepermiso' => 'Generar tarjetas',
        ]);



        /*DB::table('permiso')->insert([
            'cnombrepermiso' => 'Mantenimientos',
        ]);*/

        //TODO * PERMISOS PARA ADMINISTRADOR NEGOCIO
//10
        DB::table('permiso')->insert([
            'cnombrepermiso' => 'Tipo plato',
        ]);
//11
        DB::table('permiso')->insert([
            'cnombrepermiso' => 'Plato',
        ]);
//13
        DB::table('permiso')->insert([
            'cnombrepermiso' => 'Listado de precios',
        ]);



    }
}
