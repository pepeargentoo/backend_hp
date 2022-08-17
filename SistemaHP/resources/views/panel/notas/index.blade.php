@extends('panel.layout') @section('content')
<div class="row">
 @if(session()->has('mensaje'))
 <div class="alert alert-warning" id="cartel">
  <span>{{session('mensaje')}}</span>
 </div>
 @endif
  <form method="POST" action="{{url('ppal/notas/coutome')}}">
  @csrf
  <div class="row">
   <div class="col-md-10 px-1">
    <div class="form-group">
     <label>Empleada</label>
     <select class="form-select form-control" aria-label="Default select example" name="id_empleada" required="">
      <option value="" disabled>Seleccione una empleada</option>
      @foreach($empleadas as $emp)
      <option value="{{$emp->id}}" @if(isset($id_empleada)) @if($id_empleada == $emp->id) selected="selected" @endif @endif >{{$emp->apellido}},{{$emp->nombre}}</option>
      @endforeach
     </select>
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
  $("#example").DataTable({
    "language": {
      "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
    }
  });
 });
</script>
@endsection
