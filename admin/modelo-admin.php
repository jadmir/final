<?php

include_once ('funciones/funciones.php');


$usuario = $_POST['usuario'];
$nombre = $_POST['nombre'];
$contrasenia = $_POST['contrasenia'];
$id = $_POST['id_registro'];
$nivel = (int) $_POST['nivel'];

//Código para insertar administradores a la BD.
/**********************************************/
if($_POST['registro'] == "nuevo" ){ //Si existe.

    //Código para hashear la contraseña
    $opciones = array(
        'cost' => 12
    );
    $password_hashed = password_hash($contrasenia, PASSWORD_BCRYPT, $opciones);


    try {

      
            $stmt = $coneccion->prepare("INSERT INTO administradores(usuario, nombre, contrasenia, nivel) VALUES(?, ?, ?, ?)");
            $stmt->bind_param("sssi", $usuario, $nombre, $password_hashed, $nivel);
            $stmt->execute();
            
            $id_insertado = $stmt->insert_id;

            if($id_insertado > 0) {
            
                $respuesta = array(
                    'mensaje' => 'correcto',
                    'idInsertado' => $id_insertado,
                    'statemente' => $stmt
                );

            } else {
                
                $respuesta = array(
                    'mensaje' => 'Usuario ya existe, elija otro usuario.'
                );

            }

            $stmt->close();
            $coneccion->close();

    } catch(Exception $e){
        $respuesta = array(
            'mensaje' => 'Error!: ' . $e->getMessage()
        );
    }

    die(json_encode($respuesta));

}



//Código para login de los administradores
/*****************************************/
if($_POST['registro'] == "actualizar" ){ //Si existe.

    try {

        if(empty($contrasenia)){ //Valida si el campo CONTRASEÑA está vacío.
            //Si está vacío ACTUALIZAREMOS SOLAMENTE los  campos usuario y nombre.
            
            $stmt = $coneccion->prepare("UPDATE administradores SET usuario = ?, nombre = ?, editado = NOW() WHERE id = ? ");
            $stmt->bind_param("ssi", $usuario, $nombre, $id);

        } else {
            //Si el campo CONTRASEÑA tiene algo. ACTUALIZAREMOS TODOS LOS CAMPOS.

            $opciones = array(
                'cost' => 12
            );

            $hash_password = password_hash($contrasenia, PASSWORD_BCRYPT, $opciones);

            $stmt = $coneccion->prepare("UPDATE administradores SET usuario = ?, nombre = ?, contrasenia = ?, editado = NOW() WHERE id = ? ");
            $stmt->bind_param("sssi", $usuario, $nombre, $hash_password, $id);

        }

        $stmt->execute();

        if($stmt->affected_rows){
            $respuesta =  array(
                'mensaje' => 'correcto'
            );
        } else {
            $respuesta = array(
                'mensaje' => 'Ocurrió un error.'
            );
        }

        $stmt->close();
        $coneccion->close();

    } catch(Exception $e){
        $respuesta = array(
            'mensaje' => $e->getMessage()
        );
    }

    die(json_encode($respuesta));

   

}




//Código para eliminar un administradores
/*****************************************/
if($_POST['registro'] == "eliminar" ){ //Si existe.

    $id = (int) $_POST['id'];

    try {
        
        $stmt = $coneccion->prepare("DELETE FROM administradores WHERE id = ? ");
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


