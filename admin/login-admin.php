<?php 

//Código para login de los administradores
/*****************************************/
if($_POST['login-admin']){
    
    $usuario = $_POST['usuario'];
    $contrasenia = $_POST['contrasenia'];
    
    try {

        include_once ('funciones/funciones.php');

        $stmt = $coneccion->prepare("SELECT * FROM administradores WHERE usuario = ?");
        $stmt->bind_param("s",$usuario);
        $stmt->execute();

         //Almacena el resultado de los campos consultados en el prepare
        $stmt->bind_result($id_admin, $usuario_admin, $nombre_admin, $contrasenia_admin, $editado_admin, $nivel_admin );

        if($stmt->affected_rows){

            $existe = $stmt->fetch(); //imprime los resultados y almacena en la variable.

            if($existe){ //Validamos si existe contenido de la variable.
                
                //Compara el password con el hash
                if(password_verify($contrasenia, $contrasenia_admin)){

                    //Si es correcto, iniciamos sesión.
                    session_start();
                    $_SESSION['usuario'] = $usuario_admin; //Añadimos datos a la sessión.
                    $_SESSION['nombre'] = $nombre_admin;
                    $_SESSION['id'] = $id_admin;
                    $_SESSION['nivel'] = $nivel_admin;

                    //Luego enviamos el array respuesta.
                    $respuesta = array(
                        'mensaje' => 'correcto',
                        'nombre' => $nombre_admin
                    );



                } else {

                    $respuesta = array(
                        'mensaje' => 'Usuario o contraseña incorrecto'
                    );

                }

            } else {
                $respuesta = array(
                    'mensaje' => 'Usuario o contraseña incorrecto'
                );
            }
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


?>