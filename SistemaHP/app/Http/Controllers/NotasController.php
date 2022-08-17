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
        $notas = $this->get_data();
        $empleadas = User::where('rol','empleada')
        ->where('borrado','no')->get(); 
        return view('panel.notas.index',compact('notas','empleadas'));
    }

    public function coutome(){
        $datos = request()->all();
        $id_empleada = $datos['id_empleada'];
        $notas = $this->get_data($id_empleada);
        $empleadas = User::where('rol','empleada')
        ->where('borrado','no')->get(); 
        return view('panel.notas.index',compact('notas','empleadas','id_empleada'));   
    }

    private function get_data($empleada=null){
        if($empleada == null){
            $notas= Notas::all();
        }else{
            $notas= Notas::where('id_empleada',$empleada)->get();
        }
        foreach($notas as $n){
            $empleada = User::find($n->id_empleada);
            $n['empleada'] = $empleada->apellido.','.$empleada->nombre;
            $fecha =Carbon::createFromFormat('Y-m-d',$n->fecha);
            $n->fecha = $fecha->format('d/m/Y');
        }
        return $notas;
    }

    public function show($id){
        $nota = Notas::find($id);
        $empleada = User::find($nota->id_empleada);
        $nota['empleada'] = $empleada->apellido.','.$empleada->nombre;
        return view('panel.notas.show',compact('nota'));
    }
}
