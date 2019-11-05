<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\DB;

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
            'cnombrepermiso' => 'Cliente',
        ]);
    }
}
