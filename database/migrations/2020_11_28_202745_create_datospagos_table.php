<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatospagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datospagos', function (Blueprint $table) {
            $table->id();
            $table->integer('id_persona');
            $table->string('ci',20);
            $table->text('direccion');
            $table->string('pais',200);
            $table->string('ciudad',200);
            $table->string('codigopostal',200);
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
        Schema::dropIfExists('datospagos');
    }
}
