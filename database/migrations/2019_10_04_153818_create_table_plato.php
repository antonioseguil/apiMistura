<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablePlato extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plato', function (Blueprint $table) {
            $table->bigInteger('ncodplato',true);
            $table->bigInteger('ncodtipoplato');
            $table->string('cnombreplato');
            $table->string('cdescresena');
            $table->string('curlimagen');
            //agregando foreigne key de personas
            $table->bigInteger('ncodpersona');
            //agregando privacidad
            $table->boolean('privacidad');
            //agregando llave foranea
            $table->foreign('ncodpersona')->references('ncodpersona')->on('persona');
            $table->foreign('ncodtipoplato')->references('ncodtipoplato')->on('tipoplato');
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
        Schema::dropIfExists('plato');
    }
}
