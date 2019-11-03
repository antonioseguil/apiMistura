<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablePersona extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persona', function (Blueprint $table) {
            $table->bigInteger('ncodpersona',true);
            //tipo de usuario
            $table->bigInteger('ncodtipousuario');
            //demas campos de la tabla
            $table->string('cnombre');
            $table->string('capellidopaterno');
            $table->string('capellidomaterno');
            $table->string('cdni',8)->unique();
            $table->string('cemail')->unique();
            $table->string('api_token',60); //autogenerado
            $table->string('imei_phone')->unique();
            $table->string('ckeypersona',6)->unique(); //autogenerado
            $table->string('cusuario');
            $table->string('cpassword');
            //TODO * A = "ACTIVO", D = "DESABILITADO"
            $table->string('cestado')->default("a");
            //referencia de la tabla externa
            $table->foreign('ncodtipousuario')->references('ncodtipousuario')->on('tipousuario');
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
        Schema::dropIfExists('persona');
    }
}
