
<!DOCTYPE html>
<html class="no-js" lang="">

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Brosmind</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="manifest" href="site.webmanifest">
  <link rel="apple-touch-icon" href="icon.png">
  <!-- Place favicon.ico in the root directory -->

  <link rel="stylesheet" href="css/normalize.css">
  <script src="https://kit.fontawesome.com/108948dc42.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Open+Sans|Oswald|PT+Sans" rel="stylesheet">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.3/dist/leaflet.css" integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ==" crossorigin=""/>

  <?php 
    //Cargando archivos de acuerdo a la página abierta.
    $archivo = basename($_SERVER['PHP_SELF']); //Retorna el nombre del archivo que está cargando actualmente.
    $pagina = str_replace(".php", "", $archivo); //busca , reemplaza y fuente de datos.

    if($pagina == 'invitados' || $pagina == 'index'){ //Valida si la pagg cargada es invitados.
      echo '<link rel="stylesheet" href="css/colorbox.css">';
    } else if($pagina == 'conferencia') { //Valida si la pagg cargada es conferencia.
      echo '<link rel="stylesheet" href="css/lightbox.css">';
    }
  ?>

 
  <link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.3/dist/leaflet.css" />


</head>

<body class="<?php echo $pagina ?>">
  <!--[if lte IE 9]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
  <![endif]-->
    <header>
      <div class="hero">
        <div class="contenido-header">
          <nav class="redes-sociales">
            <a href="#"><i class="fab fa-facebook-f" aria-hidden="true"></i></a>
            <a href="#"><i class="fab fa-twitter" aria-hidden="true"></i></a>
            <a href="#"><i class="fab fa-pinterest-p" aria-hidden="true"></i></a>
            <a href="#"><i class="fab fa-youtube" aria-hidden="true"></i></a>
            <a href="#"><i class="fab fa-instagram" aria-hidden="true"></i></a>
          </nav>
          <div class="informacion-evento">
            <div class="clearfix">
              <p class="fecha"><i class="fas fa-calendar-alt" aria-hidden="true"></i>10-12 Dic</p>
              <p class="ciudad"><i class="fas fa-map-marker-alt" aria-hidden="true"></i>Lima Perú</p>
            </div>
            <h1 class="nombre-sitio">BROSMIND</h1>
            <p class="eslogan">La mejor conferencia de <span>diseño web</span></p>
          </div><!--.información-evento-->
        </div>
      </div><!--.hero-->
    </header>
    
    <div class="barra">
      <div class="contenedor clearfix">
        <div class="logo">
          <a href="index.php"> <img src="img/logo1.svg" alt="Logo brosmid"> </a>
        </div>
        <div class="menu-movil">
          <span></span>
          <span></span>
          <span></span>
        </div>
        <nav class="navegacion-principal">
          <a href="conferencia.php">Conferencia</a>
          <a href="calendario.php">Calendario</a>
          <a href="invitados.php">Invitados</a>
          <a href="registro.php">Reservaciones</a>
        </nav>
      </div><!--.contenedor-->
    </div><!--.barra-->
