@extends('panel.layout') @section('content')
<div class="content">
 <div class="container-fluid">
  <div class="row">
   <div class="col-md-11">
    <div class="card" style="padding: 20px;">
     <div class="card-header">
      <h4 class="card-title">Nota Detalle</h4>
     </div>
     <div class="card-body">
      <form method="POST">
       <div class="row">
        <div class="col-md-12 px-1">
          <label>Empleada</label>
          <input type="text" class="form-control" placeholder="Nombre"  value="{{$nota->empleada}}"  readonly />  
        </div>
       </div>
       <div class="row">
        <div class="col-md-6 px-1">
         <div class="form-group">
          <label>Tarea</label>
          <input type="text" class="form-control" placeholder="Nombre"  value="{{$nota->titulo}}"  readonly />
         </div>
        </div>
        <div class="col-md-6 px-1">
         <div class="form-group">
          <label>Tipo</label>
          <input type="text" class="form-control" placeholder="Nombre"  value="{{$nota->tipo}}"  readonly />
         </div>
        </div>
       </div>
       <div class="row">
        
        <div class="col-md-6 pr-1">
         <div class="form-group">
          <label>Fecha</label>
          <input type="date" class="form-control" value="{{$nota->fecha}}" readonly/>
         </div>
        </div>
        <div class="col-md-6 pr-1">
         <div class="form-group">
          <label>Hora</label>
          <input type="text" class="form-control" value="{{$nota->hora}}" readonly />
         </div>
        </div>
       </div>
       <br clear="all" />
       

       <a href="{{url('ppal/notas')}}" class="btn btn-fill btn-rose ripple-container" style="float: right;">Atras</a>
       <div class="clearfix"></div>
      </form>
     </div>
    </div>
   </div>
  </div>
 </div>
</div>
@endsection
