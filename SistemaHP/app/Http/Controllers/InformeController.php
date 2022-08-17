<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
date_default_timezone_set('America/Argentina/Buenos_Aires');
use Auth;
use App\User;
use App\TareasTurnos;
use App\Tareas;
use App\Turnos;
use Carbon\Carbon;

class InformeController extends Controller
{
    public function index(){
        $empleadas = User::where('borrado','no')
        ->where('rol','empleada')->get();
        $torta_empleada = [];
        $reemplazo = TareasTurnos::where('reemplazo',null)->count();
        $no_reemplazo = TareasTurnos::where('reemplazo','<>',null)->count();
        $tares = $this->get_data();
        $cantidad = 0;
        $pendiente = TareasTurnos::where('estado','pendiente')->where('borrado','no')->count();
        $terminadas = TareasTurnos::where('estado','terminado')->where('borrado','no')->count();
        
        

        $torta1=array('reemplazo'=>$reemplazo,'no_reemplazo'=>$no_reemplazo);
        $torta2 = array('pendiente'=>$pendiente,'terminadas'=>$terminadas);
        return view('panel.informes.index',compact('tares','empleadas','torta1','torta2'));
    }

    public function index_coutome(){
        $datos = request()->all();
        $id_empleada = $datos['id_empleada'];
        $tares = $this->get_data($id_empleada);
        $empleadas = User::where('borrado','no')
        ->where('rol','empleada')->get();
        $torta_empleada = [];
        $reemplazo = TareasTurnos::where('reemplazo',null)->count();
        $no_reemplazo = TareasTurnos::where('reemplazo','<>',null)->count();
        
        $cantidad = 0;
        $pendiente = TareasTurnos::where('estado','pendiente')->where('borrado','no')->count();
        $terminadas = TareasTurnos::where('estado','terminado')->where('borrado','no')->count();
        $torta1=array('reemplazo'=>$reemplazo,'no_reemplazo'=>$no_reemplazo);
        $torta2 = array('pendiente'=>$pendiente,'terminadas'=>$terminadas);
        return view('panel.informes.index',compact('tares','empleadas','torta1',
            'torta2','id_empleada'));
    }

    private function get_data($empleada=null){
        if($empleada == null){
            $tares = TareasTurnos::where('borrado','no')->get();
        }else{
            $turnos = Turnos::where('id_empleada',$empleada)->get(['id']);    
            $tares = TareasTurnos::where('borrado','no')->whereIn('turnos',$turnos)
            ->get();
        }
        foreach($tares as $t){
            $tarea = Tareas::find($t->tarea);
            if($t['turnos'] == null){
                $t['empleada'] = 'sin asignar';
            }else{
                $turno = Turnos::find($t->turnos);
                $empleada = User::find($turno->id_empleada);
                $t['empleada'] = $empleada->apellido.', '.$empleada->nombre;
            }
            $t['tareanombre'] = $tarea->nombre;
            $t['hora_inicio'] = $tarea->hora_inicio;
            $t['hora_fin'] = $tarea->hora_fin;
        }
        return $tares;
    }
}
