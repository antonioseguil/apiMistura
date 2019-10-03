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
            $table->bigInteger('ncodevento',true);
            $table->bigInteger('ncodusuario');
            $table->string('cnombreevento');
            $table->string('cnombredescripcion');
            $table->date('dfechainicio');
            $table->date('dfechafinal');
            $table->string('dhorainicio');
            $table->string('dhorafinal');
            $table->string('cdireccion');
            $table->string('clongitud');
            $table->string('clatitud');
            $table->foreign('ncodusuario')->references('ncodusuario')->on('usuario');
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
