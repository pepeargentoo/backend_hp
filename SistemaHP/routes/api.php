<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

Route::post('/ingreso',[ApiController::class,'ingreso']);

Route::post('/login',[ApiController::class,'login']);
Route::post('/salir',[ApiController::class,'logout']);

Route::get('/tareas/{id}',[ApiController::class,'tareas']);
Route::post('/tareadetalle',[ApiController::class,'tareadetalle']);
Route::post('/finalizartarea',[ApiController::class,'tareafinalizar']);

Route::get('/notas/{id}',[ApiController::class,'notas']);
Route::post('/notas',[ApiController::class,'notas_create']);
Route::get('/nota/detalle/{id}',[ApiController::class,'notas_view']);
Route::post('/nota/detalle/{id}',[ApiController::class,'notas_save']);
Route::post('/nota/borrar',[ApiController::class,'notas_delete']);
Route::get('/nota/fin',[ApiController::class,'notas_fin_dia']);