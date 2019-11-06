<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $this->truncateTable([
            'permiso',
            'tipousuario',
            'tipousuariopermiso'
        ]);
        $this->call(PermisoSeeder::class);
        $this->call(TipoUsuarioSeeder::class);
        $this->call(UsuarioPermisoSeeder::class);
    }

    public function truncateTable(array $tables){
        //desactivando la revision de llaves foraneas
        DB::statement("SET FOREIGN_KEY_CHECKS = 0;");

        foreach ($tables as $table){
            DB::table($table)->truncate();
        }

        //activando la revision de llaves foraneas
        DB::statement("SET FOREIGN_KEY_CHECKS = 1;");
    }
}
