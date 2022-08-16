@extends('panel.layout') @section('content')
<div class="row">
    <div class="row">
                <div class="col-md-6">
                    <div class="card ">
                        <div class="card-header ">
                            <h4 class="card-title">Ausencias/Asistencias</h4>
                            <p class="card-category">Grafico de ausencias</p>
                        </div>
                        <div class="card-body ">
                            
                            <canvas id="oilChart" width="600" height="400"></canvas>
                            
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card ">
                        <div class="card-header ">
                            <h4 class="card-title">Tareas</h4>
                            <p class="card-category">Tareas realizadas</p>
                        </div>
                        <div class="card-body ">
                            <canvas id="oilChart_tareas" width="600" height="400"></canvas>
                        </div>
                    </div>
                </div>
            </div>
</div>
<br clear="all">
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
    <th>Hora</th>
    <th>Empleada</th>
    
   </tr>
  </thead>
  <tbody>
   @foreach ($tares as $t)

   <tr @if($t->estado!="pendiente") style="background: pink;"@endif>
    <td>{{$t->fecha_realizacion}}</td>
    <td>{{$t->tareanombre}}</td>
    <td>{{$t->hora_inicio}}</td>
    <td>{{$t->empleada}}</td>
    
   </tr>
   @endforeach
  </tbody>
  <tfoot>
   <tr>
    <th>Fecha</th>
    <th>Tarea</th>
    <th>Hora</th>
    <th>Empleada</th>
   </tr>
  </tfoot>
 </table>
</div>
<script>
 $(document).ready(function () {
  $("#example").DataTable();
 });
var oilCanvas = document.getElementById("oilChart");
var oilChart_tareas = document.getElementById("oilChart_tareas");

var oilData = {
    labels: [
        "NO",
        "SI",
    ],
    datasets: [{
            data: ["{{$torta1['reemplazo']}}", "{{$torta1['no_reemplazo']}}" ],
            backgroundColor: [
                "#FF6384",
                "#63FF84",
            ]
        }]
};

var oilChart_tareasData ={
    labels:[
        "Terminadas",
        "pendientes"
    ],
    datasets: [{
        data: ["{{$torta2['pendiente']}}", "{{$torta2['terminadas']}}" ],
        backgroundColor: [
                "#FF6384",
                "#63FF84",
        ]
    }]
}

var pieChart2 = new Chart(oilChart_tareas, {
  type: 'pie',
  data: oilChart_tareasData
});

var pieChart = new Chart(oilCanvas, {
  type: 'pie',
  data: oilData
});




</script>
@endsection
