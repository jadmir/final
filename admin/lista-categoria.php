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
        Listado de Categorias de Eventos
        <small>Lista de categorias de eventos almacenados en la base de datos.</small>
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Maneja las categorías de los eventos</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="registros" class="table table-bordered table-striped">
                <thead>
                  <tr>
                      <th>Número</th>
                      <th>Nombre</th>
                      <th>Icono</th>
                      <th>Acciones</th>
                  </tr>
                </thead>

                <tbody>
                      <?php 

                        try {
                          $sql = "SELECT * FROM categoria_evento"; //Crea consulta SQL
                          
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
                          <td> <?php echo $resultado['cat_evento']; ?> </td>
                          <td> <i class="fa <?php echo $resultado['icono']; ?>"> </i>   </td>
                          <td> 
                            <a href="editar-categoria.php?id=<?php echo $resultado['id_categoria'];?>" class="btn bg-orange btn-flat margin"> 
                              <i class="fas fa-pencil-alt"></i> 
                            </a> 
                            <a href="#" data-id="<?php echo $resultado['id_categoria']; ?>" data-tipo="categoria" class="btn bg-maroon btn-flat margin borrar_registro">
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
                      <th>Icono</th>
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

