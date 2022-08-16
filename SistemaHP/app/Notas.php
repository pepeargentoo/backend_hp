<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notas extends Model
{
    protected $fillable=[
        'id_empleada',
        'descripcion',
        'tipo',
        'titulo',
        'fecha',
        'hora',
        'borrado'
    ];
}
