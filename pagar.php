<?php 
  
    if(!isset($_POST['submit'])){ //Validamos que venga enviado desde un submit. Negamos la existencia de submit.
        exit("Hubo unn error.");

    }

    
    //Importamos clases de Paypal. Ya que usan Name Space no es necesario poner la extensión.
    use PayPal\Api\Amount;
    use PayPal\Api\Details;
    use PayPal\Api\Item;
    use PayPal\Api\ItemList;
    use PayPal\Api\Payer;
    use PayPal\Api\Payment;
    use PayPal\Api\RedirectUrls;
    use PayPal\Api\Transaction;


    //Importamos archivo de configuración.
    require 'includes/paypal.php';



    //Código para validar el formulario de resgistro.
    /************************************************/
    //Valida que los datos , provengan luego de dar clic en pagar = submit.
    if(isset($_POST['submit'])):
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellidos'];
        $email = $_POST['email'];
        $regalo = $_POST['regalo'];
        $total = $_POST['total_pedido'];
        $fecha = date('Y-m-d H:i:s');
        //Pedidos.
        $boletos = $_POST['boletos'];
        $numeroBoletos = $boletos; //creamos una copia de boletos para extraer la cantidad.
        $pedidoExtra = $_POST['pedido_extra']; //Recibe los pedidos extra: Camisas y etiquetas.

        $camisas = $_POST['pedido_extra']['camisas']['cantidad'];
        $precioCamisas = $_POST['pedido_extra']['camisas']['precio'];

        $etiquetas = $_POST['pedido_extra']['etiquetas']['cantidad'];
        $precioEtiquetas = $_POST['pedido_extra']['etiquetas']['precio'];

        //Invocando la función para convertir a json.
        include_once 'includes/funciones/funciones.php'; //Importa el archivo funciones.php donde se encuentran las funciones para convertir a json
        $pedido = productos_json($boletos, $camisas, $etiquetas); //Almacenamos el json en variable
        //Eventos.
        $eventos = $_POST['registro'];
        $registro = eventos_json($eventos); //Almacenamos el json en variable
        

        try {
            require_once('includes/funciones/bd_coneccion.php');
             //Uso de prepare statement.
            if($stmt = $coneccion->prepare("INSERT INTO registrados (nombre_registrado, apellido_registrado, email_registrado, fecha_registro, pases_articulos, talleres_registrados, regalo, total_pagado) VALUES (?, ?, ?, ?, ?, ?, ?, ?)")) {
                $stmt->bind_param("ssssssis", $nombre, $apellido, $email, $fecha, $pedido, $registro, $regalo, $total);//Primero manda el tipos de dato, luego las variables que contienen los datos.
                $stmt->execute();
                $idRegistroInsertado = $stmt->insert_id;
                $stmt->close();
                $coneccion->close();
                //header('Location: validar_registro.php?exitoso=1'); //Redireccionamos la URL para no reinsertar datos en la BD
            } else {
                $error = $coneccion->errno . ' ' . $coneccion->error;
                echo $error;  
            }
        } catch (Exception $e){
            echo $e->getMessage();
        }

    endif; //Fin de IF.
   




    /*Código para pago con Payapal
    ******************************/
    $compra = new Payer(); //Creamos Instancia.Alguien que paga.
    $compra->setPaymentMethod('paypal');   //agregamos atributos.
  
    $articulo = new Item();
    $articulo->setName($producto)  //Añadimos el producto.
            ->setCurrency('MXN') //Añadimos tipo de Moneda.
            ->setQuantity(1) //Añadimos cantidad.
            ->setPrice($precio); //Añadimos precio.

    //Recorremos el arreglo de boletos para extraer la cantidad de los mismos.
    $i = 0;
    $arregloPedidos = array();
    foreach($numeroBoletos as $key => $value){
        if((int)$value['cantidad'] > 0){ //validamos que la cantidad de boletos sea mayor a cero.
            ${"articulo$i"} = new Item();
            $arregloPedidos[] = ${"articulo$i"}; //Añadimos el artículo creado a la última posición del arreglo
            ${"articulo$i"}->setName('Pase: ' . $key)  //Añadimos el producto.
                            ->setCurrency('USD') //Añadimos tipo de Moneda.
                            ->setQuantity( (int) $value['cantidad'] ) //Añadimos cantidad.
                            ->setPrice( (int) $value['precio'] ); //Añadimos precio.
            $i++;
        }

    }


    //Recorremos el arreglo de pedidos extra para extraer la cantidad de los mismos.
    foreach($pedidoExtra as $key => $value){
        if((int)$value['cantidad'] > 0){ //validamos que la cantidad de boletos sea mayor a cero.

            //Aplicamos descuento en camisas.
            if($key == 'camisas'){
                $precio = (float) $value['precio'] * .93; //Descuento del 7%.
            } else {
                $precio = (int) $value['precio'];
            }

            ${"articulo$i"} = new Item();
            $arregloPedidos[] = ${"articulo$i"}; //Añadimos el artículo creado a la última posición del arreglo.
            ${"articulo$i"}->setName('Extras: ' . $key)  //Añadimos el producto.
                            ->setCurrency('USD') //Añadimos tipo de Moneda.
                            ->setQuantity( (int) $value['cantidad'] ) //Añadimos cantidad.
                            ->setPrice( $precio ); //Añadimos precio.
            $i++;
        }
    }
    

    $listaArticulos = new ItemList();
    $listaArticulos->setItems($arregloPedidos); //Añadimos los articulos en forma de Array.

    
    $cantidad = new Amount();
    $cantidad->setCurrency('USD') //Añadimos tipo de moneda
            ->setTotal($total); //Añadimos precio total

    
    $transaccion = new Transaction(); //Creamos una transacción.
    $transaccion->setAmount($cantidad) //Añadimo cantidad a pagar.
        ->setItemList($listaArticulos) //Añadimos lista de artículos.
        ->setDescription("Pago GDLWEBCAMP") //Añadimos una descripción.
        ->setInvoiceNumber($idRegistroInsertado); //Mandamos el ID del registro de la BD.


    $redireccionar = new RedirectUrls();
    $redireccionar->setReturnUrl(URL_SITIO . "/pago_finalizado.php?exito=true&id_pago={$idRegistroInsertado}")//Cuando termine de pagar, se redirigirá al php file.
                ->setCancelUrl(URL_SITIO . "/pago_finalizado.php?exito=false&id_pago={$idRegistroInsertado}");//Cuando por algún motivo el usuario cancela el pago.

    
    $pago = new Payment();//Permite crear procesar y manejar los pagos.
    $pago->setIntent('sale') //Intento de venta.
        ->setPayer($compra) //Fuente  de toda la compra.
        ->setRedirectUrls($redireccionar)
        ->setTransactions(array($transaccion));

        
    
    try {
        $pago->create($apiContext);
    }catch(Paypal\Exception\PayPalConnectionException $pce){
        echo "<pre>";
        print_r(json_decode($pce->getData()));
        exit; //Permite  que el programa deje de ejecutarse.
        echo "</pre>";
    }

    $aprobado = $pago->getApprovalLink(); //Link de aprovación.
    header("Location: {$aprobado}");
    

?>