<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Turnos;
use App\Tareas;
use App\TareasTurnos;
use Illuminate\Support\Facades\Session;
date_default_timezone_set('America/Argentina/Buenos_Aires');
class DistribucionController extends Controller
{
    //
    public function index(){
        $turnos = Turnos::where('borrado','no')->get();
        $dias = $this->get_week();
        foreach($turnos as $t){
            $t->dia = $dias[$t->dia];
            $empleada = User::find($t->id_empleada);
            if($empleada == null){
                $t['empleada'] = '';
            }else{
                $t['empleada'] = $empleada['apellido'].', '.$empleada['nombre'];
            }
        } 
        return view('panel.distribucion.index',compact('turnos'));
    }

    public function index_create()
    {   
        $empleadas = User::where('rol','empleada')->where('borrado','no')->get();
        $week = $this->get_week(); 
        return view('panel.distribucion.create',compact('empleadas','week'));
    }

    public function edit($id){
        $turno = Turnos::find($id);
        if($turno == null){
            Session::flash('mensaje','El turno no existe');
            return redirect()->to('ppal/distribucion');
        }
        $empleadas = User::where('rol','empleada')->get();
        $week = $this->get_week();
        return view('panel.distribucion.create',compact('empleadas','turno','week'));
    }
    
    public function save($id){
        $datos = request()->all();
        $turnos_del_dia = Turnos::where('dia',$datos['dia'])
        ->where('borrado','no')
        ->where('id','<>',$id)->get();
        foreach($turnos_del_dia as $t){
            if($t->hora_inicio< $datos['hora_fin'] && $t->hora_fin > $datos['hora_inicio']){
                Session::flash('mensaje','Horario ocupado con otro turno');
                return redirect()->to('ppal/distribucion');
            }
        }
        $turno_nuevo = Turnos::find($id);
        if($datos['dia'] != $turno_nuevo['dia']){
            $tareas_turnos = TareasTurnos::where('turnos',$id)
            ->where('dia',$turno_nuevo['dia'])
            ->update(['turnos' => null]);

            $upddate_turnos =$this->get_task($datos['dia'],
                                        $datos['hora_inicio'],
                                        $datos['hora_fin']); 
            
            if($upddate_turnos != null){
                foreach($upddate_turnos as $t){
                    $turno_tarea = TareasTurnos::find($t);
                    $turno_tarea->turnos = $id;
                    $turno_tarea->save();
                }
            }
        
        }
        $turno_nuevo->fill($datos);
        $turno_nuevo->save();
        Session::flash('mensaje','El turno fue asignado con éxito');
        return redirect()->to('ppal/distribucion');
    }
    
    public function create(){
        $datos = request()->all();
        $turnos_del_dia = Turnos::where('dia',$datos['dia'])->get();
        foreach($turnos_del_dia as $t){
            if($t->hora_inicio< $datos['hora_fin'] && $t->hora_fin > $datos['hora_inicio']){
                Session::flash('mensaje','Horario ocupado con otro turno');
                return redirect()->to('ppal/distribucion');
            }
        }
        $tareas_turnos =$this->get_task($datos['dia'],
                                        $datos['hora_inicio'],
                                        $datos['hora_fin']); 
        
        $turno_nuevo = Turnos::create($datos);
        if($tareas_turnos != null){
            foreach($tareas_turnos as $t){
                $turno_tarea = TareasTurnos::find($t);
                $turno_tarea->turnos = $turno_nuevo->id;
                $turno_tarea->save();
            }
        }
        Session::flash('mensaje','El turno fue asignado con éxito');
        return redirect()->to('ppal/distribucion');
    }

    public function delete($id){
        $turno = Turnos::find($id);
        if($turno == null){
            return array('status'=>'faild');
        }
        $tareas_turnos = TareasTurnos::where('turnos',$id)->update(['turnos' => null]);
        $turno->borrado='no';
        $turno->save();

        return array('status'=>'success');
    }
    private function get_task($dia,$inicio,$fin){
        $tareas_turnos = TareasTurnos::where('dia',$dia)->get();
        if(count($tareas_turnos)==0){
            return null;
        }
        $task_list = [];
        foreach($tareas_turnos as $t){
            $tarea = Tareas::find($t->tarea);
            if($tarea->hora_inicio >= $inicio && $tarea->hora_fin <= $fin){
                $task_list[] = $t->id;
            }
        }
        return $task_list; 
    }

    private function get_week(){
        $week = [
                "Monday"=>"Lunes",
                "Tuesday"=>"Martes",
                "Wednesday"=>"Miercoles",
                "Thursday"=>"Jueves",
                "Friday"=>"Viernes",
                "Saturday"=>"Sabado",
                "Sunday"=>"Domingo"
        ];
        return $week;
    }
}
