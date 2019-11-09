<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableLoginrequest extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loginrequest', function (Blueprint $table) {
            //PK de la tabla
            $table->bigInteger('ncodloginrequest',true);
            $table->bigInteger('ncodpersona');
            $table->string('cimei',90)->unique();
            $table->date('dfecha_ultimo');
            // ESTADOS-> E=ESPERANDO, A=ACEPTADO , R=RECHAZADO
            $table->string('cestado',1)->default('e');

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
        Schema::dropIfExists('loginrequest');
    }
}
