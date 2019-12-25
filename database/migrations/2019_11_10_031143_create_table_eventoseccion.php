<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableEventoseccion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eventoseccion', function (Blueprint $table) {
            $table->bigInteger('ncodeventoseccion',true);
            $table->bigInteger('ncodseccionstand');
            $table->bigInteger('ncodevento');
            $table->bigInteger('ncantidadstand');
            //TODO C = CERRADO, A=ABIERTO
            $table->string('cestado',1)->default('A');
            $table->timestamps();

            $table->foreign('ncodevento')->references('ncodevento')->on('evento');
            $table->foreign('ncodseccionstand')->references('ncodseccionstand')->on('seccionstand');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('eventoseccion');
    }
}
