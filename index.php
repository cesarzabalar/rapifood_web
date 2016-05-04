<!DOCTYPE html>
<html>
  <head>
    <title>Admin :: RapiFood</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

      <!-- Material Design fonts -->
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/css/estilos.css">

    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>

      <!-- Bootstrap Material Design -->
    <link href="assets/css/bootstrap-material-design.css" rel="stylesheet">
    <link href="assets/css/ripples.min.css" rel="stylesheet">

    <link href="assets/css/bootstrap-switch.min.css" rel="stylesheet">

    <!-- Snackbar -->
    <link rel="stylesheet" type="text/css" href="assets/snackbar/snackbar.min.css">
      

    <script src="assets/js/jquery.min.js" type="text/javascript"></script>
    <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="assets/js/ripples.min.js"></script>
    <script src="assets/js/material.min.js"></script>
    <script src="assets/snackbar/snackbar.min.js"></script>
    <script src="assets/js/bootstrap-switch.min.js"></script>


    <script src="assets/js/funciones.js"></script>
  </head>
  <body>

    <!-- Barra de navegación -->
    <div class="container-fluid">
      <div class="row">

        <div class="navbar navbar-default">
            <div class="container">
              <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="javascript:void(0)">RapiFood</a>
              </div>
              <div class="navbar-collapse collapse navbar-responsive-collapse">
                <ul class="nav navbar-nav">
                  <li class="menu" id="inicio"><a href="#">Inicio</a></li>
                </ul>
              </div>
            </div>
        </div>

      </div>
    </div>


    <!-- Contenedor Principal -->
    <div class="container">

      <?php include_once('vista/listausuarios.php') ?>   
    
    </div>
  </body>
</html>