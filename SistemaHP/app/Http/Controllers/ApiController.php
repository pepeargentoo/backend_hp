<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Turnos;
use App\Tareas;
use App\TareasTurnos;
use App\Notas;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Mail;
date_default_timezone_set('America/Argentina/Buenos_Aires');
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");

class ApiController extends Controller
{
    public function login(request $request){
        $datos = request()->all();
        $credentials = $request->validate([
            'usuario' => ['required'],
            'password' => ['required'],
        ]);
        if (Auth::attempt($credentials)) {
            if(auth::user()->rol != "encargada"){
                return array('success'=>true,'id'=>auth::user()->id);
            }
        }
        return json_encode(array('success'=>false));
    }

    public function logout(){
        Session::flush();
        Auth::logout();
        return array('success'=>true);
    }

    public function ingreso(){
        //A es el codigo que tiene el qr
        $datos = request()->all();
        if( !isset($datos['qr']) )
            return json_encode(array('success'=>false));
        if($datos['qr'] != 'A')
                return json_encode(array('success'=>false));
        return json_encode(array('success'=>true));
    }

    public function tareas($id){
        $habilitado=Turnos::where('borrado','no')->where('dia',date('l'))
        ->whereDate('hora_inicio','>=',Carbon::now())
        ->whereDate('hora_fin','<=',Carbon::now())->get();
        $hoy = date('Y-m-d');
        if(count($habilitado)==0)
            return [];
        $actividades = [];
        foreach($habilitado as $t){
            $tarea_list = TareasTurnos::where('turnos',$t->id)
            ->where('borrado','no')
            ->where('fecha_realizacion',$hoy)->get();
            foreach($tarea_list as $tarea){
                $actividades[] = $tarea;
            }
        }
        foreach($actividades as $a){
            $tarea = Tareas::find($a->tarea);
            if($tarea == null){
              $a['detalle_tarea'] = 'Sin Definir';   
            }
            $a['detalle_tarea'] = $tarea;
        }
        return $actividades;
    }

    public function tareadetalle(){
        $datos = request()->all();
        if(!isset($datos['id']) || !isset($datos['id_tarea']) )
            return json_encode(array('success'=>false));
        $tarea = TareasTurnos::find($datos['id_tarea']);
        $tarea_detalle=Tareas::find($tarea->tarea);
        $tarea['detalle_tarea'] = $tarea_detalle;
        return $tarea;
    }

    public function tareafinalizar(){
        $datos = request()->all();
        //dd($datos);
        if(!isset($datos['id']) || !isset($datos['id_tarea']) )
            return json_encode(array('success'=>false));
        $tarea = TareasTurnos::find($datos['id_tarea']);
        $turno = Turnos::find($tarea->id);
        if($turno->id_empleada != $datos['id']){
            $tarea->reemplazo = $datos['id'];
            //dd('reemplazo',$tarea);
        }

        //dd($tarea);
        $tarea->estado="terminado";
        $tarea->save();
        return json_encode(array('success'=>true));
    }

    public function notas($id){
        $datos = request()->all();
        $notas = Notas::where('id_empleada',$id)->where('borrado','no')->get();

        foreach($notas as $n){
            
            $fecha =Carbon::createFromFormat('Y-m-d',$n->fecha);
            $n->fecha = $fecha->format('d/m/Y');
        }

        return $notas;
    }

    public function notas_create(){
        $datos = request()->all();
        if($datos['tipo']=='urgente'){
            $destinatario = User::find(1);
            $emails =[$destinatario->email];
            $destinatario = $destinatario->email;
            Mail::send('template_email',['datos' => $datos ],
                  function($m) use ($datos,$emails,$destinatario){
                      $m->from($destinatario, 'Nota Urgente');
                      $m->to($emails)->subject('Mensaje del sistema');
                  }
            );
            $datos['estado'] = 'enviado';
        }
        $nota = Notas::create($datos);
        return json_encode(array('success'=>true)); 
        
    }

    public function notas_fin_dia(){
        $notas = Notas::where('tipo','normal')->where('estado','sinenviar')->get();
        foreach($notas as $n){
            $datos=[];
            $datos['titulo'] = $n->titulo;
            $datos['descripcion'] = $n->descripcion;
            $datos['fecha'] = $n->fecha;
            //21 hs
            $encargada  = User::find(1);
            $emails =[$encargada->email,];
            Mail::send('template_email',['datos' => $datos ],
                  function($m) use ($datos,$emails){
                      $m->from($encargada->email, 'Nota normal');
                      $m->to($emails)->subject('Mensaje del sistema');
                  }
            );
        }
        $n->estado ='enviado';
        $n->save();
    }

    public function notas_view($id){
        $notas = Notas::find($id); 
        return $notas;
    }

    public function notas_save($id){
        $datos = request()->all();
        $notas = Notas::find($id);
        $notas->fill($datos);
        $notas->save();
        return array('success'=>true);
    }

    public function notas_delete(){
        $datos = request()->all();
        $nota = Notas::find($datos['id']);
        $nota->borrado  = 'si';
        $nota->save();
        return array('success'=>true);    
    }



}
