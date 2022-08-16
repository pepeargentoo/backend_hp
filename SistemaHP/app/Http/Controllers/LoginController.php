<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
date_default_timezone_set('America/Argentina/Buenos_Aires');
class LoginController extends Controller
{
    public function index(){
        return view('welcome');
    }
    public function login(request $request){
        $datos = request()->all();
        $credentials = $request->validate([
            'usuario' => ['required'],
            'password' => ['required'],
            'rol'=>'encargada'
        ]);
        if (Auth::attempt($credentials)) {
            if(auth::user()->rol != "encargada"){
                Session::flash('mensaje','usuario o contraseña erroneos');
                return redirect()->to('/');
            }
            return redirect()->to('ppal');
        }
        Session::flash('mensaje','usuario o contraseña erroneos');
        return redirect()->to('/');
    }
    public function logout(){
        Session::flush();
        Auth::logout();
        return redirect('/');
    }
}
