<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TareasTurnos extends Model
{
    protected $fillable = [
        'estado',
        'turnos',
        'tarea', 
        'fecha_realizacion',
        'dia',
        'borrado'
    ];
}
