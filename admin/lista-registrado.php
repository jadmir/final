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
        Listado de Personas Registradas
        <small> Lista de invitados en la BD. </small>
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Maneja los visitantes registrados en esta sección</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="registros" class="table table-bordered table-striped">
                <thead>
                  <tr>
                      <th>Número</th>
                      <th>Nombre</th>
                      <th>Email</th>
                      <th>Fecha Registro</th>
                      <th>Artículos</th>
                      <th>Talleres</th>
                      <th>Regalo</th>
                      <th>Compra</th>
                      <th>Acciones</th>
                  </tr>
                </thead>

                <tbody>
                    <?php 
                        try {   
                            //Extraes todos los campos de registrados y de la tabla regalo solo el nombre.
                            $sql = "SELECT registrados.*, regalos.nombre_regalo FROM registrados ";
                            $sql .= " JOIN regalos ";
                            $sql .= " ON registrados.regalo = regalos.id_regalo";

                            $resulado = $coneccion->query($sql);

                        } catch(Exceptio $e){
                            echo $e->getMessage();
                        }

                        
                        $numero = 1;
                        while($registrado = $resulado->fetch_assoc()){
                        
                    ?>
                        <tr>
                            <td> <?php echo $numero; ?> </td>
                            <td> 
                                <?php 
                                    echo $registrado['nombre_registrado'] . $registrado['apellido_registrado']; 
                                    //Muestra un sticker de Pagado o No pagado.
                                    if($registrado['pagado'] == 1){
                                        echo '<span class="badge bg-green"> Pagado </span>';
                                    } else {
                                        echo '<span class="badge bg-red"> No Pagado </span>';
                                    }

                                    ?> 
                            </td>
                            <td> <?php echo $registrado['email_registrado']; ?> </td>
                            <td> <?php echo $registrado['fecha_registro']; ?> </td>
                            <td> 
                                <?php 
                                    //Decodifica de json a un array. Primero lo covierte a un objeto, si le pasas true lo convierte en un array.
                                    $articulos = json_decode($registrado['pases_articulos'], true);
                                    
                                    //Hacemos un arreglo con las llaves del array decodificado pero que se vea y se lea fácilmente.
                                    $arreglo_articulos = array(
                                        'un_dia' => 'Pase 1 día',
                                        'pase_2dias' => 'Pase 2 días',
                                        'pase_completo' => 'Pase completo',
                                        'camisas' => 'Camisas',
                                        'etiquetas' => 'Etiquetas'
                                    );

                                    //Recorremos el json decodificado.
                                    foreach($articulos as $key => $articulo){
                                        //como en la base de datos algunos tiene el campo cantidad. Validaremos con PHP.
                                        if(array_key_exists('cantidad', $articulo)){ //pasamos la llave a revisar y dónde queremos revisar.
                                            echo "<b>" . $articulo['cantidad'] . "</b>" . " " .$arreglo_articulos[$key] . "<br>";
                                        }else {
                                            echo "<b>" . $articulo . "</b>" . " " .$arreglo_articulos[$key] . "<br>";
                                        }
                                    }
                                ?>
                            </td>
                            <td> 
                                <?php 
                                    $eventos_resultado = $registrado['talleres_registrados']; //Recibe todos los talleres en json
                                    $array_talleres = json_decode($eventos_resultado, true); //Convierte de json a array

                                    $talleres = implode("', '", $array_talleres['eventos']); //Separa por comas y agrega comillas simples a cada valor.

                                    //Consulta SQL para sacar detalles usando como filtro la clave.
                                    $sql_talleres = "SELECT nombre_evento, fecha_evento, hora_evento FROM eventos WHERE clave IN ('$talleres') OR id_evento IN ('$talleres')";
                                    $resultado_talleres = $coneccion->query($sql_talleres);
                                    
                                    while($eventos = $resultado_talleres->fetch_assoc()){
                                        echo $eventos['nombre_evento'] . " " . $eventos['fecha_evento'] . " " . $eventos['hora_evento'] . "<br>";
                                    }
                                
                                
                                ?> 
                            </td>
                            <td> <?php echo $registrado['nombre_regalo']; ?></td>
                            <td> $ <?php echo (float) $registrado['total_pagado']; ?></td>
                            <td> 
                                <a href="editar-registrado.php?id=<?php echo $registrado['id_registrado'];?>" class="btn bg-orange btn-flat margin"> 
                                <i class="fas fa-pencil-alt"></i> 
                                </a> 
                                <a href="#" data-id="<?php echo $registrado['id_registrado']; ?>" data-tipo="registrado" class="btn bg-maroon btn-flat margin borrar_registro">
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
                      <th>Email</th>
                      <th>Fecha Registro</th>
                      <th>Artículos</th>
                      <th>Talleres</th>
                      <th>Regalo</th>
                      <th>Compra</th>
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

