<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTareasTurnosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tareas_turnos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('estado',['terminado','pendiente'])->default('pendiente');
            
            $table->unsignedBigInteger('turnos')->nullable();
            $table->foreign('turnos')->references('id')->on('turnos');

            $table->unsignedBigInteger('tarea')->nullable();
            $table->foreign('tarea')->references('id')->on('tareas');

            $table->unsignedBigInteger('reemplazo')->nullable();
            $table->foreign('reemplazo')->references('id')->on('users');

            $table->date('fecha_realizacion');
            $table->string('dia');
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
        Schema::dropIfExists('tareas_turnos');
    }
}
