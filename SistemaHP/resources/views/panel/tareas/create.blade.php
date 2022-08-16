@extends('panel.layout') @section('content')
<div class="content">
 <div class="container-fluid">
  <div class="row">
   <div class="col-md-11">
    <div class="card" style="padding: 20px;">
     <div class="card-header">
      <h4 class="card-title">Datos Tarea</h4>
     </div>
     @if(session()->has('mensaje'))
     <div class="alert alert-warning" id="cartel">
      <span>{{session('mensaje')}}</span>
     </div>
     @endif
     <div class="card-body">
      <form method="POST">
       @csrf
       <div class="row">
        <div class="col-md-12 px-1">
         <div class="form-group">
          <label>Nombre</label>
          <input type="text" class="form-control" placeholder="Nombre" name="nombre" @if(isset($tarea)) value="{{$tarea->nombre}}" @else required="" @endif />
         </div>
        </div>
       </div>
       <div class="row">
        <div class="col-md-6 pr-1">
         <div class="form-group">
          <label>Hora Inicio</label>
          <input type="time" class="form-control" placeholder="Hora Inicio" name="hora_inicio" @if(isset($tarea)) value="{{$tarea->hora_inicio}}" @else required="" @endif />
         </div>
        </div>
        <div class="col-md-6 pl-1">
         <div class="form-group">
          <label>Frecuencia</label>
          <select class="form-select form-control" aria-label="Default select example" name="frecuencia" required="">
           <option value="" disabled>Seleccione tipo de frecuencia</option>
           @foreach($frecuencias as $f)
           <option value="{{$f->id}}"
            @if(isset($tarea))
                @if($tarea->frecuencia == $f->id) 
                    selected="selected" 
                @endif 
            @endif
            >{{$f->descripcion}}</option>
           @endforeach
          </select>
         </div>
        </div>
       </div>
       <br clear="all" />
       <div class="row">
        <div class="col-md-6 pr-1">
         <div class="form-group">
          <label>Fecha Inicio</label>
          <input type="date" class="form-control" placeholder="fecha inicio" name="fecha_inicio" @if(isset($tarea)) value="{{$tarea->fecha_inicio}}" @else required="" @endif />
         </div>
        </div>
        <div class="col-md-6 pr-1">
         <div class="form-group">
          <label>Fecha Fin</label>
          <input type="date" class="form-control" placeholder="Fecha Fin" name="fecha_fin" @if(isset($tarea)) value="{{$tarea->fecha_fin}}" @else required="" @endif />
         </div>
        </div>
       </div>
       <div class="row">
        <div class="col-md-12 px-1">
         <div class="form-group">
          <label>Descripción</label>
          <textarea class="form-control" name="descripcion" required="">@if(isset($tarea)){{$tarea->descripcion}}@endif</textarea>
         </div>
        </div>
       </div>

       <button type="submit" class="btn btn-fill btn-rose ripple-container" style="float: right;">Guardar</button>
       <a href="{{url('ppal/tareas')}}" class="btn btn-fill btn-rose ripple-container" style="float: right;">Atras</a>
       <div class="clearfix"></div>
      </form>
     </div>
    </div>
   </div>
  </div>
 </div>
</div>
@endsection
