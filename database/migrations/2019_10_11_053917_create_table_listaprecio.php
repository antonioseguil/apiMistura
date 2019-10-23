<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableListaprecio extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listaprecio', function (Blueprint $table) {
            $table->bigInteger('ncodlistaprecio',true);
            $table->bigInteger('ncodstand');
            $table->string('cnombrelista');
            $table->string('cespecificaciones');
            $table->timestamps();

            $table->foreign('ncodstand')->references('ncodstand')->on('stand');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('listaprecio');
    }
}
