@extends('panel.layout') @section('content')
<div class="content">
 <div class="container-fluid">
  <div class="row">
   <div class="col-md-11">
    <div class="card" style="padding: 20px;">
     <div class="card-header">
      <h4 class="card-title">Datos Frecuencia</h4>
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
          <label>Nombre</label>
          <input type="text" class="form-control" placeholder="Nombre" name="descripcion" 
          @if(isset($frecuencia))
            value="{{$frecuencia->descripcion}}"
          @else
          required 
          @endif
          />
         </div>
        </div>
        <div class="col-md-6 px-1">
         <div class="form-group">
          <label>N° Dias:</label>
          <input type="number" class="form-control" placeholder="N° Dias" name="n_dias"
          @if(isset($frecuencia))
            value="{{$frecuencia->n_dias}}"
          @else
          required 
          @endif
          
          />
         </div>
        </div>
       </div>
       <button type="submit" class="btn btn-fill btn-rose ripple-container" style="float: right;">Guardar</button>
       <a href="{{url('ppal/frecuencias')}}" class="btn btn-fill btn-rose ripple-container" style="float: right;">Atras</a>
       <div class="clearfix"></div>
      </form>
     </div>
    </div>
   </div>
  </div>
 </div>
</div>
@endsection
