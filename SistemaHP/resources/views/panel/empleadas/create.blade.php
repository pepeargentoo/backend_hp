@extends('panel.layout') @section('content')
<div class="content">
 <div class="container-fluid">
  <div class="row">
   <div class="col-md-11">
    <div class="card" style="padding: 20px;">
     <div class="card-header">
      <h4 class="card-title">Datos Empleadas</h4>
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
          <input type="text" class="form-control" placeholder="Nombre" name="nombre" 
          @if(isset($empleada))
            value="{{$empleada->nombre}}"
          @else
          required 
          @endif
          />
         </div>
        </div>
        <div class="col-md-6 px-1">
         <div class="form-group">
          <label>Apellido</label>
          <input type="text" class="form-control" placeholder="Apellido" name="apellido"
          @if(isset($empleada))
            value="{{$empleada->apellido}}"
          @else
          required 
          @endif
          
          />
         </div>
        </div>
       </div>
       <div class="row">
        <div class="col-md-6 pr-1">
         <div class="form-group">
          <label>DNI</label>
          <input type="number" class="form-control" placeholder="DNI" name="dni" 
          @if(isset($empleada))
            value="{{$empleada->dni}}"
          @else
          required 
          @endif />
         </div>
        </div>
        <div class="col-md-6 pl-1">
         <div class="form-group">
          <label>Teléfono</label>
          <input type="text" class="form-control" placeholder="Teléfono" name="telefono" 
          @if(isset($empleada))
            value="{{$empleada->telefono}}"
          @else
          required 
          @endif />
         </div>
        </div>
       </div>
       <div class="row">
        <div class="col-md-12">
         <div class="form-group">
          <label>Email</label>
          <input type="email" class="form-control" placeholder="Email" name="email"
          @if(isset($empleada))
            value="{{$empleada->email}}"
          @else
          required 
          @endif
          
            />
         </div>
        </div>
       </div>
       <div class="row">
        <div class="col-md-6 pr-1">
         <div class="form-group">
          <label>Usuario</label>
          <input type="text" class="form-control" placeholder="Usuario" name="usuario" 
          @if(isset($empleada))
            value="{{$empleada->usuario}}"
          @else
          required 
          @endif
           />
         </div>
        </div>
        <div class="col-md-6 px-1">
         <div class="form-group">
          <label>Password</label>
          <input type="password" class="form-control" placeholder="****" name="password"  
          @if(!isset($empleada))
          required 
          @endif
         />
         </div>
        </div>
       </div>
       <button type="submit" class="btn btn-fill btn-rose ripple-container" style="float: right;">Guardar</button>
       <a href="{{url('ppal/empleadas')}}" class="btn btn-fill btn-rose ripple-container" style="float: right;">Atras</a>
       <div class="clearfix"></div>
      </form>
     </div>
    </div>
   </div>
  </div>
 </div>
</div>
@endsection
