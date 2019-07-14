<?php include_once 'includes/templates/header.php';?>

    <section class="seccion contenedor">
        <h2>Calendario de Eventos</h2>

        <?php 
            try {
                require_once('includes/funciones/bd_coneccion.php');

                $sql = "SELECT id_evento, nombre_evento, fecha_evento, hora_evento, cat_evento, icono, nombre_invitado, apellido_invitado ";
                $sql .= " FROM eventos ";
                $sql .= " INNER JOIN categoria_evento ";
                $sql .= " ON eventos.id_categoria = categoria_evento.id_categoria ";
                $sql .= " INNER JOIN invitados ";
                $sql .= " ON eventos.id_invitado = invitados.id_invitado";
                $sql .= " ORDER BY id_evento";
                $resultado = $coneccion->query($sql);

            } catch (Exception $e){
                echo $e->getMessage();
            }
    
        ?>

        <div class="calendario">
            <?php
                $calendario = array(); //Creación de array para agrupar.

                while($eventos = $resultado->fetch_assoc()){ 

                    //Obtiene la fecha del evento.
                    $fecha = $eventos['fecha_evento'];
                    
                    //Creación de otro array personalizado
                    $evento = array (
                        'titulo' => $eventos['nombre_evento'],
                        'fecha' => $eventos['fecha_evento'],
                        'hora' => $eventos['hora_evento'],
                        'categoria' => $eventos['cat_evento'],
                        'icono' => $eventos['icono'],
                        'invitado' => $eventos['nombre_invitado'] . " " . $eventos['apellido_invitado']

                    );
                    
                    //Agregamos cada evento a array calendario, AGRUPADO POR FECHA
                    $calendario[$fecha][] = $evento; 
                    
                    
            ?>

             <?php } //fin de while fetch assoc.?>


             <?php 
                    //Imprime todos los eventos.
                    foreach($calendario as $dia => $lista_eventos) { ?>
                        <h3>
                            <i class="fa fa-calendar"></i>
                            <?php 
                                // Sintaxis de formateo para Unix 
                                setlocale(LC_TIME, 'es_ES.UTF-8'); //Formateo de fechas para Unix
                                
                                // Sintaxis de formateo para Windows 
                                //setlocale(LC_TIME, 'spanish');

                                echo strftime("%A, %d de %B del %Y", strtotime($dia)); //Fecha formateado para mejor visibilidad. 
                            ?>
                        </h3>
                       

                        <?php 
                            foreach($lista_eventos as $evento){

                        ?>
                            <div class="dia">
                                <p class="titulo"> <?php echo $evento['titulo']; ?></p>
                                <p class="hora">
                                    <i class="fa fa-clock" aria-hidden="true"></i> 
                                    <?php echo $evento['fecha'] . " " . $evento['hora']; ?>
                                </p>
                                <p>
                                    <i class="fa <?php echo $evento['icono']?>" aria-hidden="true"></i>
                                    <?php echo $evento['categoria']; ?>
                                </p>
                                <p>
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                    <?php echo $evento['invitado'];?>
                                </p>

                            </div>
                        
                        <?php } //Fin foreach evento ?>
            <?php } //Fin foreach dias ?>

        </div> <!--.Calendario -->
       

        <?php 
            $coneccion->close();
        ?>

    </section><!--.seccion-->

    <?php include_once 'includes/templates/footer.php';?>