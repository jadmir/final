<?php 

include_once ('funciones/funciones.php');

$nombreCategoria = $_POST['nombreCategoria'];
$iconoCategoria = $_POST['iconoCategoria'];
$idCategoria = $_POST['id_registro'];

//Código para insertar una nueva categoria evento en la BD.
if($_POST['registro'] == "nuevo"){

    try {

        $stmt = $coneccion->prepare("INSERT INTO categoria_evento (cat_evento, icono) VALUES (?, ?)");
        $stmt->bind_param("ss", $nombreCategoria, $iconoCategoria);
        $stmt->execute();

        if($stm->affected_rows){
            
            $respuesta = array(
                'mensaje' => 'correcto'
            );

        } else {
            $respuesta = array(
                'mensaje' => 'Ocurrió un error'
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


//Código para actualizar una categoria en la BD.
if($_POST['registro'] == "actualizar"){


    try {

        $stmt = $coneccion->prepare("UPDATE categoria_evento SET cat_evento = ?, icono = ?, editado = NOW() WHERE id_categoria = ?");
        $stmt->bind_param("ssi", $nombreCategoria, $iconoCategoria, $idCategoria);
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





//Código para eliminar una categoria de la BD.
/**************************************** */
if($_POST['registro'] == "eliminar" ){ //Si existe.

    $id = (int) $_POST['id'];

    try {
        
        $stmt = $coneccion->prepare(" DELETE FROM categoria_evento WHERE id_categoria = ? ");
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