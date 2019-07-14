<?php 
  include_once ('funciones/sesiones.php');
  //Validamos que el nivel de usuario sea 1. Para permitir el acceso a este archivo.
  if( (int) $_SESSION['nivel'] == 0) {
    header('Location: admin-area.php');
    exit;
  }
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
        Crear Categoria
        <small> Llena el formulario para crear una categoria de evento </small>
      </h1>
    </section>

    <div class="row">
      <div class="col-md-8">
        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Crear Categoria</h3>
            </div>
              <form role="form" name="guardar-registro" id="guardar-registro" method="POST" action="modelo-categoria.php"> 
                  <div class="box-body">
                    <div class="form-group">
                      <label for="nombreCategoria">Nombre:</label>
                      <input type="text" class="form-control" id="nombreCategoria" name="nombreCategoria" placeholder="Ingresa el nombre de la categoria">
                    </div>

                    <div class="form-group">
                      <label for="">Icono:</label>
                      <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-address-book"></i>
                        </div>
                        <input type="text" class="form-control pull-right" id="iconoCategoria" name="iconoCategoria" placeholder="fa-icon">
                      </div>
                    </div>

                  </div>
                  <div class="box-footer">
                    <input type="hidden" name="registro" value="nuevo">
                    <button type="submit" class="btn btn-primary" id="crear_registro">Añadir</button>
                  </div>
              </form>    
          </div> <!-- /.box -->
        </section> <!-- /.content -->
      </div>
    </div>
  </div> <!-- /.content-wrapper -->

  <?php   
      include_once ('templates/footer.php');
  ?>

