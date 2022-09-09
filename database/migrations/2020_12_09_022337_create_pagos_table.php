<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            $table->integer('id_usuario');
            $table->integer('id_curso');
            $table->integer('id_persona');
            $table->integer('id_estudiante');
            $table->integer('id_datospagos');
            $table->string('detalle',200);
            $table->string('monto',200);
            $table->string('moneda',3);
            $table->string('estado',1);
            $table->text('obs');
            $table->string('fecha',200);
            $table->text('id_transaction');
            $table->text('nreferencia');
            $table->text('data87');
            $table->text('payer');
            $table->text('uuid');
            $table->text('auth_code');
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
        Schema::dropIfExists('pagos');
    }
}
