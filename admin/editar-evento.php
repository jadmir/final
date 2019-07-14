<?php   
//Recibimos el ID del Evento y validamos que sea un ENTERO.
    $id = $_GET['id'];

    //Si viene un String lo redireccionamos a la lista
    if(!filter_var($id, FILTER_VALIDATE_INT)){
        header('Location: lista-evento.php');
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
        Editar Evento
        <small> Llena el formulario para editar un evento </small>
      </h1>
    </section>

    <div class="row">
      <div class="col-md-8">
        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Editar Evento</h3>
            </div>
                <?php 
                    $sql = "SELECT * FROM eventos WHERE id_evento = {$id}";
                    $resultado = $coneccion->query($sql);

                    $evento = $resultado->fetch_assoc();

                ?>
              <form role="form" name="guardar-registro" id="guardar-registro" method="POST" action="modelo-evento.php"> 
                  <div class="box-body">

                    <div class="form-group">
                      <label for="nombreEvento"> Nombre: </label>
                      <input type="text" class="form-control" id="nombreEvento" name="nombreEvento" placeholder="Ingresa nombre de evento" value="<?php echo $evento['nombre_evento']; ?>">
                    </div>

                    <div class="form-group">
                      <label for="categoria">Categoria:</label>
                      <select name="categoriaEvento" class="form-control select2">
                        <option value="0">- Seleccione -</option>
                        <?php 
                            try {
                                //Almacenamos categoria evento.
                                $id_cat_evento_actual = $evento['id_categoria'];


                                //Realiza la consulta a la BD y obtiene todas las categorias.
                                $sql = "SELECT id_categoria, cat_evento FROM categoria_evento";
                                $resultado = $coneccion->query($sql);

                            } catch(Exception $e){
                                echo "Error" . $e->getMessage(); 
                            }

                            while($categoria = $resultado->fetch_assoc()){

                                //Validamos si el ID extraído de la BD es igual al ID actual.
                                if($categoria['id_categoria'] == $id_cat_evento_actual){ //Sí es igual que se quede seleccionado.
                        ?>
                                    <option value="<?php echo $categoria['id_categoria']; ?>" selected> <?php echo $categoria['cat_evento'];?> </option>
                                
                        <?php
                                } else {
                        ?>
                                   <option value="<?php echo $categoria['id_categoria']; ?>"> <?php echo $categoria['cat_evento'];?> </option>
                        <?php
                                } //fin if.
                            } //fin while.
                        ?>
                      
                      </select>
                    </div>

                    <div class="form-group">
                        <label for="datepicker"> Fecha: </label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <?php 
                                //Formatea fecha.
                                $date = new DateTime($evento['fecha_evento']);
                                $fecha_formateado = $date->format('d/m/Y');
                            ?>
                        <input type="text" class="form-control pull-right" id="datepicker" name="fechaEvento" value="<?php echo $fecha_formateado ?>">
                        </div>
                    </div>

                    <div class="bootstrap-timepicker">
                        <div class="form-group">
                            <label> Hora:</label>
                            <div class="input-group">
                            <?php 
                                //Formateo de Hora.
                                $hora = $evento['hora_evento'];
                                $hora_formateada = date('h:i a', strtotime($hora));
                            ?>
                                <input type="text" class="form-control timepicker" name="horaEvento" value="<?php echo $hora_formateada; ?>" >

                                <div class="input-group-addon">
                                 <i class="fa fa-clock-o"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                      <label for="invitado">Invitado o Ponente:</label> 
                      <select name="invitadoEvento" class="form-control select2">
                        <option value="0">- Seleccione -</option>
                        <?php 
                            try {
                                //Almacenamos el ID de invitado actual.
                                $id_invitado_actual = $evento['id_invitado'];

                                $sql = "SELECT id_invitado, nombre_invitado, apellido_invitado FROM invitados";
                                $resultado = $coneccion->query($sql);

                            } catch(Exception $e){
                                echo "Error" . $e->getMessage(); 
                            }

                            while($invitados = $resultado->fetch_assoc()){
                                if($invitados['id_invitado'] == $id_invitado_actual){
                        ?>
                                    <option value="<?php echo $invitados['id_invitado']; ?>" selected ><?php echo $invitados['nombre_invitado'] . " " . $invitados['apellido_invitado'] ; ?></option>
                        <?php
                            } else {
                        ?>
                                   <option value="<?php echo $invitados['id_invitado']; ?>" ><?php echo $invitados['nombre_invitado'] . " " . $invitados['apellido_invitado'] ; ?></option>
                        <?php
                            } //Fin del if
                            } //Fin del while
                        ?>
                      
                      </select>
                    </div>

                  <div class="box-footer">
                    <input type="hidden" name="registro" value="actualizar">
                    <input type="hidden" name="id_registro" value="<?php echo $id; ?>">
                    <button type="submit" class="btn btn-primary">Guardar</button>
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

