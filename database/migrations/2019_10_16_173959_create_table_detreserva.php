<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableDetreserva extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detreserva', function (Blueprint $table) {
            $table->bigInteger('ncoddetreserva',true);
            $table->bigInteger('ncoddetlistaprecio');
            $table->bigInteger('ncodreserva');
            $table->Integer('ncantidad');
            $table->timestamps();

            $table->foreign('ncoddetlistaprecio')->references('ncoddetlistaprecio')->on('detlistaprecio');
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
        Schema::dropIfExists('detreserva');
    }
}
