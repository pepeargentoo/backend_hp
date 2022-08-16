<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tareas extends Model
{
    protected $fillable=[
        'nombre',
        'hora_inicio',
        'fecha_inicio',
        'fecha_fin',
        'frecuencia', 
        'descripcion',
        'borrado'
    ];
}
