<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TareasTurnos;
use App\Turnos;
use App\User;
use App\Tareas;
date_default_timezone_set('America/Argentina/Buenos_Aires');
class RevisionController extends Controller
{
    public function index(){
        $notas= [];
        $turnos_t = $this->get_data();
        return view('panel.revision.index',compact('turnos_t'));
    }

    public function show($id){
        $tarea_detalle = TareasTurnos::find($id);
        if($tarea_detalle->turnos == null){
            $tarea_detalle['empleada'] = "Sin Asignar";
        }else{
            $turno = Turnos::find($tarea_detalle->turnos);
            $empleada = User::find($turno->id_empleada);
            $tarea_detalle['empleada'] = $empleada->apellido.','.$empleada->nombre;
        }
        $tarea = Tareas::find($tarea_detalle->tarea);
        $tarea_detalle['tareanombre'] = $tarea->nombre; 
        return view('panel.revision.show',compact('tarea_detalle'));
    }

    public function customer(){
        $datos= request()->all();
        if($datos['date']==null){
            $turnos_t = $this->get_data();
        }else{
            $turnos_t = $this->get_data($datos['date']);
        }
        $fecha = $datos['date'];
        return view('panel.revision.index',compact('turnos_t','fecha'));
    }


    private function get_data($fecha=null){
        if($fecha == null){
            $turnos_t = TareasTurnos::where('borrado','no')->get();
        }else{
            $turnos_t = TareasTurnos::whereDate('fecha_realizacion',$fecha)
            ->where('borrado','no')->get();
        }
        foreach($turnos_t as $t){
            if($t->turnos == null){
                $t['empleada'] = "Sin Asignar";
            }else{
                $turno = Turnos::find($t->turnos);
                $empleada = User::find($turno->id_empleada);
                $t['empleada'] = $empleada->apellido.','.$empleada->nombre;
            }
            $tarea = Tareas::find($t->tarea);
            $t['tareanombre'] = $tarea->nombre;   
        }
        return $turnos_t;
    }
}
