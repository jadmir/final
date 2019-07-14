
<?php include_once 'includes/templates/header.php';

use PayPal\Rest\ApiContext;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Payment;

require 'includes/paypal.php';

?>

<section class="seccion contenedor">
    <h2>Resumen registro</h2>
    <?php 

        /* Código para validar la transacció en PayPal
        **********************************************/
        $paymentID = $_GET['paymentId'];
        $token = $_GET['token'];
        $payerID = $_GET['PayerID'];
        $id_pago = (int) $_GET['id_pago']; //Extraemos el ID del registro en la BD, para actualizar el estado de pagado.

        //Petición a REST API de PayPal.
        $pago = Payment::get($paymentID, $apiContext); //No instanciamos, pero con :: accedemos a sus métodos.
        $execution = new PaymentExecution();
        $execution->setPayerId( $payerID ); //Enviamos el ID del pagador.

        //Resultado tiene la información de la transacción.
        $resultado = $pago->execute($execution, $apiContext);


        /*echo "<pre>";
            //print_r($resultado);
        echo "</pre>";*/

        //Extrae el estado de la transacción.
        $respuesta = $resultado->transactions[0]->related_resources[0]->sale->state;

                if($respuesta== 'completed'){
                    
                    echo '<div class="resultado correcto">';
                        echo "<p>pago realizado correctamente.</p>";
                        echo "<p> El ID del pago es: " . $payerID . "</p>";
                    echo "</div>";


                    //Una vez hecho el pago. Modificaremos el estado del campo "pagado" en registrados.
                    include_once('includes/funciones/bd_coneccion.php');
                    $stmt = $coneccion->prepare("UPDATE `registrados` SET `pagado` = ? WHERE `id_registrado` = ?");
                    $pagado = 1;
                    $stmt->bind_param('ii', $pagado, $id_pago);
                    $stmt->execute();
                    

                    $stmt->close();
                    $coneccion->close();


                } else {
                    echo '<div class="resultado error">';
                        echo "<p>El pago no se realizó.</p>";
                    echo "</div>";
                }

    ?>
    
</section>

<?php include_once 'includes/templates/footer.php';?>