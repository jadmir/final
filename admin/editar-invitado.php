<?php 
    //Recibimos el ID del Evento y validamos que sea un ENTERO.
    $id = $_GET['id'];

    //Si viene un String lo redireccionamos a la lista
    if(!filter_var($id, FILTER_VALIDATE_INT)){
        header('Location: lista-invitado.php');
    }

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
        Editar Invitados
        <small> Llena el formulario para editar un invitado. </small>
      </h1>
    </section>

    <div class="row">
      <div class="col-md-8">
        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Editar Invitado</h3>
            </div>

            <?php 
                $sql = "SELECT * FROM invitados WHERE id_invitado = {$id}";
                $resultado = $coneccion->query($sql);
                $invitado = $resultado->fetch_assoc();
            ?>
             
              <form role="form" name="guardar-registro" id="guardar-registro-archivo" method="POST" action="modelo-invitado.php" enctype="multipart/form-data"> 
                  <div class="box-body">
                    <div class="form-group">
                      <label for="nombreInvitado">Nombre:</label>
                      <input type="text" class="form-control" id="nombreInvitado" name="nombreInvitado" value="<?php echo $invitado['nombre_invitado']; ?>">
                    </div>

                    <div class="form-group">
                      <label for="apellidoInvitado">Apellidos:</label>
                      <input type="text" class="form-control" id="apellidoInvitado" name="apellidoInvitado" value="<?php echo $invitado['apellido_invitado']; ?>">
                    </div>

                    <div class="form-group">
                        <label for="descripcionInvitado">Descripción: </label>
                        <textarea class="form-control" name="descripcionInvitado" id="descripcionInvitado" rows="8"> <?php echo $invitado['descripcion']; ?> </textarea>
                    </div>

                    <div class="form-group">
                        <label for="imagenActual">Imagen actual:</label>
                        <br>
                        <?php if( ! $invitado['url_imagen']){ 
                            echo "<p> No tiene imagen. Seleccione una imagen para el invitado.</p>";
                        } else { ?>
                            <img src="../img/invitados/<?php echo $invitado['url_imagen']; ?>" alt="Imagen del invitado" width="200">
                        <?php } ?>
                    </div>

                    <div class="form-group">
                        <label for="imagenInvitado"> Imagen: </label>
                        <input class="form-control" type="file" id="imagenInvitado" name="imagenInvitado">
                        <p class="help-block"> Añada la imagen del invitado aquí</p>
                    </div>

                  </div>
                  <div class="box-footer">
                    <input type="hidden" name="registro" value="actualizar">
                    <input type="hidden" name="id_registro" value="<?php echo $invitado['id_invitado']; ?>">
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

