<?php 
    $id = $_GET['id'];
    
    if( ! filter_var($id, FILTER_VALIDATE_INT)) { //Valida que el id sea entero. Negamos para valida si alguien envia letras
    
        header('Location: lista-admin.php');
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
        Editar Categoria
        <small> Llena el formulario para editar la categoria </small>
      </h1>
    </section>

    <div class="row">
      <div class="col-md-8">
        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Editar Categoria</h3>
            </div>
            <?php 
                $sql = "SELECT * FROM categoria_evento WHERE id_categoria = {$id}";
                $resultado = $coneccion->query($sql);
                $categoria = $resultado->fetch_assoc();
            ?>

              <form role="form" name="guardar-registro" id="guardar-registro" method="POST" action="modelo-categoria.php"> 
                  <div class="box-body">
                    <div class="form-group">
                      <label for="nombreCategoria">Nombre:</label>
                      <input type="text" class="form-control" id="nombreCategoria" name="nombreCategoria" value="<?php echo $categoria['cat_evento']; ?>">
                    </div>

                    <div class="form-group">
                      <label for="">Icono:</label>
                      <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-address-book"></i>
                        </div>
                        <input type="text" class="form-control pull-right" id="iconoCategoria" name="iconoCategoria" value="<?php echo $categoria['icono']; ?>">
                      </div>
                    </div>

                  </div>
                  <div class="box-footer">
                    <input type="hidden" name="registro" value="actualizar">
                    <input type="hidden" name="id_registro" value="<?php echo $id; ?>">
                    <button type="submit" class="btn btn-primary" id="crear_registro">Guardar</button>
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

