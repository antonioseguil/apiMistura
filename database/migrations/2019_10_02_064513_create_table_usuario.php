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
            $table->unsignedInteger('ncodusuario',true);
            $table->string("cnombreusuario");
            $table->string("cnombrepassword");
            $table->string("cnombre");
            $table->string("capellidopaterno");
            $table->string("capellidomaterno");
            $table->string("api_token",60);
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
