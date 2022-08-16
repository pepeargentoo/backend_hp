@extends('panel.layout') @section('content')
<div class="row">
 <div class="col-md-11">
  <div class="card" style="padding: 20px;">
   <div class="card-header">
    <h4 class="card-title">Datos Encargada</h4>
     @if(session()->has('mensaje'))
          <div class="alert alert-warning" id="cartel">
           <span>{{session('mensaje')}}</span>
          </div>
    @endif
   </div>
   <div class="card-body">
    <form method="POST">
      @csrf
     <div class="row">
      <div class="col-md-12">
       <div class="form-group">
        <label>Email</label>
        <input type="email" class="form-control" placeholder="Email" name="email" />
       </div>
      </div>
     </div>
     <div class="row">
      <div class="col-md-6 pr-1">
       <div class="form-group">
        <label>Usuario</label>
        <input type="text" class="form-control" placeholder="Usuario" name="usuario" />
       </div>
      </div>
      <div class="col-md-6 px-1">
       <div class="form-group">
        <label>Password</label>
        <input type="password" class="form-control" placeholder="****" name="password" />
       </div>
      </div>
     </div>
     <button type="submit" class="btn btn-fill btn-rose ripple-container" style="float: right;">Guardar</button>
     <a href="{{url('/ppal')}}" class="btn btn-fill btn-rose ripple-container" style="float: right;">Atras</a>
     <div class="clearfix"></div>
    </form>
   </div>
  </div>
 </div>
</div>
@endsection