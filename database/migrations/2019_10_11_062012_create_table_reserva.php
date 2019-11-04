<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableReserva extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reserva', function (Blueprint $table) {
            $table->bigInteger('ncodreserva',true);
            $table->bigInteger('ncodpersona');
            $table->integer('ncantidadtotal');
            $table->date('dfechareserva');
            //TODO* ESTADOS: E = "ENTREGADO, "R" = RESERVADO, "C"=CANCELADO
            $table->string('cestado',1)->default("r");
            $table->timestamps();

            $table->foreign('ncodpersona')->references('ncodpersona')->on('persona');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reserva');
    }
}
