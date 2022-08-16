@extends('panel.layout') @section('content')
<div class="row">
 <div class="col-md-4">
  <div class="card">
   <div class="header">
    <h4 class="title">Empleadas</h4>
    <p class="category">Gestión de empleadas</p>
   </div>
   <div class="content">
    <div class="footer">
     <hr />
     <div class="stats">
      <a href="{{url('ppal/empleadas')}}"> <i class="fa fa-circle text-info"></i>VER </a>
     </div>
    </div>
   </div>
  </div>
 </div>
 <div class="col-md-4">
  <div class="card">
   <div class="header">
    <h4 class="title">Tareas</h4>
    <p class="category">Gestión de Tareas</p>
   </div>
   <div class="content">
    <div class="footer">
     <hr />
     <div class="stats">
      <a href="{{url('ppal/tareas')}}"> <i class="fa fa-circle text-info"></i>VER </a>
     </div>
    </div>
   </div>
  </div>
 </div>
 <div class="col-md-4">
  <div class="card">
   <div class="header">
    <h4 class="title">Revisión</h4>
    <p class="category">Gestión de revisión</p>
   </div>
   <div class="content">
    <div class="footer">
     <hr />
     <div class="stats">
      <a href="{{url('ppal/revision')}}"> <i class="fa fa-circle text-info"></i>VER </a>
     </div>
    </div>
   </div>
  </div>
 </div>
 <div class="col-md-4">
  <div class="card">
   <div class="header">
    <h4 class="title">Distribución</h4>
    <p class="category">Distribución de Horarios</p>
   </div>
   <div class="content">
    <div class="footer">
     <hr />
     <div class="stats">
      <a href="{{url('ppal/distribucion')}}"> <i class="fa fa-circle text-info"></i>VER </a>
     </div>
    </div>
   </div>
  </div>
 </div>
 <div class="col-md-4">
  <div class="card">
   <div class="header">
    <h4 class="title">QR</h4>
    <p class="category">Generador de QR</p>
   </div>
   <div class="content">
    <div class="footer">
     <hr />
     <div class="stats">
      <a href="{{url('ppal/qr')}}"> <i class="fa fa-circle text-info"></i>VER </a>
     </div>
    </div>
   </div>
  </div>
 </div>
 <div class="col-md-4">
  <div class="card">
   <div class="header">
    <h4 class="title">Notas de Empleadas</h4>
    <p class="category">Gestión notas</p>
   </div>
   <div class="content">
    <div class="footer">
     <hr />
     <div class="stats">
      <a href="{{url('ppal/notas')}}"> <i class="fa fa-circle text-info"></i>VER </a>
     </div>
    </div>
   </div>
  </div>
 </div>
 <div class="col-md-4">
  <div class="card">
   <div class="header">
    <h4 class="title">Informes</h4>
    <p class="category">Gestión de Informes</p>
   </div>
   <div class="content">
    <div class="footer">
     <hr />
     <div class="stats">
      <a href="{{url('ppal/informe')}}"> <i class="fa fa-circle text-info"></i>VER </a>
     </div>
    </div>
   </div>
  </div>
 </div>
</div>
@endsection