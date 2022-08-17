@extends('panel.layout') @section('content')

<div class="row">
 @if(session()->has('mensaje'))
 <div class="alert alert-warning" id="cartel">
  <span>{{session('mensaje')}}</span>
 </div>
 @endif
 <form method="POST" action="{{url('ppal/distribucion/coutome')}}">
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

 <a href="{{url('ppal/distribucion/nuevo')}}" class="btn btn-fill btn-rose ripple-container" style="float: right; margin-bottom: 10px;">Nuevo</a>
 <table id="example" class="display">
  <thead>
   <tr>
    <th>Empleada</th>
    <th>Dia</th>
    <th>Horario</th>
    <th>Acciones</th>
   </tr>
  </thead>
  <tbody>
   @foreach ($turnos as $t)
   <tr>
    <td>{{$t->empleada}}</td>
    <td>{{$t->dia}}</td>
    <td>
     <span style="font-weight: bold;">Hora Inicio: </span>{{$t->hora_inicio}}<br />
     <span style="font-weight: bold;">Hora Fin: </span>{{$t->hora_fin}}
    </td>
    <td>
     <a href="{{url('ppal/distribucion/editar',[$t->id])}}">
      <i class="pe-7s-pen" style="color: black; font-size: 18px;"></i>
     </a>
     <a href="" class="borrarempledas" data-id="{{$t->id}}">
      <i class="pe-7s-trash" style="color: black; font-size: 18px;"></i>
     </a>
    </td>
   </tr>
   @endforeach
  </tbody>
  <tfoot>
   <tr>
    <th>Nombre</th>
    <th>Email</th>
    <th>Tel</th>
    <th>Acciones</th>
   </tr>
  </tfoot>
 </table>
</div>
<br clear="all" />

<script>
 $(document).ready(function () {
  $("#example").DataTable({
    "language": {
      "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
    }
  });
 });
 $(".borrarempledas").click(function (e) {
  e.preventDefault();
  console.log($(this).data("id"));
  const swalWithBootstrapButtons = Swal.mixin({
   customClass: {
    confirmButton: "btn btn-success",
    cancelButton: "btn btn-danger",
   },
   buttonsStyling: false,
  });

  swalWithBootstrapButtons
   .fire({
    title: "Deseas eliminar?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "si,",
   })
   .then((result) => {
    if (result.value) {
     console.log("es confirmado");
     borrar = $(this).parent().parent();

     url_borrar = "{{url('ppal/distribucion/borrar')}}" + "/" + $(this).data("id");
     $.get(url_borrar, function (res) {
      if (res.status == "success") {
       console.log("lo borro");
       console.log($(this).parent());
       borrar.remove();
      }
     });
    }
   });
 });
</script>
@endsection
