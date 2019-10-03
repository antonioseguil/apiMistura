<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableTipousuariopermiso extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipousuariopermiso', function (Blueprint $table) {
            $table->bigInteger('ncodtipousuariopermiso',true);
            $table->bigInteger('ncodtipousuario');
            $table->bigInteger('ncodpermiso');
            $table->foreign('ncodtipousuario')->references('ncodtipousuario')->on('tipousuario');
            $table->foreign('ncodpermiso')->references('ncodpermiso')->on('permiso');
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
        Schema::dropIfExists('tipousuariopermiso');
    }
}
