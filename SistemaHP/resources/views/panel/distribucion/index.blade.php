@extends('panel.layout') @section('content')

<div class="row">
 @if(session()->has('mensaje'))
 <div class="alert alert-warning" id="cartel">
  <span>{{session('mensaje')}}</span>
 </div>
 @endif
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
<script>
 $(document).ready(function () {
  $("#example").DataTable();
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
     
     url_borrar="{{url('ppal/distribucion/borrar')}}"+'/'+$(this).data("id")
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
