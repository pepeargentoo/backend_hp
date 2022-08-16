<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
date_default_timezone_set('America/Argentina/Buenos_Aires');
class PanelController extends Controller
{
    //
    public function index(){
        return view('panel.index');
    }
}
