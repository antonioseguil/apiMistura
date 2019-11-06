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
        //insertando datos en la BD usando elonqued
        DB::table('permiso')->insert([
            'cnombrepermiso' => 'Reservas',
        ]);

        DB::table('permiso')->insert([
            'cnombrepermiso' => 'Negocios',
        ]);

        DB::table('permiso')->insert([
            'cnombrepermiso' => 'Secciones',
        ]);

    }
}
