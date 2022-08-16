@extends('panel.layout') @section('content')
<div class="row">
 @if(session()->has('mensaje'))
 <div class="alert alert-warning" id="cartel">
  <span>{{session('mensaje')}}</span>
 </div>
 @endif
  <table id="example" class="display">
  <thead>
   <tr>
    <th>Fecha</th>
     <th>Tarea</th>
    <th>Empleada</th>
    <th>Estado</th>
    <th>Acciones</th>
   </tr>
  </thead>
  <tbody>
   @foreach ($turnos_t as $t)
   <tr>
    <td>{{$t->fecha_realizacion}}</td>
    <td>{{$t->tareanombre}}</td>
    <td>{{$t->empleada}}</td>
    <td>{{$t->estado}}</td>
    <td>
     <a href="{{url('/ppal/revision/ver',[$t->id])}}">
      <i class="pe-7s-search" style="color: black; font-size: 18px;"></i>
     </a>
    </td>
   </tr>
   @endforeach
  </tbody>
  <tfoot>
   <tr>
    <th>Fecha</th>
    <th>Tarea</th>
    <th>Empleada</th>
    <th>Estado</th>
    <th>Acciones</th>
   </tr>
  </tfoot>
 </table>
</div>
<script>
 $(document).ready(function () {
  $("#example").DataTable();
 });
</script>
@endsection
