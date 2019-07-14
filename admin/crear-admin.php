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
        Crear Administradores
        <small> Llena el formulario para poder crear un administrador.</small>
      </h1>
    </section>

    <div class="row">
      <div class="col-md-8">
        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Crear Administrador</h3>
            </div>
              <form role="form" name="guardar-registro" id="guardar-registro" method="POST" action="modelo-admin.php"> 
                  <div class="box-body">
                    <div class="form-group">
                      <label for="usuario">Usuario:</label>
                      <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Ingresa un usuario">
                    </div>

                    <div class="form-group">
                      <label for="nombre">Nombre:</label>
                      <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingresa tu nombre y apellidos">
                    </div>

                    <div class="form-group">
                      <label for="contrasenia">Contraseña:</label>
                      <input type="password" class="form-control" id="contrasenia" name="contrasenia" placeholder="Ingresa una contraseña">
                    </div>

                    <div class="form-group">
                      <label for="contrasenia">Repetir contraseña:</label>
                      <input type="password" class="form-control" id="repetir_contrasenia" name="repetir_contrasenia" placeholder="Repita la contraseña">
                      <span id="resultado_contrasenia" class="help-block"></span>
                    </div>

                  </div>
                  <div class="box-footer">
                    <input type="hidden" name="registro" value="nuevo">
                    <button type="submit" class="btn btn-primary" id="crear_registro_admin">Añadir</button>
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

