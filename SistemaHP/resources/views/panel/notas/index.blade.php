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
    <th>Empleada</th>
    <th>Tipo</th>
    <th>Descripcion</th>
    <th>Acciones</th>
   </tr>
  </thead>
  <tbody>
   @foreach ($notas as $t)

   <tr @if($t->tipo=="urgente") style="background: pink;"@endif>
    <td>{{$t->fecha}}</td>
    <td>{{$t->empleada}}</td>
    <td>{{$t->tipo}}</td>
    <td>{{$t->descripcion}}</td>
    <td>
     <a href="{{url('ppal/notas',[$t->id])}}">
      <i class="pe-7s-search" style="color: black; font-size: 18px;"></i>
     </a>
    </td>
   </tr>
   @endforeach
  </tbody>
  <tfoot>
   <tr>
    <th>Fecha</th>
    <th>Empleada</th>
    <th>Tipo</th>
    <th>Descripcion</th>
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
