<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableUsuario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuario', function (Blueprint $table) {
            $table->bigInteger('ncodusuario',true);
            $table->string('cusuario');
            $table->string('cpassword');
            $table->string('cnombre');
            $table->string('capellidopaterno');
            $table->string('capellidomaterno');
            $table->string('api_token',60);
            $table->bigInteger('ncodtipousuario');
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
        Schema::dropIfExists('usuario');
    }
}
