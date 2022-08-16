<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tareas;
use App\Frecuencia;
use App\TareasTurnos;
use App\Turnos;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
date_default_timezone_set('America/Argentina/Buenos_Aires');

class TareasController extends Controller
{
    public function index()
    {
        $tareas = Tareas::where('borrado','no')->get();
        return view('panel.tareas.index', compact('tareas'));
    }

    public function index_create()
    {
        $frecuencias = Frecuencia::where('borrado','no')->get();
        return view('panel.tareas.create', compact('frecuencias'));
    }

    public function create()
    {
        $datos = request()->all();
        $valido = $this->validate_disponiblidad($datos);
        if ($valido['status'] == 'faild')
        {
            Session::flash('mensaje', $valido['mensaje']);
            return redirect()->to($valido['url']);
        }
        $tarea = Tareas::create($datos);
        $this->create_tareas_turnos($datos,$tarea->id);
        return redirect()->to('ppal/tareas');
    }

    private function create_tareas_turnos($datos,$tarea_id){
        $frecuencia = Frecuencia::find($datos['frecuencia']);
        $ndias = $frecuencia->n_dias;
        $fecha_inf = $datos['fecha_inicio'];
        $fecha_sup = $datos['fecha_fin'];
        $fecha_fin = Carbon::createFromFormat('Y-m-d', $fecha_sup);
        $fecha_ini = Carbon::createFromFormat('Y-m-d', $fecha_inf);
        $diff = $fecha_fin->diffInDays($fecha_ini);
        for ($i = 0;$i <= $diff;$i += $ndias)
        {
            $turnos_id = $this->get_turns($fecha_ini, $datos['hora_inicio']);
            if ($turnos_id == - 1)
            {
                TareasTurnos::create(array(
                    'turnos' => null,
                    'tarea' => $tarea_id,
                    'dia' => $fecha_ini->format('l') ,
                    'estado' => 'pendiente',
                    'fecha_realizacion' => $fecha_ini
                ));
            }
            else
            {
                $t = TareasTurnos::create(array(
                    'turnos' => $turnos_id,
                    'tarea' => $tarea_id,
                    'dia' => $fecha_ini->format('l') ,
                    'estado' => 'pendiente',
                    'fecha_realizacion' => $fecha_ini
                ));
            }
            $fecha_ini = $fecha_ini->addDays($ndias);
        }
    }

    private function validate_disponiblidad($datos)
    {
        $estado = array(
            'status' => 'success'
        );
        $fecha_inf = $datos['fecha_inicio'];
        $fecha_sup = $datos['fecha_fin'];
        if ($fecha_inf < date('Y-m-d') || $fecha_sup < date('Y-m-d'))
        {
            $estado = array(
                'status' => 'faild',
                'mensaje' => 'No se pueden crear tarean anteriores a la fecha diaria',
                'url' => 'ppal/tareas'
            );
        }

        if ($fecha_inf > $fecha_sup)
        {
            $estado = array(
                'status' => 'faild',
                'mensaje' => 'El fecha de inicio es mayor a la fecha fin',
                'url' => 'ppal/tareas'
            );
        }
        return $estado;
    }

    public function edit($id)
    {
        $frecuencias = Frecuencia::where('borrado','no')->get();
        $tarea = Tareas::find($id);
        if ($tarea == null)
        {
            Session::flash('mensaje', 'La tarea no existe');
            return redirect()->to('ppal/tareas');
        }
        return view('panel.tareas.create', compact('frecuencias', 'tarea'));
    }

    public function save($id)
    {
        $tarea = Tareas::find($id);
        $datos = request()->all();
        if ($tarea == null)
        {
            Session::flash('mensaje', 'La tarea no existe');
            return redirect()->to('ppal/tareas');
        }
        if( ($tarea->frecuencia != $datos['frecuencia']) || 
            ($tarea->hora_inicio != $datos['hora_inicio']) || 
            ($tarea->fecha_fin != $datos['fecha_fin']) ) {
            $tarea_list = TareasTurnos::where('tarea',$id)
            ->where('fecha_realizacion','>',date('Y-m-d'))->delete();
            $valido = $this->validate_disponiblidad($datos);
            if ($valido['status'] == 'faild'){
                Session::flash('mensaje', $valido['mensaje']);
                return redirect()->to($valido['url']);
            }
            $this->create_tareas_turnos($datos,$tarea->id);
        }

        $tarea->fill($datos);
        $tarea->save();
        Session::flash('mensaje', 'La tarea fue actualizada con exito');
        return redirect()->to('ppal/tareas');
    }

    public function delete($id)
    {
        $tarea = Tareas::find($id);
        if ($tarea == null) 
            return array('status' => 'faild');

        $subtareas = TareasTurnos::where('tarea', $id)->update(['borrado'=>'si']);
        $tarea->borrado  = 'si';
        $tarea->save();
        return array(
            'status' => 'success'
        );

    }

    private function get_turns($fecha, $hora)
    {
        $turnos_id = [];
        $turnos = Turnos::where('dia', $fecha->format('l'))
            ->get();
        if (count($turnos) == 0)
        {
            return -1;
        }
        $id = 0;
        foreach ($turnos as $t)
        {
            if ($hora >= $t->hora_inicio && $t->fin <= $hora)
            {
                $id = $t->id;
                break;
            }
        }
        return $id;
    }
}

