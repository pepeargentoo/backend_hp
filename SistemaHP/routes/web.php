<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PanelController;
use App\Http\Controllers\EmpleadaController;
use App\Http\Controllers\TareasController;
use App\Http\Controllers\FrecuenciaController;
use App\Http\Controllers\DistribucionController;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\NotasController;
use App\Http\Controllers\RevisionController;
use App\Http\Controllers\InformeController;

Route::get('/', [LoginController::class,'index']);
Route::post('/',[LoginController::class,'login']);
Route::get('/ppal',[PanelController::class,'index']);
Route::get('/ppal/empleadas',[EmpleadaController::class,'index']);
Route::get('/ppal/empleadas/nuevo',[EmpleadaController::class,'index_create']);
Route::post('/ppal/empleadas/nuevo',[EmpleadaController::class,'create']);
Route::get('/ppal/empleadas/editar/{id}',[EmpleadaController::class,'edit']);
Route::post('/ppal/empleadas/editar/{id}',[EmpleadaController::class,'save']);
Route::get('/ppal/empleadas/borrar/{id}',[EmpleadaController::class,'delete']);

//ACA COMIENZA LO QUE HAY QUE CAMBIAR
Route::get('/ppal/frecuencias',[FrecuenciaController::class,'index']);
Route::get('/ppal/frecuencias/nuevo',[FrecuenciaController::class,'index_create']);
Route::post('/ppal/frecuencias/nuevo',[FrecuenciaController::class,'create']);
Route::get('/ppal/frecuencias/editar/{id}',[FrecuenciaController::class,'edit']);
Route::post('/ppal/frecuencias/editar/{id}',[FrecuenciaController::class,'save']);
Route::get('/ppal/frecuencias/borrar/{id}',[FrecuenciaController::class,'delete']);
Route::get('/ppal/tareas',[TareasController::class,'index']);
Route::get('/ppal/tareas/nuevo',[TareasController::class,'index_create']);
Route::post('/ppal/tareas/nuevo',[TareasController::class,'create']);
Route::get('/ppal/tareas/borrar/{id}',[TareasController::class,'delete']);
Route::get('/ppal/tareas/editar/{id}',[TareasController::class,'edit']);
Route::post('/ppal/tareas/editar/{id}',[TareasController::class,'save']);
//FIN DE LO QUE CAMBIAR

Route::get('/ppal/distribucion',[DistribucionController::class,'index']);
Route::get('/ppal/distribucion/nuevo',[DistribucionController::class,'index_create']);
Route::post('/ppal/distribucion/nuevo',[DistribucionController::class,'create']);
Route::get('/ppal/distribucion/borrar/{id}',[DistribucionController::class,'delete']);
Route::get('/ppal/distribucion/editar/{id}',[DistribucionController::class,'edit']);
Route::post('/ppal/distribucion/editar/{id}',[DistribucionController::class,'save']);

Route::get('/ppal/notas',[NotasController::class,'index']);
Route::get('/ppal/notas/{id}',[NotasController::class,'show']);

Route::get('/ppal/config',[ConfigController::class,'index']);
Route::post('/ppal/config',[ConfigController::class,'save']);
Route::get('/ppal/qr',[ConfigController::class,'qr_access']);
Route::get('/ppal/revision',[RevisionController::class,'index']);
Route::get('/ppal/revision/ver/{id}',[RevisionController::class,'show']);
Route::get('/ppal/informe',[InformeController::class,'index']);
Route::get('salir',[LoginController::class,'logout']);

Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    return '<h1>Cache facade value cleared</h1>';
});
Route::get('/optimize', function() {
    $exitCode = Artisan::call('optimize');
    return '<h1>Reoptimized class loader</h1>';
});
Route::get('/view-clear', function() {
    $exitCode = Artisan::call('view:clear');
    return '<h1>View cache cleared</h1>';
});
Route::get('/config-cache', function() {
    $exitCode = Artisan::call('config:cache');
    return '<h1>Clear Config cleared</h1>';
});