<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableSeccionstand extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seccionstand', function (Blueprint $table) {
            $table->bigInteger('ncodseccionstand',true);
            $table->string('cnombredescripcion');
            $table->integer('ncantidadstand');
            $table->string('cestado');
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
        Schema::dropIfExists('seccionstand');
    }
}
