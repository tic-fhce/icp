<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstudiantehistorialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estudiantehistorial', function (Blueprint $table) {
            $table->id();
            $table->text('nombres');
            $table->text('apellidos');
            $table->text('carnet');
            $table->text('correo');
            $table->integer('id_cursohistorial');
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
        Schema::dropIfExists('estudiantehistorial');
    }
}
