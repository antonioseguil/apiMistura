<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableNegocio extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('negocio', function (Blueprint $table) {
            $table->bigInteger('ncodnegocio',true);
            $table->string('cnombrenegocio');
            $table->string('cnombredescripcion');
            $table->string('cdireccion');
            $table->string('cnombreusuario');
            $table->string('cpassword');
            $table->integer('ncantidadusuarios');
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
        Schema::dropIfExists('negocio');
    }
}
