<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Session;
date_default_timezone_set('America/Argentina/Buenos_Aires');
class EmpleadaController extends Controller
{
    public function index(){
        $empleadas= User::where('rol','<>','encargada')->where('borrado','no')->get();
        return view('panel.empleadas.index',compact('empleadas'));
    }

    public function index_create(){
        return view('panel.empleadas.create');
    }

    public function create(){
        $datos= request()->all();
        $existe = User::where('usuario',$datos['usuario'])->count();
        if($existe != 0){
            Session::flash('mensaje','El nombre de usuario ya existe');
            return redirect()->to('ppal/empleadas/nuevo');
        }
        $datos['rol'] = 'empleada';
        $datos['password'] = bcrypt($datos['password']);
        $empleada = User::create($datos);
        Session::flash('mensaje','La empleada fue creada con éxito');
        return redirect()->to('ppal/empleadas');
    }

    public function edit($id){
        $empleada = User::find($id);
        if($empleada == null){
            Session::flash('mensaje','El empleado no existe');
            return redirect()->to('ppal/empleadas');
        }
        return view('panel.empleadas.create',compact('empleada'));
    }

    public function save($id){
        $datos = request()->all();
        $existe = User::where('usuario',$datos['usuario'])->where('id','<>',$id)->count();
        if($existe != 0){
            Session::flash('mensaje','El nombre de usuario ya existe');
            $url='ppal/empleadas/editar/'.$id;
            return redirect()->to($url); 
        }
        $empleada_update = User::find($id);
        if($datos['password']!=null){
            $datos['password']=bcrypt($datos['password']);
        }else{
            $datos['password']=$empleada_update['password'];
        }
        $empleada_update->fill($datos);
        $empleada_update->save();
        Session::flash('mensaje','La empleada fue actualizada con éxito');
        return redirect()->to('ppal/empleadas');        
    }

    public function delete($id){
        $existe = User::find($id);
        if($existe==null){
            return array('status'=>'faild','mensaje'=>'no existe el usuario');
        }
        User::where('id',$id)->update(['borrado'=>'si']);
        return array('status'=>'success','mensaje'=>'ok');
    }


   
}
