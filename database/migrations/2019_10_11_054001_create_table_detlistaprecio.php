<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableDetlistaprecio extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detlistaprecio', function (Blueprint $table) {
            $table->bigInteger('ncoddetlistaprecio',true);
            $table->bigInteger('ncodlistaprecio');
            $table->bigInteger('ncodplato');
            $table->double('cprecio');

            $table->foreign('ncodlistaprecio')->references('ncodlistaprecio')->on('listaprecio');
            $table->foreign('ncodplato')->references('ncodplato')->on('plato');
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
        Schema::dropIfExists('detlistaprecio');
    }
}
