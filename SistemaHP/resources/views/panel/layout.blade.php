<!DOCTYPE html>
<html lang="es">
 <head>
  <meta charset="utf-8" />
  <link rel="icon" type="image/png" href="assets/img/favicon.ico" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>Panel Encargada</title>
  <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
  <meta name="viewport" content="width=device-width" />
  <link href="{{url('assets/css/bootstrap.min.css')}}" rel="stylesheet" />
  <link href="{{url('assets/css/animate.min.css')}}" rel="stylesheet" />
  <link href="{{url('assets/css/light-bootstrap-dashboard.css?v=1.4.0')}}" rel="stylesheet" />
  <link href="{{url('assets/css/demo.css')}}" rel="stylesheet" />
  <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" />
  <link href="http://fonts.googleapis.com/css?family=Roboto:400,700,300" rel="stylesheet" type="text/css" />
  <link href="{{url('assets/css/pe-icon-7-stroke.css')}}" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <script src="{{url('assets/js/jquery.3.2.1.min.js')}}" type="text/javascript"></script>
  <script src="{{url('assets/js/bootstrap.min.js')}}" type="text/javascript"></script>
  <link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet" />
  <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script> 
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link href="{{url('lib/main.css')}}" rel="stylesheet" />
  <script src="{{url('lib/main.js')}}" type="text/javascript"></script>
  <script src="https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"></script>
  <style>
   .card .card-stats {
    border: 0;
    margin-bottom: 30px;
    margin-top: 30px;
    border-radius: 6px;
    color: #333;
    background: #fff;
    width: 100%;
    box-shadow: 0 2px 2px 0 rgb(0 0 0 / 14%), 0 3px 1px -2px rgb(0 0 0 / 20%), 0 1px 5px 0 rgb(0 0 0 / 12%);
   }
   .card [class*="card-header-"] .card-icon,
   .card [class*="card-header-"] .card-text {
    border-radius: 3px;
    background-color: #999;
    padding: 15px;
    margin-top: -20px;
    margin-right: 15px;
    float: left;
   }

   .card-stats .card-header.card-header-icon i {
    font-size: 36px;
    line-height: 56px;
    width: 56px;
    height: 56px;
    text-align: center;
   }

   .card-stats .card-header + .card-footer {
    border-top: 1px solid #eee;
    margin-top: 20px;
   }

   .card .card-header-warning .card-icon,
   .card .card-header-warning .card-text,
   .card .card-header-warning:not(.card-header-icon):not(.card-header-text),
   .card.card-rotate.bg-warning .back,
   .card.card-rotate.bg-warning .front {
    background: #ffa726;
    background: linear-gradient(60deg, #ffa726, #fb8c00);
   }

   .card[class*="bg-"],
   .card[class*="bg-"] .card-title,
   .card[class*="bg-"] .card-title a,
   .card[class*="bg-"] .icon i,
   .card [class*="card-header-"],
   .card [class*="card-header-"] .card-title,
   .card [class*="card-header-"] .card-title a,
   .card [class*="card-header-"] .icon i {
    color: #fff;
   }
  </style>
 </head>
 <body>
  <div class="wrapper">
   <div class="sidebar" data-color="black" data-image="{{url('assets/img/sidebar-2.jpg')}}">
    <div class="sidebar-wrapper">
     <div class="logo">
      <a href="{{url('ppal')}}" class="simple-text">
       LOGO
      </a>
     </div>
     <ul class="nav">
      <li class="{{ request()->is('ppal') ? 'active' : '' }}">
       <a href="{{url('ppal')}}">
        <i class="pe-7s-graph"></i>
        <p>Dashboard</p>
       </a>
      </li>
      <li class="{{ request()->is('ppal/empleadas*') ? 'active' : '' }}">
       <a href="{{url('ppal/empleadas')}}">
        <i class="pe-7s-user"></i>
        <p>Empleadas</p>
       </a>
      </li>
      <li class="{{ request()->is('ppal/tareas*') ? 'active' : '' }}">
       <a href="{{url('ppal/tareas')}}">
        <i class="pe-7s-note2"></i>
        <p>Tareas</p>
       </a>
      </li>
      <li class="{{ request()->is('ppal/revision*') ? 'active' : '' }}">
       <a href="{{url('ppal/revision')}}">
        <i class="pe-7s-news-paper"></i>
        <p>Revisión</p>
       </a>
      </li>
      <li class="{{ request()->is('ppal/distribucion*') ? 'active' : '' }}">
       <a href="{{url('ppal/distribucion')}}">
        <i class="pe-7s-science"></i>
        <p>Distribución</p>
       </a>
      </li>
      <li class="{{ request()->is('ppal/qr') ? 'active' : '' }}">
       <a href="{{url('ppal/qr')}}">
        <i class="pe-7s-usb"></i>
        <p>Generador QR</p>
       </a>
      </li>
      <li class="{{ request()->is('ppal/notas*') ? 'active' : '' }}">
       <a href="{{url('ppal/notas')}}">
        <i class="pe-7s-notebook"></i>
        <p>Notas</p>
       </a>
      </li>
      <li class="{{ request()->is('ppal/informe') ? 'active' : '' }}">
       <a href="{{url('ppal/informe')}}">
        <i class="pe-7s-note2"></i>
        <p>Informes</p>
       </a>
      </li>
      <li>
       <a href="{{url('salir')}}">
        <i class="pe-7s-power"></i>
        <p>Salir</p>
       </a>
      </li>
     </ul>
    </div>
   </div>
   <div class="main-panel">
    <nav class="navbar navbar-default navbar-fixed">
     <div class="container-fluid">
      <div class="navbar-header">
       <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
       </button>
       <a class="navbar-brand" href="#">Dashboard</a>
      </div>
      <div class="collapse navbar-collapse">
       <ul class="nav navbar-nav navbar-right">
        <li>
         <a href="{{url('ppal/config')}}">
          <i class="pe-7s-tools" style="font-size: 22px; font-weight: bold;"></i>
         </a>
        </li>
        <li>
         <a href="{{url('salir')}}">
          <i class="pe-7s-power" style="font-size: 22px; font-weight: bold;"></i>
         </a>
        </li>
        <li class="separator hidden-lg"></li>
       </ul>
      </div>
     </div>
    </nav>
    <div class="content">
     <div class="container-fluid">
      @yield('content')
     </div>
    </div>
   </div>
  </div>
  <script src="{{url('assets/js/bootstrap-notify.js')}}"></script>
  <script src="{{url('assets/js/light-bootstrap-dashboard.js?v=1.4.0')}}"></script>
 </body>
</html>
