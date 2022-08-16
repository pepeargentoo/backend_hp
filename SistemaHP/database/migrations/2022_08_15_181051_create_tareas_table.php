<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTareasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tareas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->time('hora_inicio');
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->unsignedBiginteger('frecuencia'); 
            $table->foreign('frecuencia')->references('id')->on('frecuencias');
            $table->string('descripcion');
            $table->enum('borrado',['si','no'])->default('no');
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
        Schema::dropIfExists('tareas');
    }
}
