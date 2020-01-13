<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableSeccionstand extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seccionstand', function (Blueprint $table) {
            $table->bigInteger('ncodseccionstand',true);
            $table->string('cseccion');
            $table->string('cdescripcion');
            //agregando foreigne key de personas
            $table->bigInteger('ncodpersona');
            //agregando privacidad
            $table->boolean('privacidad');
            //agregando llave foranea
            $table->foreign('ncodpersona')->references('ncodpersona')->on('persona');
            //=================================
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
        Schema::dropIfExists('seccionstand');
    }
}
