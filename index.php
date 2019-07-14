<?php include_once 'includes/templates/header.php'; ?>

    <section class="seccion contenedor">
      <h2>La mejor conferencia de diseño web en español</h2>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nisi, officiis numquam. Accusantium architecto sapiente consectetur debitis, maiores voluptatem dolorem veritatis deleniti qui quae dignissimos aliquid tempora aperiam, magni quas eius.</p>
    </section><!--.seccion-->

    <section class="programa">
      <div class="contenedor-video">
        <video autoplay loop poster="img/bg-talleres.jpg" muted>
          <source src="videos/video.mp4" type="video/mp4">
          <source src="videos/video.webm" type="video/webm">
          <source src="videos/video.ogv" type="video/ogv">
        </video>
      </div><!--.contenedor-video-->
      <div class="contenido-programa">
        <div class="contenedor">
          <div class="programa-evento">
            <h2>Programa del evento</h2>

            <?php 
              //Extracción de programa del evento desde la BD.
              try {
                  require_once('includes/funciones/bd_coneccion.php');

                  $sql = "SELECT  * FROM categoria_evento";
                  $resultado = $coneccion->query($sql);

              } catch (Exception $e){
                  echo $e->getMessage();
              }
    
            ?>
            <nav class="menu-programa">
              <?php while($categoria = $resultado->fetch_array(MYSQLI_ASSOC)) { ?>
                <?php $nombreCategoria = $categoria['cat_evento'];?>
                <a href="#<?php echo strtolower($nombreCategoria); //conversión a minúscula ?>">
                  <i class="fa <?php echo $categoria['icono']?>" aria-hidden="true"></i> <?php echo $nombreCategoria; ?>
                </a>
              <?php } ?>
            </nav>

            <?php 
            //Multiquery para sacar los eventos.
              try {
                require_once('includes/funciones/bd_coneccion.php');

                $sql = "SELECT id_evento, nombre_evento, fecha_evento, hora_evento, cat_evento, icono, nombre_invitado, apellido_invitado ";
                $sql .= " FROM eventos ";
                $sql .= " INNER JOIN categoria_evento ";
                $sql .= " ON eventos.id_categoria = categoria_evento.id_categoria ";
                $sql .= " INNER JOIN invitados ";
                $sql .= " ON eventos.id_invitado = invitados.id_invitado";
                $sql .= " AND eventos.id_categoria = 1"; 
                $sql .= " ORDER BY id_evento LIMIT 2;";
                $sql .= "SELECT id_evento, nombre_evento, fecha_evento, hora_evento, cat_evento, icono, nombre_invitado, apellido_invitado ";
                $sql .= " FROM eventos ";
                $sql .= " INNER JOIN categoria_evento ";
                $sql .= " ON eventos.id_categoria = categoria_evento.id_categoria ";
                $sql .= " INNER JOIN invitados ";
                $sql .= " ON eventos.id_invitado = invitados.id_invitado";
                $sql .= " AND eventos.id_categoria = 2"; 
                $sql .= " ORDER BY id_evento LIMIT 2;";
                $sql .= "SELECT id_evento, nombre_evento, fecha_evento, hora_evento, cat_evento, icono, nombre_invitado, apellido_invitado ";
                $sql .= " FROM eventos ";
                $sql .= " INNER JOIN categoria_evento ";
                $sql .= " ON eventos.id_categoria = categoria_evento.id_categoria ";
                $sql .= " INNER JOIN invitados ";
                $sql .= " ON eventos.id_invitado = invitados.id_invitado";
                $sql .= " AND eventos.id_categoria = 3"; 
                $sql .= " ORDER BY id_evento LIMIT 2;";

            } catch (Exception $e){
                echo $e->getMessage();
            }
          ?>

          <?php 
            //Haciendo uso de métodos de MYSQLI multiquery.
            $coneccion->multi_query($sql);
          ?>
         
          <?php 
            do{
              $resultado = $coneccion->store_result(); 
              $row = $resultado->fetch_all(MYSQLI_ASSOC); ?>
              
              <?php $i = 0; ?>

              <?php foreach($row as $evento): //cambiamos el row a evento.?> <!--Inicio de foreach-->

                <?php if($i % 2 == 0){ //para que el div se abra en pares ?>
                    <div id="<?php echo strtolower($evento['cat_evento']); ?>" class="info-curso ocultar clearfix">
                <?php } ?>
                        <div class="detalle-evento">
                          <h3><?php echo html_entity_decode($evento['nombre_evento']); ?></h3>
                          <p><i class="fas fa-clock" aria-hidden="true"></i><?php echo $evento['hora_evento'];?></p>
                          <p><i class="fa fa-calendar" aria-hidden="true"></i><?php echo $evento['fecha_evento'];?></p>
                          <p><i class="fa fa-user" aria-hidden="true"></i><?php echo $evento['nombre_invitado'] . " "  . $evento['apellido_invitado'];?></p>
                        </div>

               
                <?php if($i % 2 == 1): //para que cierre en impares?>
                      <a href="calendario.php" class="button float-right">Ver todos</a>
                    </div>
                <?php endif; ?>
              
              <?php $i++;?>
              <?php endforeach; ?><!--Fin de foreach-->

              <?php $resultado->free(); //liberación de consulta multiquery?>

        <?php } while($coneccion->more_results() && $coneccion->next_result()); ?>

           
      </div><!--.programa evento-->
    </div><!--.contenedor-->
  </div><!--.contenido-programa-->
</section><!--.programa-->

    <!--invitados-->
    <?php include_once 'includes/templates/invitados.php';?>
    
    <div class="contador parallax">
      <div class="contenedor">
        <ul class="resumen-evento clearfix">
          <li><p class="numero"></p> Invitados</li>
          <li><p class="numero"></p> Talleres</li>
          <li><p class="numero"></p> Días</li>
          <li><p class="numero"></p> Conferencias</li>
        </ul><!--.resumen-evento-->
      </div><!--.contenedor-->
    </div><!--.parallax-->

    <div class="precios seccion">
      <h2>Precios</h2>
      <div class="contenedor">
        <ul class="lista-precios clearfix">
          <li>
            <div class="tabla-precio">
              <h3>Pase por día</h3>
              <p class="numero">$30</p>
              <ul>
                <li>Bocadillos Gratis</li>
                <li>Todas las conferencias</li>
                <li>Todos los talleres</li>
              </ul>
              <a href="#" class="button hollow">Comprar</a>
            </div>
          </li>

          <li>
            <div class="tabla-precio">
              <h3>Todos los días</h3>
              <p class="numero">$50</p>
              <ul>
                <li>Bocadillos Gratis</li>
                <li>Todas las conferencias</li>
                <li>Todos los talleres</li>
              </ul>
              <a href="#" class="button">Comprar</a>
            </div>
          </li>

          <li>
            <div class="tabla-precio">
              <h3>Pase por 2 días</h3>
              <p class="numero">$45</p>
              <ul>
                <li>Bocadillos Gratis</li>
                <li>Todas las conferencias</li>
                <li>Todos los talleres</li>
              </ul>
              <a href="#" class="button hollow">Comprar</a>
            </div>
          </li>
        </ul><!--.lista-precios-->
      </div><!--.contenedor-->
    </div><!--.precios-->

    <div id="mapa" class="mapa">

    </div><!--.mapa-->

    <section class="seccion">
      <h2>Testimoniales</h2>
      <div class="testimoniales contenedor clearfix">
        <div class="testimonial">
          <blockquote>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quibusdam voluptatibus inventore maxime a voluptas modi consequuntur? Placeat recusandae error ut dolor deleniti, odit saepe, quaerat rem quisquam ratione officia vel.</p>
            <footer class="info-testimonial clearfix">
              <img src="img/testimonial.jpg" alt="imagen testimonial">
              <cite>Oswaldo Aponte Escobedo <span>Diseñador en @prisma</span></cite>
            </footer>
          </blockquote>
        </div><!--.testimonial-->
        <div class="testimonial">
          <blockquote>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsam, minima. Fugiat corporis optio est tempora earum veritatis. Reprehenderit repellat, ut, expedita placeat esse quae tenetur vero incidunt explicabo, voluptatum perferendis?</p>
            <footer class="info-testimonial clearfix">
              <img src="img/testimonial.jpg" alt="imagen testimonial">
              <cite>Oswaldo Aponte Escobedo <span>Diseñador en @prisma</span></cite>
            </footer>
          </blockquote>
        </div><!--.testimonial-->
        <div class="testimonial">
          <blockquote>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Reiciendis harum animi ducimus quae eius cumque odit dolorem enim atque placeat, corporis id tenetur odio porro dolore, repellendus fugiat eos distinctio!</p>
            <footer class="info-testimonial clearfix">
              <img src="img/testimonial.jpg" alt="imagen testimonial">
              <cite>Oswaldo Aponte Escobedo <span>Diseñador en @prisma</span></cite>
            </footer>
          </blockquote>
        </div><!--.testimonial-->
      </div><!--.testimoniales-->
    </section><!--.seccion-->

    <div class="newsletter parallax">
      <div class="contenido contenedor">
        <p> Regístrate al newsletter:</p>
        <h3>brosmind</h3>
        <!--Integración de mailchimp embebed con botón-->
        <a href="#mc_embed_signup" class="boton_newsletter button transparente">Registro</a>
      </div><!--.contenido-->
    </div><!--.newsletter-->

    <section class="seccion">
      <h2>Faltan</h2>
      <div class="cuenta-regresiva contenedor">
        <ul class="clearfix">
          <li><p id="dias" class="numero"></p> dias</li>
          <li><p id="horas" class="numero"></p> horas</li>
          <li><p id="minutos" class="numero"></p> minutos</li>
          <li><p id="segundos" class="numero"></p> segundos</li>
        </ul>
      </div><!--.cuenta-regresiva-->
    </section><!--.seccion-->

<?php include_once 'includes/templates/footer.php'; ?>