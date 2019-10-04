<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableStandplato extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('standplato', function (Blueprint $table) {
            $table->bigInteger('ncodstand');
            $table->bigInteger('ncodplato');

            $table->foreign('ncodstand')->references('ncodstand')->on('stand');
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
        Schema::dropIfExists('standplato');
    }
}
