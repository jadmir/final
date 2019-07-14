$(document).ready(function() { 

    //Extrae el formulario de login de administrador y evita que se abra el action
    $('#login-admin').on('submit', function(e){
        e.preventDefault();

        //obtener datos, this se refiere a la ejecución del submit. SerializeArray itera todos los 
        //campos del formulario, luego crea un objeto.
        var datos = $(this).serializeArray();

        //Llamado a AJAX con JQUERY
        $.ajax({
            type: $(this).attr('method'), //Type: POST o GET. Extrae el método del form.
            data: datos, //datos de los campos del form
            url: $(this).attr('action'), //Los datos se envian al valor de action. Al archivo PHP
            dataType: 'json', //Tipo de datos
            success: function(data){ //Cuando la llamada sea exitoso.
                
                var respuesta = data;

                //console.log(respuesta);

                if(respuesta['mensaje'] === 'correcto'){
                    swal("Login correcto", "Bienvenido(a) " + respuesta['nombre'] , "success")
                    .then((value) => {
                        //Luego de 2 segundos redirige al admin-area.php.
                        setTimeout(function(){
                            window.location.href = "admin-area.php";
                        }, 1000);
                    });
                    
                    

                } else {
                    swal("Error!", respuesta['mensaje'], "error");
                }
            }
        
        });
    });

});
