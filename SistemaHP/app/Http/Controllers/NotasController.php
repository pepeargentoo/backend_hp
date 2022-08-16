<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notas;
use App\User;
use Carbon\Carbon;
date_default_timezone_set('America/Argentina/Buenos_Aires');
class NotasController extends Controller
{
    public function index(){
        $notas= Notas::all();
        foreach($notas as $n){
            $empleada = User::find($n->id_empleada);
            $n['empleada'] = $empleada->apellido.','.$empleada->nombre;
            //dd($n->fecha->format('d/m/Y'));
            $fecha =Carbon::createFromFormat('Y-m-d',$n->fecha);
            $n->fecha = $fecha->format('d/m/Y');
        }
        //dd($notas);
        return view('panel.notas.index',compact('notas'));
    }

    public function show($id){
        $nota = Notas::find($id);
        $empleada = User::find($nota->id_empleada);
        $nota['empleada'] = $empleada->apellido.','.$empleada->nombre;
        
        return view('panel.notas.show',compact('nota'));
    }
}
