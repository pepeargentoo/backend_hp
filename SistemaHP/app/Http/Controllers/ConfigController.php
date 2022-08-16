<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Session;
date_default_timezone_set('America/Argentina/Buenos_Aires');
class ConfigController extends Controller
{
    
    public function index(){
        return view('panel.config.index');
    }
    public function save(){
        $datos = request()->all();
        if($datos['email'] == null)
            unset($datos['email']);
        if($datos['usuario'] == null)
            unset($datos['usuario']);
        if($datos['password'] ==  null){
            unset($datos['password']);
        }else{
            $datos['password'] = bcrypt($datos['password']);
        }
        //1 es porque creamos con un seed a este usuario
        $encargada = User::find(1);
        $encargada->fill($datos);
        $encargada->save();
        Session::flash('mensaje','La config fue actualizada con éxito');
        return redirect()->to('ppal/config');
    }

    public function qr_access(){
        return response()->download('qr.jpg');
    }
}
