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
        DB::table('permiso')->insert([
            'cnombrepermiso' => 'Dashboard',
        ]);

        DB::table('permiso')->insert([
            'cnombrepermiso' => 'Mantenimientos',
        ]);

        DB::table('permiso')->insert([
            'cnombrepermiso' => 'Evento',
        ]);

        DB::table('permiso')->insert([
            'cnombrepermiso' => 'Sección',
        ]);

        DB::table('permiso')->insert([
            'cnombrepermiso' => 'Negocio',
        ]);

        DB::table('permiso')->insert([
            'cnombrepermiso' => 'Usuario',
        ]);

        DB::table('permiso')->insert([
            'cnombrepermiso' => 'Tipo plato',
        ]);

        DB::table('permiso')->insert([
            'cnombrepermiso' => 'Plato',
        ]);

        DB::table('permiso')->insert([
            'cnombrepermiso' => 'Listado de precios',
        ]);

        DB::table('permiso')->insert([
            'cnombrepermiso' => 'Distribución de stand',
        ]);

        DB::table('permiso')->insert([
            'cnombrepermiso' => 'Generar tarjeta',
        ]);

        DB::table('permiso')->insert([
            'cnombrepermiso' => 'Consultas',
        ]);

        DB::table('permiso')->insert([
            'cnombrepermiso' => 'Reportes',
        ]);

    }
}
