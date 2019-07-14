<?php 

include_once ('funciones/funciones.php');

$nombreInvitado  = $_POST['nombreInvitado'];
$apellidoInvitado = $_POST['apellidoInvitado'];
$descripcionInvitado = $_POST['descripcionInvitado'];

$idInvitado = $_POST['id_registro'];


//Código para insertar un nuevo invitado en la BD.
if($_POST['registro'] == "nuevo"){

    /*
    VARAIBLES GLOBALES PARA REVISAR archivos y campos
    $respuesta = array(
        'post' => $_POST,
        'file' => $_FILES
    ); */

    $directorio = "../img/invitados/"; //variable de ruta del directorio. Salimos de admin directory luego vamos a img

    //Revisamos si la carpeta existe. Sino existe lo crea y da los permisos.
    if(!is_dir($directorio)){
        mkdir($directorio, 0755, true); //crea carpeta , da permiso 0755:permiso para ser vistos por visitantes pero no manipulados. True: es recursivo, hace que todos los archivos tengan los mismos permisos.
    }

    //Mueve el archivo subido, de la ubicación temp a la carpeta que final que deseamos.
    if( move_uploaded_file($_FILES['imagenInvitado']['tmp_name'] , $directorio . $_FILES['imagenInvitado']['name'] ) ) {
        
        $urlImagen = $_FILES['imagenInvitado']['name'];
        $imagenResultado = "Se subió correctamente";

    } else {

        $respuesta = array(
            'respuesta' => error_get_last() //Función para imprimir el último error registrado por PHP
        );

    }


    try {

        $stmt = $coneccion->prepare("INSERT INTO invitados (nombre_invitado, apellido_invitado, descripcion, url_imagen) VALUES (?,?,?,?)");
        $stmt->bind_param("ssss", $nombreInvitado, $apellidoInvitado, $descripcionInvitado, $urlImagen);
        $stmt->execute();
        $id_insertado = $stmt->insert_id;
        if($stmt->affected_rows){
            
            $respuesta = array(
                'mensaje' => 'correcto',
                'idInsertado' => $id_insertado,
                'resultadoSubida' => $imagenResultado
            );

        } else {

            $respuesta = array(
                'mensaje' => 'Ocurrió un error'
            );
        }

        $stmt->close();
        $coneccion->close();

    } catch(Exception $e){

        $respuesta = array(
            'mensaje' => $e->getMessage()
        );

    }


    die( json_encode($respuesta) );
}



//Código para ACTUALIZAR un invitado en la BD.
if($_POST['registro'] == "actualizar"){

    $directorio = "../img/invitados/"; //variable de ruta del directorio. Salimos de admin directory luego vamos a img

    //Revisamos si la carpeta existe. Sino existe lo crea y da los permisos.
    if(!is_dir($directorio)){
        mkdir($directorio, 0755, true); //crea carpeta , da permiso 0755:permiso para ser vistos por visitantes pero no manipulados. True: es recursivo, hace que todos los archivos tengan los mismos permisos.
    }

    //Mueve el archivo subido, de la ubicación temp a la carpeta que final que deseamos.
    if( move_uploaded_file($_FILES['imagenInvitado']['tmp_name'] , $directorio . $_FILES['imagenInvitado']['name'] ) ) {
        
        $urlImagen = $_FILES['imagenInvitado']['name'];
        $imagenResultado = "Se subió correctamente";

    } else {

        $respuesta = array(
            'respuesta' => error_get_last() //Función para imprimir el último error registrado por PHP
        );

    }

    try {

        //Validaremos si el usuario subió un archivo. Para ello usaremos el tamaño para verificar.
        if($_FILES['imagenInvitado']['size'] > 0){ //Si el tamaño del archivo es mayor a cero, es que el usuario subió un archivo.

            //Con imagen
            $stmt = $coneccion->prepare("UPDATE invitados SET nombre_invitado = ?, apellido_invitado = ?, descripcion = ?, url_imagen = ?, editado = NOW() WHERE id_invitado = ?");
            $stmt->bind_param("ssssi", $nombreInvitado, $apellidoInvitado, $descripcionInvitado, $urlImagen, $idInvitado);

        } else {
            //Sin imagen
            $stmt = $coneccion->prepare("UPDATE invitados SET nombre_invitado = ?, apellido_invitado = ?, descripcion = ?, editado = NOW() WHERE id_invitado = ?");
            $stmt->bind_param("sssi", $nombreInvitado, $apellidoInvitado, $descripcionInvitado, $idInvitado);
        }

        $stmt->execute();
        $id_insertado = $stmt->insert_id;
        if($stmt->affected_rows){
            
            $respuesta = array(
                'mensaje' => 'correcto',
                'idInsertado' => $id_insertado,
                'resultadoSubida' => $imagenResultado
            );

        } else {

            $respuesta = array(
                'mensaje' => 'Ocurrió un error'
            );
        }

        $stmt->close();
        $coneccion->close();

    } catch(Exception $e){

        $respuesta = array(
            'mensaje' => $e->getMessage()
        );

    }


    die( json_encode($respuesta) );
}




//Código para eliminar un invitado de la BD.
/**************************************** */
if($_POST['registro'] == "eliminar" ){ //Si existe.

    $id = (int) $_POST['id'];

    try {
        
        $stmt = $coneccion->prepare("DELETE FROM invitados WHERE id_invitado = ? ");
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