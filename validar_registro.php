
<?php include_once 'includes/templates/header.php';?>
<section class="seccion contenedor">
    <h2>Resumen registro</h2>
    <?php 
        if(isset($_GET['exitoso'])){ //Usamos la redirección de URL de la línea 28.
            if($_GET['exitoso'] == "1"){ //Evalua que sea igual a 1
                echo '<p style="color: #fe4918; font-weight:bold;">Registro exitoso</p>';
            }
        }
    ?>
</section>

<?php include_once 'includes/templates/footer.php';?>