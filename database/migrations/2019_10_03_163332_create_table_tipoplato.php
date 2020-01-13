<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableTipoplato extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipoplato', function (Blueprint $table) {
            $table->bigInteger('ncodtipoplato', true);
            $table->string('cnombretipoplato');
            //agregando foreigne key de personas
            $table->bigInteger('ncodpersona');
            //agregando privacidad
            $table->boolean('privacidad');
            //agregando llave foranea
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
        Schema::dropIfExists('tipoplato');
    }
}
