<?php 

include_once ('funciones/funciones.php');

$idCategoria = $_POST['categoriaEvento'];
$fechaEvento = $_POST['fechaEvento'];
$horaEvento = $_POST['horaEvento'];
$idInvitado = $_POST['invitadoEvento'];
$nombreEvento = $_POST['nombreEvento'];

$idRegistro = $_POST['id_registro'];


//Opteniendo la fecha
$fechaFormateada = date('Y-m-d', strtotime($fechaEvento));


//Código para insertar un nuevo evento en la BD.
if($_POST['registro'] == "nuevo"){

    //Formatea la hora de 12 Horas a 24 horas.
    $hora_formateada = date('H:i', strtotime($horaEvento));

    try {

        $stm = $coneccion->prepare("INSERT INTO eventos (nombre_evento, fecha_evento, hora_evento, id_categoria, id_invitado)  VALUES (?,?,?,?,?)");
        $stm->bind_param("sssii", $nombreEvento, $fechaFormateada, $hora_formateada, $idCategoria, $idInvitado);
        $stm->execute();

        if($stm->affected_rows){
            
            $respuesta = array(
                'mensaje' => 'correcto'
            );

        } else {
            $respuesta = array(
                'mensaje' => 'Ocurrió un error'
            );
        }

        $stm->close();
        $coneccion->close();

    } catch(Exceptio $e){
        $respuesta = array(
                'mensaje' => $e->getMessage()
        );


    }


    die(json_encode($respuesta));
}



//Código para insertar un nuevo evento en la BD.
if($_POST['registro'] == "actualizar"){

    //Formatea la hora de 12 Horas a 24 horas.
    $hora_formateada = date('H:i', strtotime($horaEvento));

    try {

        $stmt = $coneccion->prepare("UPDATE eventos SET nombre_evento = ?, fecha_evento = ?, hora_evento = ?, id_categoria = ?, id_invitado = ?, editado = NOW() WHERE id_evento = ?");
        $stmt->bind_param("sssiii", $nombreEvento, $fechaFormateada, $hora_formateada, $idCategoria, $idInvitado, $idRegistro);
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





//Código para eliminar un evento de la BD.
/**************************************** */
if($_POST['registro'] == "eliminar" ){ //Si existe.

    $id = (int) $_POST['id'];

    try {
        
        $stmt = $coneccion->prepare("DELETE FROM eventos WHERE id_evento = ? ");
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