<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Frecuencia extends Model
{
    protected $fillable=[
        'descripcion',
        'n_dias',
        'borrado'
    ];
}
