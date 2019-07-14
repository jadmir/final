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
        Listado de Administradores
        <small>Lista de usuarios almacenados en la base de datos.</small>
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Maneja los usuarios en esta sección</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="registros" class="table table-bordered table-striped">
                <thead>
                  <tr>
                      <th>Número</th>
                      <th>Usuario</th>
                      <th>Nombre</th>
                      <th>Acciones</th>
                  </tr>
                </thead>

                <tbody>
                      <?php 

                        try {
                          $sql = "SELECT id, usuario, nombre FROM administradores"; //Crea consulta SQL
                          
                          $respuesta = $coneccion->query($sql); //Ejecuta consulta SQL

                        } catch(Exception $e){
                           $error = $e->getMessage();
                           echo $error;
                        }
                        
                        $numero = 1;
                        while($resultado = $respuesta->fetch_assoc()){
                      ?>
                        <tr>
                          <td> <?php echo $numero; ?> </td>
                          <td> <?php echo $resultado['usuario']; ?> </td>
                          <td> <?php echo $resultado['nombre']; ?> </td>
                          <td> 
                            <a href="editar-admin.php?id=<?php echo $resultado['id'];?>" class="btn bg-orange btn-flat margin"> 
                              <i class="fas fa-pencil-alt"></i> 
                            </a> 
                            <a href="#" data-id="<?php echo $resultado['id']; ?>" data-tipo="admin" class="btn bg-maroon btn-flat margin borrar_registro">
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
                      <th>Usuario</th>
                      <th>Nombre</th>
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

