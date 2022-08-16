<!DOCTYPE html>
<html lang="es">
 <head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
  <title>Empleada</title>
 </head>
 <body style="background: gray;">
  <div class="wrapper wrapper-full-page">
   <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute">
    <div class="container">
     <div class="navbar-wrapper">
      <a class="navbar-brand" href="#pablo"></a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
       <span class="navbar-toggler-bar burger-lines"></span>
       <span class="navbar-toggler-bar burger-lines"></span>
       <span class="navbar-toggler-bar burger-lines"></span>
      </button>
     </div>
     <div class="collapse navbar-collapse justify-content-end" id="navbar">
      <br clear="all" />
      <br clear="all" />
      <br clear="all" />
      <br clear="all" />
     </div>
    </div>
   </nav>
   <div class="full-page section-image" data-color="black" data-image="assets/img/sidebar-2.jpg" ;>
    <div class="content">
     <div class="container">
      <div class="col-md-4 col-sm-6 ml-auto mr-auto">
       <form class="form" method="POST">
        @csrf
        <div class="card card-login card-hidden">
         <div class="card-header">
          <h3 class="header text-center">Login</h3>
         </div>
         <div class="card-body">
          @if(session()->has('mensaje'))
          <div class="alert alert-warning" id="cartel">
           <span>{{session()->get('mensaje')}}</span>
          </div>
          @endif
          <div class="card-body">
           <div class="form-group">
            <label>Usuario</label>
            <input type="text" placeholder="Usuario" name="usuario" class="form-control" required />
           </div>
           <div class="form-group">
            <label>Clave</label>
            <input type="password" placeholder="Password" name="password" class="form-control" required />
           </div>
          </div>
         </div>
         <div class="card-footer ml-auto mr-auto">
          <button type="submit" class="btn btn-warning btn-wd">Login</button>
         </div>
        </div>
       </form>
      </div>
     </div>
    </div>
   </div>
  </div>
 </body>
 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
 <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</html>
