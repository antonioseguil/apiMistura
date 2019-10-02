<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableUsuariopermiso extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuariopermisos', function (Blueprint $table) {
            $table->unsignedInteger('ncodusuariopermiso',true);
            $table->unsignedInteger('ncodusuario');
            $table->unsignedInteger('ncodpermiso');
            $table->foreign('ncodusuario')->references('ncodusuario')->on('usuario');
            $table->foreign('ncodpermiso')->references('ncodpermiso')->on('permiso');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuariopermisos');
    }
}
