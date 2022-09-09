<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModulohistorialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modulohistorial', function (Blueprint $table) {
            $table->id();
            $table->integer('id_cursohistorial');
            $table->text('sigla');
            $table->text('modulo');
            $table->integer('id_docentehistorial');
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
        Schema::dropIfExists('modulohistorial');
    }
}
