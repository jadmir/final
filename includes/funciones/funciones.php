<?php 

//Pasamos los pedidos a la función, por referencia. Para mantener los datos enviados.
function productos_json(&$boletos, &$camisas = 0 , &$etiquetas = 0){

    $dias = array(0 => 'un_dia', 
                  1 => 'pase_completo', 
                  2 => 'pase_2dias');

    unset($boletos['un_dia']['precio']); //Elimina un valor o variable, en este caso elimina el precio, para dejar solo cantidad
    unset($boletos['completo']['precio']); //Elimina un valor o variable, en este caso elimina el precio
    unset($boletos['dos_dias']['precio']); //Elimina un valor o variable, en este caso elimina el precio

    //combinando arrays.
    $total_boletos = array_combine($dias, $boletos);


    /** BOLETOS **/
    //Convierte array a json.
    /*$json = array();

    foreach($total_boletos as $key => $boletos): //accede a llaves y valor
        
        if( (int) $boletos > 0 ){ //convierte el valor de boletos String a Entero
            $json[$key] = (int) $boletos; //almacena el dato Entero
        }

    endforeach;*/

    /** CAMISAS **/
    //Convierte de String a Entero.
    $camisas = (int) $camisas;
    if($camisas > 0){
        $total_boletos['camisas'] = $camisas;
    }

    /** ETIQUETAS **/
    //Convierte de String a Entero.
    $etiquetas = (int) $etiquetas;
    if($etiquetas > 0){
        $total_boletos['etiquetas'] = $etiquetas;
    }

    return json_encode($total_boletos);

}


function eventos_json(&$eventos){
    $eventos_json = array();

    foreach($eventos as $evento): //Recorre el array eventos.
        $eventos_json['eventos'][] = $evento;
    endforeach;


    return json_encode($eventos_json);
}










?>