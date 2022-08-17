@extends('panel.layout') @section('content')
<div class="row">
 @if(session()->has('mensaje'))
 <div class="alert alert-warning" id="cartel">
  <span>{{session('mensaje')}}</span>
 </div>
 @endif
 <form method="POST" action="{{url('ppal/revision_coutomer')}}">
  @csrf
  <div class="row">
   <div class="col-md-10 px-1">
    <div class="form-group">
     <label>FECHA</label>
     <input type="date" class="form-control" placeholder="Nombre" name="date" @if(isset($fecha)) value="{{$fecha}}" @else required="" @endif />
    </div>
   </div>
   <div class="col-md-2">
    <input type="submit" name="" value="Buscar" class="btn btn-fill btn-rose ripple-container" style="width: 100%; margin-top: 26px; float: right; margin-bottom: 21px;" />
   </div>
  </div>
 </form>
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
  $("#example").DataTable({
    "language": {
      "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
    }
  });
 });
</script>
@endsection
