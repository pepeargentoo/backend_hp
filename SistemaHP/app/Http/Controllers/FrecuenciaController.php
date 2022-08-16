<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Frecuencia;
use Illuminate\Support\Facades\Session;
class FrecuenciaController extends Controller
{
    public function index(){
        $frecuencias=Frecuencia::where('borrado','no')->get();
        return view('panel.frecuencias.index',compact('frecuencias'));
    }

    public function index_create(){
        return view('panel.frecuencias.create'); 
    }

    public function create(){
        $datos= request()->all();
        $existe = Frecuencia::where('descripcion',$datos['descripcion'])->count();
        if($existe != 0){
            Session::flash('mensaje','El nombre de frecuencias ya existe');
            return redirect()->to('ppal/frecuencias/nuevo');
        }

        Frecuencia::create($datos);
        Session::flash('mensaje','fue creada con éxito');
        return redirect()->to('ppal/frecuencias');
    }

    public function delete($id){
        $existe = Frecuencia::find($id);
        if($existe==null){
            return array('status'=>'faild','mensaje'=>'no existe la frecuencia');
        }
        frecuencia::where('id',$id)->update(['borrado'=>'si']);
        return array('status'=>'success','mensaje'=>'ok');
    }



    public function edit($id){
        $frecuencia=Frecuencia::find($id);
        if($frecuencia== null){
            Session::flash('mensaje','La frecuencia no existe');
            return redirect()->to('ppal/frecuencias');   
        }
        return view('panel.frecuencias.create',compact('frecuencia'));
    }

    public function save($id){
        $frecuencia=Frecuencia::find($id);
        $datos= request()->all();
        $existe = Frecuencia::where('descripcion',$datos['descripcion'])->where('id','<>',$id)->count();
        if($existe != 0){
            Session::flash('mensaje','El nombre de frecuencias ya existe');
            return redirect()->to('ppal/frecuencias/nuevo');
        }
        $frecuencia->fill($datos);
        $frecuencia->save();
        Session::flash('mensaje','La frecuencia se actualizo con éxito');
        return redirect()->to('ppal/frecuencias');
    }
}
