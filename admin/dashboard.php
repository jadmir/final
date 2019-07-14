<?php 
  include_once ('funciones/sesiones.php');
  include_once ('funciones/funciones.php');
  include_once ('templates/header.php');
  
  include_once ('templates/barra-superior.php');

  include_once ('templates/navegacion-lateral.php');

?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Información sobre el evento.</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="box-body chart-responsive">
              <div class="chart" id="grafica-registrados" style="height: 300px;"></div>
            </div>


        
        </div>

        <h3 class="page-header"> Resúmen de registrados</h3>
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <?php 
                    $sql = "SELECT COUNT(id_registrado) AS registros FROM registrados";
                    $resultado = $coneccion->query($sql);
                    $registrados = $resultado->fetch_assoc();
                ?>
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                    <h3> <?php echo $registrados['registros']; //Accedemos al valor usando el alias?> </h3>

                    <p>Usuarios registrados</p>
                    </div>
                    <div class="icon">
                    <i class="fa fa-user"></i>
                    </div>
                    <a href="lista-registrado.php" class="small-box-footer">
                    Más información <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-xs-6">
                <?php 
                    $sql = "SELECT COUNT(id_registrado) AS registros FROM registrados WHERE pagado = 1";
                    $resultado = $coneccion->query($sql);
                    $registrados = $resultado->fetch_assoc();
                ?>
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                    <h3> <?php echo $registrados['registros']; //Accedemos al valor usando el alias?> </h3>

                    <p>Total pagados</p>
                    </div>
                    <div class="icon">
                    <i class="fa fa-users"></i>
                    </div>
                    <a href="lista-registrado.php" class="small-box-footer">
                    Más información <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-xs-6">
                <?php 
                    $sql = "SELECT COUNT(id_registrado) AS registros FROM registrados WHERE pagado = 0";
                    $resultado = $coneccion->query($sql);
                    $registrados = $resultado->fetch_assoc();
                ?>
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                    <h3> <?php echo $registrados['registros']; //Accedemos al valor usando el alias?> </h3>

                    <p>Total sin pagar</p>
                    </div>
                    <div class="icon">
                    <i class="fa fa-user-times"></i>
                    </div>
                    <a href="lista-registrado.php" class="small-box-footer">
                    Más información <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-xs-6">
                <?php 
                    $sql = "SELECT SUM(total_pagado) AS ganancia FROM registrados WHERE pagado = 1";
                    $resultado = $coneccion->query($sql);
                    $registrados = $resultado->fetch_assoc();
                ?>
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                    <h3> $ <?php echo $registrados['ganancia']; //Accedemos al valor usando el alias?> </h3>

                    <p>Ganancias totales</p>
                    </div>
                    <div class="icon">
                    <i class="fa fa-dollar-sign"></i>
                    </div>
                    <a href="lista-registrado.php" class="small-box-footer">
                    Más información <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        </div>

        <h2 class="page-header"> Regalos </h2>

        <div class="row">
            <div class="col-lg-3 col-xs-6">
                    <?php 
                        $sql = "SELECT COUNT(*) AS pulseras FROM registrados WHERE regalo = 1 AND pagado = 1";
                        $resultado = $coneccion->query($sql);
                        $regalo = $resultado->fetch_assoc();
                    ?>
                    <!-- small box -->
                    <div class="small-box bg-teal">
                        <div class="inner">
                        <h3> <?php echo $regalo['pulseras']; //Accedemos al valor usando el alias?> </h3>

                        <p>Pulseras</p>
                        </div>
                        <div class="icon">
                        <i class="fa fa-gift"></i>
                        </div>
                        <a href="lista-registrado.php" class="small-box-footer">
                        Más información <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </div>
            </div>


            <div class="col-lg-3 col-xs-6">
                <?php 
                    $sql = "SELECT COUNT(*) AS etiquetas FROM registrados WHERE regalo = 2 AND pagado = 1";
                    $resultado = $coneccion->query($sql);
                    $regalo = $resultado->fetch_assoc();
                ?>
                <!-- small box -->
                <div class="small-box bg-maroon">
                    <div class="inner">
                    <h3> <?php echo $regalo['etiquetas']; //Accedemos al valor usando el alias?> </h3>

                    <p>Etiquetas</p>
                    </div>
                    <div class="icon">
                    <i class="fa fa-gift"></i>
                    </div>
                    <a href="lista-registrado.php" class="small-box-footer">
                    Más información <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-xs-6">
                <?php 
                    $sql = "SELECT COUNT(*) AS plumas FROM registrados WHERE regalo = 3 AND pagado = 1";
                    $resultado = $coneccion->query($sql);
                    $regalo = $resultado->fetch_assoc();
                ?>
                <!-- small box -->
                <div class="small-box bg-purple-active">
                    <div class="inner">
                    <h3> <?php echo $regalo['plumas']; //Accedemos al valor usando el alias?> </h3>

                    <p>Plumas</p>
                    </div>
                    <div class="icon">
                    <i class="fa fa-gift"></i>
                    </div>
                    <a href="lista-registrado.php" class="small-box-footer">
                    Más información <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </section> <!-- /.content -->
  </div> <!-- /.content-wrapper -->

  <?php   
      include_once ('templates/footer.php');
  ?>

