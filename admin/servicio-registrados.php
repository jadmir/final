<?php 
  include_once ('funciones/sesiones.php');
  
  include_once ('funciones/funciones.php');


    $sql = "SELECT fecha_registro , COUNT(*) AS resultado FROM registrados GROUP BY DATE(fecha_registro) ORDER BY fecha_registro";
    $resultado = $coneccion->query($sql);

    $arreglo_registros =  array();

    while($registro_dia = $resultado->fetch_assoc()){
        $fecha = $registro_dia['fecha_registro']; //Almacenamos el valor del campo fecha_registro
        $registro['fecha'] = date('Y-m-d', strtotime($fecha)); //Quitamos la hora y minutos del campo fecha_registro.
        $registro['cantidad'] = $registro_dia['resultado']; //Generamos un array con la clave cantidad, asignamos el valor contado.

        $arreglo_registros[] = $registro; //Añadimos el arreglo creado al arreglo padre,
    }

    echo json_encode($arreglo_registros);
?>