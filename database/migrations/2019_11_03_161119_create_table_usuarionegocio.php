<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableUsuarionegocio extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuario_negocio', function (Blueprint $table) {
            //PK
            $table->bigInteger('ncodusuarionegocio',true);
            //CAMPOS DE LA TABLA
            $table->bigInteger('ncodpersona');
            $table->bigInteger('ncodnegocio');

            //REFERENCIAS DE LAS FK
            $table->foreign('ncodpersona')->references('ncodpersona')->on('persona');
            $table->foreign('ncodnegocio')->references('ncodnegocio')->on('negocio');
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
        Schema::dropIfExists('usuario_negocio');
    }
}
