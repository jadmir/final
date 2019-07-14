<?php 

    $coneccion = new mysqli('localhost', 'root', '', 'idat');

    if($coneccion->connect_error){
        echo $error -> $coneccion->connect_error;
    }

?>