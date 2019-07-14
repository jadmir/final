<?php 

include_once ('funciones/funciones.php');

$boletos_adquiridos = $_POST['boletos']; //leemos los boletos
$camisas  = $_POST['pedido_extra']['camisas']['cantidad'];
$etiquetas  = $_POST['pedido_extra']['etiquetas']['cantidad'];

$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$email = $_POST['email'];

// Función que convierte a json.
$pedido = productos_json($boletos_adquiridos, $camisas, $etiquetas);

$total = $_POST['total_pedido'];
$regalo = $_POST['regalo'];

$eventos = $_POST['registro_evento'];
$registros_eventos = eventos_json($eventos);


//Variables para actualizar.
$fecha_registro = $_POST['fecha_registro'];
$id_registro  = $_POST['id_registro']; 

//Código para insertar un nuevo registrado en la BD.
if($_POST['registro'] == "nuevo"){

    try {

        $stmt = $coneccion->prepare("INSERT INTO registrados (nombre_registrado, apellido_registrado, email_registrado, fecha_registro, pases_articulos, talleres_registrados, regalo, pagado, total_pagado) VALUES ( ?, ?, ?, NOW(), ?, ?, ?, 1, ? )");
        
        $stmt->bind_param("sssssis", $nombre, $apellidos, $email, $pedido, $registros_eventos, $regalo, $total);
        $stmt->execute();

        if($stmt->affected_rows){
            
            $respuesta = array(
                'mensaje' => 'correcto'
            );

        } else {
            $respuesta = array(
                'mensaje' => 'Ocurrió un error',
                'error' => error_get_last ( )
            );
        }

        $stmt->close();
        $coneccion->close();

    } catch(Exceptio $e){
        $respuesta = array(
                'mensaje' => $e->getMessage()
        );


    }

    die(json_encode($respuesta));
}








////Código para actualizar un registrado en la BD.
if($_POST['registro'] == "actualizar"){

    try {

        $stmt = $coneccion->prepare("UPDATE registrados SET nombre_registrado = ? , apellido_registrado = ?, email_registrado = ?, fecha_registro = ?, pases_articulos = ?, talleres_registrados = ?, regalo = ?, pagado = 1, total_pagado = ? WHERE id_registrado = ?");
        $stmt->bind_param("ssssssisi", $nombre, $apellidos, $email, $fecha_registro, $pedido, $registros_eventos, $regalo, $total, $id_registro );
        $stmt->execute();

        if($stmt->affected_rows){
            
            $respuesta = array(
                'mensaje' => 'correcto'
            );


        } else {

            $respuesta = array(
                'mensaje' => "Hubo un error"
            );
        }


        $stmt->close();
        $coneccion->close();

    } catch(Exceptio $e){

        $respuesta = array(
                'mensaje' => $e->getMessage()
        );


    }


    die(json_encode($respuesta));
}





///Código para eliminar un registrado en la BD.
/**************************************** */
if($_POST['registro'] == "eliminar" ){ //Si existe.

    $id = (int) $_POST['id'];

    try {
        
        $stmt = $coneccion->prepare(" DELETE FROM registrados WHERE id_registrado = ? ");
        $stmt->bind_param('i', $id);
        $stmt->execute();

        if($stmt->affected_rows){

            $respuesta = array(
                'mensaje' => 'correcto',
                'id_eliminado' => $id
            );

        } else{

            $respuesta = array(
                'mensaje' => 'Hubo un error'
            );
        }

        $stmt->close();
        $coneccion->close();

    } catch(Exception $e){

        $respuesta = array(
            'mensaje' => $e->getMessages()
        );

    }

    die(json_encode($respuesta));
}



?>