<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TareasTurnos extends Model
{
    protected $fillable = [
        'estado',
        'turnos',
        'tarea',
        'reemplazo',
        'fecha_realizacion',
        'dia',
        'borrado'
    ];


   
}
