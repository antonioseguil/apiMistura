<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableVenta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('venta', function (Blueprint $table) {
            $table->bigInteger('ncodventa',true);
            $table->bigInteger('ncodreserva');
            $table->string('cserie');
            $table->string('cnumero');
            $table->date('dfechaemision');
            $table->string('dhoraemision');
            $table->string('estado');
            $table->timestamps();

            $table->foreign('ncodreserva')->references('ncodreserva')->on('reserva');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('venta');
    }
}
