@extends('panel.layout') @section('content')
<div class="content">
 <div class="container-fluid">
  <div class="row">
   <div class="col-md-11">
    <div class="card" style="padding: 20px;">
     <div class="card-header">
      <h4 class="card-title">Datos de Distribución</h4>
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
        <div class="col-md-6 px-1">
         <div class="form-group">
          <label>Empleada</label>
          <select class="form-select form-control" aria-label="Default select example" name="id_empleada" required="">
           <option value="" disabled>Seleccione una empleada</option>
           @foreach($empleadas as $emp)
           <option value="{{$emp->id}}" 
               @if(isset($turno))
               @if($turno->id_empleada == $emp->id)
               selected="selected"
               @endif
               @endif
               >{{$emp->apellido}},{{$emp->nombre}}</option>
           @endforeach
          </select>
         </div>
        </div>
        <div class="col-md-6 px-1">
         <div class="form-group">
          <label>Dia</label>
          
          <select class="form-select form-control" aria-label="Default select example" name="dia" required="">
           <option value="" disabled>Seleccione día</option>
           @foreach($week as $k=>$v)
               <option value="{{$k}}" 
               @if(isset($turno))
               @if($turno->dia == $k)
                    selected="selected"
               @endif
                @endif>{{$v}}</option>    
           @endforeach
          </select>
         </div>
        </div>
       </div>
       <div class="row">
        <div class="col-md-6 pr-1">
         <div class="form-group">
          <label>Hora Inicio</label>
          <input type="time" class="form-control" placeholder="Hora Inicio" name="hora_inicio" @if(isset($turno)) value="{{$turno->hora_inicio}}" @else required="" @endif />
         </div>
        </div>
        <div class="col-md-6 pr-1">
         <div class="form-group">
          <label>Hora Fin</label>
          <input type="time" class="form-control" placeholder="Hora Fin" name="hora_fin" @if(isset($turno)) value="{{$turno->hora_fin}}" @else required="" @endif />
         </div>
        </div>
      </div>

       <button type="submit" class="btn btn-fill btn-rose ripple-container" style="float: right;">Guardar</button>
       <a href="{{url('ppal/distribucion')}}" class="btn btn-fill btn-rose ripple-container" style="float: right;">Atras</a>
       <div class="clearfix"></div>
      </form>
     </div>
    </div>
   </div>
  </div>
 </div>
</div>
@endsection
