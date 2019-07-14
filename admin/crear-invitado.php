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
        Crear Invitados
        <small> Llena el formulario para crear un invitado. </small>
      </h1>
    </section>

    <div class="row">
      <div class="col-md-8">
        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Crear Invitado</h3>
            </div>
              <form role="form" name="guardar-registro" id="guardar-registro-archivo" method="POST" action="modelo-invitado.php" enctype="multipart/form-data"> 
                  <div class="box-body">
                    <div class="form-group">
                      <label for="nombreInvitado">Nombre:</label>
                      <input type="text" class="form-control" id="nombreInvitado" name="nombreInvitado" placeholder="Ingresa el nombre de la categoria">
                    </div>

                    <div class="form-group">
                      <label for="apellidoInvitado">Apellidos:</label>
                      <input type="text" class="form-control" id="apellidoInvitado" name="apellidoInvitado" placeholder="Ingresa el nombre de la categoria">
                    </div>

                    <div class="form-group">
                        <label for="descripcionInvitado">Descripción: </label>
                        <textarea class="form-control" name="descripcionInvitado" id="descripcionInvitado" rows="8" placeholder="Descripción o biografía"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="imagenInvitado"> Imagen: </label>
                        <input class="form-control" type="file" id="imagenInvitado" name="imagenInvitado">
                        <p class="help-block"> Añada la imagen del invitado aquí</p>
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

