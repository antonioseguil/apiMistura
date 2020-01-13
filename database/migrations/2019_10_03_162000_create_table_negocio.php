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
            //PK
            $table->bigInteger('ncodnegocio',true);
            //CAMPOS DE LA TABLA
            $table->string('crazonsocial');
            $table->string('cnombredescripcion');
            $table->string('cdireccion');
            $table->string('cruc',11);
            $table->boolean('privacidad');
            //TODO* A = "ACTIVO", "D" = "DESABILITADO"
            $table->string('cestado',1)->default("A");
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
