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
        $tares = TareasTurnos::all();
        $cantidad = 0;
        $pendiente = TareasTurnos::where('estado','pendiente')->count();
        $terminadas = TareasTurnos::where('estado','<>','pendiente')->count();
        
        
        /*
        foreach($empleadas as $e){
            $turnos_del_empleado = Turno::where('id_empleada',$e->id)->get();
            foreach($turnos_del_empleado as $t){
                $cantidad = TareasTurnos::where('turnos',$t->id)->where('estado','terminado')->count();
            }
            $torta_empleada[$e->nombre] = $cantidad;
        }*/

        //dd($torta_empleada);
        foreach($tares as $t){
            $tarea = Tareas::find($t->tarea);
            if($t['turnos'] == null){
                $t['empleada'] = 'sin asignar';
            }
            $t['tareanombre'] = $tarea->nombre;
            $t['hora_inicio'] = $tarea->hora_inicio;
            $t['hora_fin'] = $tarea->hora_fin;
        }

        $torta1=array('reemplazo'=>$reemplazo,'no_reemplazo'=>$no_reemplazo);
        $torta2 = array('pendiente'=>$pendiente,'terminadas'=>$terminadas);
        return view('panel.informes.index',compact('tares','empleadas','torta1','torta2'));
    }
}
