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
        Listado de Eventos
        <small> Aquí podrás editar o borrar los eventos </small>
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Maneja los eventos en esta sección</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="registros" class="table table-bordered table-striped">
                <thead>
                  <tr>
                      <th>Número</th>
                      <th>Nombre</th>
                      <th>Fecha</th>
                      <th>Hora</th>
                      <th>Categoría</th>
                      <th>Invitado</th>
                      <th>Acciones</th>
                  </tr>
                </thead>

                <tbody>
                    <?php 
                        try {
                            $sql = "SELECT id_evento, nombre_evento, fecha_evento, hora_evento, cat_evento, nombre_invitado, apellido_invitado FROM eventos ";
                            $sql .= " INNER JOIN categoria_evento ON eventos.id_categoria = categoria_evento.id_categoria ";
                            $sql .= " INNER JOIN invitados ON eventos.id_invitado = invitados.id_invitado";
                            $sql .= " ORDER BY id_evento DESC";

                            $resulado = $coneccion->query($sql);

                        } catch(Exceptio $e){
                            echo $e->getMessage();
                        }

                        
                        $numero = 1;
                        while($evento = $resulado->fetch_assoc()){
                        
                    ?>
                        <tr>
                            <td> <?php echo $numero; ?> </td>
                            <td> <?php echo $evento['nombre_evento']; ?> </td>
                            <td> <?php echo $evento['fecha_evento']; ?> </td>
                            <td> <?php echo $evento['hora_evento']; ?> </td>
                            <td> <?php echo $evento['cat_evento']; ?> </td>
                            <td> <?php echo $evento['nombre_invitado'] . $evento['apellido_invitado']; ?> </td>
                            <td> 
                                <a href="editar-evento.php?id=<?php echo $evento['id_evento'];?>" class="btn bg-orange btn-flat margin"> 
                                <i class="fas fa-pencil-alt"></i> 
                                </a> 
                                <a href="#" data-id="<?php echo $evento['id_evento']; ?>" data-tipo="evento" class="btn bg-maroon btn-flat margin borrar_registro">
                                <i class="fa fa-trash"></i> 
                                </a>   
                          </td>
                        </tr>

                    <?php

                            $numero++;
                        }
                    
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                      <th>Número</th>
                      <th>Nombre</th>
                      <th>Fecha</th>
                      <th>Hora</th>
                      <th>Categoría</th>
                      <th>Invitado</th>
                      <th>Acciones</th>
                    </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
  </div> <!-- /.content-wrapper -->

  <?php   
      include_once ('templates/footer.php');
  ?>

