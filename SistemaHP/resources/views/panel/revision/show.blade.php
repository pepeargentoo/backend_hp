@extends('panel.layout') @section('content')
<div class="content">
 <div class="container-fluid">
  <div class="row">
   <div class="col-md-11">
    <div class="card" style="padding: 20px;">
     <div class="card-header">
      <h4 class="card-title">Datos Revision</h4>
     </div>
     @if(session()->has('mensaje'))
     <div class="alert alert-warning" id="cartel">
      <span>{{session('mensaje')}}</span>
     </div>
     @endif
     <div class="card-body">
      <form method="POST">
       <div class="row">
        <div class="col-md-6 px-1">
         <div class="form-group">
          <label>Tarea</label>
          <input type="text" class="form-control" placeholder="Nombre"  value="{{$tarea_detalle->tareanombre}}"  readonly />
         </div>
        </div>
        <div class="col-md-6 px-1">
         <div class="form-group">
          <label>Empleada</label>
          <input type="text" class="form-control" placeholder="Nombre"  value="{{$tarea_detalle->empleada}}"  readonly />
         </div>
        </div>
       </div>
       <div class="row">
        <div class="col-md-6 pr-1">
         <div class="form-group">
          <label>Estado</label>
          <input type="text" class="form-control" value="{{$tarea_detalle->estado}}" readonly />
         </div>
        </div>
        <div class="col-md-6 pr-1">
         <div class="form-group">
          <label>Fecha</label>
          <input type="date" class="form-control" value="{{$tarea_detalle->fecha_realizacion}}" readonly/>
         </div>
        </div>
       </div>
       <br clear="all" />
       

       <a href="{{url('ppal/revision')}}" class="btn btn-fill btn-rose ripple-container" style="float: right;">Atras</a>
       <div class="clearfix"></div>
      </form>
     </div>
    </div>
   </div>
  </div>
 </div>
</div>
@endsection
