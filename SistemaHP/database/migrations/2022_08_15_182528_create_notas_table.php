<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBiginteger('id_empleada'); 
            $table->foreign('id_empleada')->references('id')->on('users');
            $table->string('titulo');
            $table->string('descripcion');
            $table->enum('tipo',['urgente','normal'])->default('normal');
            $table->enum('estado',['enviado','sinenviar'])->default('sinenviar');
            $table->date('fecha');
            $table->time('hora');
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
        Schema::dropIfExists('notas');
    }
}
