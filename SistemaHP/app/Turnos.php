<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Turnos extends Model
{
    
    protected $fillable=[
        'hora_inicio',
        'hora_fin',
        'id_empleada',
        'dia',
        'borrado'
    ];
}
