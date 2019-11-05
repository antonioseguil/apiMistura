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
            $table->bigInteger('ncodtipousuario')->default(1);
            //demas campos de la tabla
            $table->string('cnombre',60);
            $table->string('capellidopaterno',50);
            $table->string('capellidomaterno',50);
            $table->string('cdni',8)->unique();
            $table->string('cemail',30)->unique();
            $table->string('api_token',60); //autogenerado
            $table->string('imei_phone',120)->unique();
            $table->string('ckeypersona',6)->unique(); //autogenerado
            $table->string('cusuario',30)->unique();
            $table->string('cpassword',70);
            //TODO * A = "ACTIVO", D = "DESABILITADO"
            $table->string('cestado',1)->default("a");
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
