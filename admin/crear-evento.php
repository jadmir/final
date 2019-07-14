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
        Crear Evento
        <small> Llena el formulario para crear un evento </small>
      </h1>
    </section>

    <div class="row">
      <div class="col-md-8">
        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Crear Evento</h3>
            </div>
              <form role="form" name="guardar-registro" id="guardar-registro" method="POST" action="modelo-evento.php"> 
                  <div class="box-body">

                    <div class="form-group">
                      <label for="nombreEvento"> Nombre: </label>
                      <input type="text" class="form-control" id="nombreEvento" name="nombreEvento" placeholder="Ingresa nombre de evento">
                    </div>

                    <div class="form-group">
                      <label for="categoria">Categoria:</label>
                      <select name="categoriaEvento" class="form-control select2">
                        <option value="0">- Seleccione -</option>
                        <?php 
                            try {

                                $sql = "SELECT id_categoria, cat_evento FROM categoria_evento";
                                $resultado = $coneccion->query($sql);

                            } catch(Exception $e){
                                echo "Error" . $e->getMessage(); 
                            }

                            while($categoria = $resultado->fetch_assoc()){
                        ?>
                            <option value="<?php echo $categoria['id_categoria']; ?>"> <?php echo $categoria['cat_evento']; ?> </option>
                                
                        <?php
                            }
                        ?>
                      
                      </select>
                    </div>

                    <div class="form-group">
                        <label for="datepicker"> Fecha: </label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                        <input type="text" class="form-control pull-right" id="datepicker" name="fechaEvento">
                        </div>
                    </div>

                    <div class="bootstrap-timepicker">
                        <div class="form-group">
                            <label> Hora:</label>
                            <div class="input-group">
                                <input type="text" class="form-control timepicker" name="horaEvento">

                                <div class="input-group-addon">
                                 <i class="fas fa-clock"></i>
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

                                $sql = "SELECT id_invitado, nombre_invitado, apellido_invitado FROM invitados";
                                $resultado = $coneccion->query($sql);

                            } catch(Exception $e){
                                echo "Error" . $e->getMessage(); 
                            }

                            while($invitados = $resultado->fetch_assoc()){
                        ?>
                            <option value="<?php echo $invitados['id_invitado']; ?>"><?php echo $invitados['nombre_invitado'] . " " . $invitados['apellido_invitado'] ; ?></option>
                                
                        <?php
                            }
                        ?>
                      
                      </select>
                    </div>

                  <div class="box-footer">
                    <input type="hidden" name="registro" value="nuevo">
                    <button type="submit" class="btn btn-primary">Añadir</button>
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

