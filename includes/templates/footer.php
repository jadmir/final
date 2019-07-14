<footer class="site-footer">
      <div class="contenedor clearfix">
        <div class="footer-informacion">
          <h3>Sobre <span>Brosmind</span></h3>
          <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Adipisci consequatur ratione odio placeat accusantium incidunt, commodi id deleniti quibusdam cumque, quas optio alias aperiam animi exercitationem totam at esse officia.</p>
        </div>
        <div class="ultimos-tweets">
          <h3>últimos <span>twetts</span></h3>
          <ul>
            <li>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Sunt ad, eaque maxime et earum quae tempore minus enim voluptas cumque, animi quasi quidem voluptatem dignissimos ratione hic id voluptatum ut.</li>
            <li>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Porro explicabo numquam provident quisquam et neque? Natus provident, animi, molestias ea libero nobis corrupti nisi cupiditate at quae esse magnam perspiciatis!</li>
            <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis molestias incidunt distinctio modi nisi quidem perferendis accusantium quia quis quos amet eum, quasi aut, dolor odit harum, sit suscipit necessitatibus.</li>
          </ul>
        </div>
        <div class="menu">
          <h3>Redes <span>sociales</span></h3>
          <nav class="redes-sociales">
            <a href="#"><i class="fab fa-facebook" aria-hidden="true"></i></a>
            <a href="#"><i class="fab fa-twitter" aria-hidden="true"></i></a>
            <a href="#"><i class="fab fa-pinterest-p" aria-hidden="true"></i></a>
            <a href="#"><i class="fab fa-youtube" aria-hidden="true"></i></a>
            <a href="#"><i class="fab fa-instagram" aria-hidden="true"></i></a>
          </nav>
        </div>
      </div>

      <p class="copyright">
        Todos los derechos Reservados Brosmind 2019.
      </p>
    </footer>


    <!--Integración de mailchimp embebido-->
    <!-- Begin Mailchimp Signup Form -->
    <link href="//cdn-images.mailchimp.com/embedcode/classic-10_7.css" rel="stylesheet" type="text/css">
    <style type="text/css">
      #mc_embed_signup{background:#fff; clear:left; font:14px Helvetica,Arial,sans-serif; }
      /* Add your own Mailchimp form style overrides in your site stylesheet or in this style block.
        We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */
    </style>
    <div style="display:none;">
        <div id="mc_embed_signup">
        <form action="https://brazzinioc.us7.list-manage.com/subscribe/post?u=23c15f309fefcdc62c01c0cac&amp;id=67b0a6de93" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
            <div id="mc_embed_signup_scroll">
          <h2>Suscríbete a nuestro Newsletter</h2>
        <div class="indicates-required"><span class="asterisk">*</span> es obligatorio</div>
        <div class="mc-field-group">
          <label for="mce-EMAIL">Correo electrónico  <span class="asterisk">*</span>
        </label>
          <input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL">
        </div>
          <div id="mce-responses" class="clear">
            <div class="response" id="mce-error-response" style="display:none"></div>
            <div class="response" id="mce-success-response" style="display:none"></div>
          </div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
            <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_23c15f309fefcdc62c01c0cac_67b0a6de93" tabindex="-1" value=""></div>
            <div class="clear"><input type="submit" value="Suscribirse" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
            </div>
        </form>
        </div>
    </div>

    <!--End mc_embed_signup-->

  <script src="js/vendor/modernizr-3.6.0.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script>window.jQuery || document.write('<script src="js/vendor/jquery-3.3.1.min.js"><\/script>')</script>
  <script src="js/plugins.js"></script>
  <script src="js/jquery.animateNumber.min.js"></script>
  <script src="js/jquery.countdown.min.js"></script>
  <script src="js/jquery.lettering.js"></script>
  
  <?php 
    //Cargando archivos de acuerdo a la página abierta.
    $archivo = basename($_SERVER['PHP_SELF']);
    $pagina = str_replace(".php", "", $archivo);

    if($pagina == 'invitados' || $pagina == 'index'){
      echo '<script src="js/jquery.colorbox.js"></script>';
    } else if($pagina == 'conferencia') {
      echo '<script src="js/lightbox.js"></script>';
    }
  ?>

  
  <script src="https://unpkg.com/leaflet@1.3.3/dist/leaflet.js"></script>

  <script src="js/main.js"></script>

  <script src="js/map.js"></script>

  <script src="js/cotizador.js"></script>
  <!-- Google Analytics: change UA-XXXXX-Y to be your site's ID. -->
  <script>
    window.ga = function () { ga.q.push(arguments) }; ga.q = []; ga.l = +new Date;
    ga('create', 'UA-XXXXX-Y', 'auto'); ga('send', 'pageview')
  </script>
  <script src="https://www.google-analytics.com/analytics.js" async defer></script>

  <!--Integración de mailchimp-->
  <script type="text/javascript" src="//downloads.mailchimp.com/js/signup-forms/popup/unique-methods/embed.js" data-dojo-config="usePlainJson: true, isDebug: false"></script><script type="text/javascript">window.dojoRequire(["mojo/signup-forms/Loader"], function(L) { L.start({"baseUrl":"mc.us3.list-manage.com","uuid":"56da3a3166c4cb76da5053743","lid":"7e128e5c33","uniqueMethods":true}) })</script>

  <?php
	// Enviar al navegador
	ob_end_flush();
?>
</body>

</html>
