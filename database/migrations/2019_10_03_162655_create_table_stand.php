<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableStand extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stand', function (Blueprint $table) {
            $table->bigInteger('ncodstand',true);
            $table->bigInteger('ncodevento');
            $table->bigInteger('ncodnegocio');
            $table->bigInteger('ncodseccionstand');
            $table->string('cnumerosstand');
            $table->string('ccalificacion');
            $table->string('clongitud');
            $table->string('clatitud');

            $table->foreign('ncodevento')->references('ncodevento')->on('evento');
            $table->foreign('ncodnegocio')->references('ncodnegocio')->on('negocio');
            $table->foreign('ncodseccionstand')->references('ncodseccionstand')->on('seccionstand');
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
        Schema::dropIfExists('stand');
    }
}
