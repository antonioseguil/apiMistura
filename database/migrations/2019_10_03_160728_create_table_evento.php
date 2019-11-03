<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableEvento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evento', function (Blueprint $table) {

            //PK
            $table->bigInteger('ncodevento',true);
            //ATRIBUTOS DE LA TABLA
            $table->bigInteger('ncodpersona');
            $table->string('cnombreevento');
            $table->string('cnombredescripcion');
            $table->date('dfechainicio');
            $table->date('dfechafinal');
            $table->string('dhorainicio');
            $table->string('dhorafinal');
            $table->string('cdireccion');
            $table->string('clongitud');
            $table->string('clatitud');
            $table->string('cestado');
            //REFERENCIAS DE LAS FK DE LAS TABLAS
            $table->foreign('ncodpersona')->references('ncodpersona')->on('persona');
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
        Schema::dropIfExists('evento');
    }
}
