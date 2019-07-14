$(document).ready(function(){

    //Extrae el formulario de crear administrador y evita que se abra el action
    $('#guardar-registro').on('submit', function(e){
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
                console.log(respuesta);
                if(respuesta['mensaje'] === 'correcto'){
                    swal("Correcto!", "Se guardó correctamente.", "success");
                    //$('#guardar-registro')[0].reset(); //limpia los campos del formulario.
                } else {
                    swal("Error!", respuesta['mensaje'], "error");
                
                }
                

            }
        
        });
    });



    //Cogido que se ejecuta cuando en el form tenemos un campo de archivo
    //Por ejemplo en el form de crear un invitado.
      $('#guardar-registro-archivo').on('submit', function(e){
        e.preventDefault(); 

        //obtener datos, this se refiere a la ejecución del submit. 
        var datos = new FormData(this); //Creamos una instancia de FormData.

        //Llamado a AJAX con JQUERY
        $.ajax({
            type: $(this).attr('method'), //Type: POST o GET. Extrae el método del form.
            data: datos, //datos de los campos del form
            url: $(this).attr('action'), //Los datos se envian al valor de action. Al archivo PHP
            dataType: 'json', //Tipo de datos
            //campos extras siempre y cuando se use campos archivos en el FORM
            contentType: false,
            processData: false, //Imágenes procesadas
            async: true,
            cache: false, //para que no cacheé la URL al que se envia la img
            success: function(data){ //Cuando la llamada sea exitoso.
                
                var respuesta = data;

                console.log(respuesta);

                if(respuesta['mensaje'] === 'correcto'){
                    swal("Correcto!", "Se guardó correctamente.", "success");
                    //$('#guardar-registro')[0].reset(); //limpia los campos del formulario.
                } else {
                    swal("Error!", respuesta['mensaje'], "error");
                
                }
                

            }
        
        });
    });





//Codigo para eliminar un administrador en la BD
/*********************************************/
    $('.borrar_registro').on('click', function(e){
        
        e.preventDefault();

        var id = $(this).attr('data-id');
        var tipo = $(this).attr('data-tipo'); 

        //Mandamos una alerta de confirmación  para ELIMINAR el registro.
        swal({
            title: 'Estás Seguro?',
            text: "Esto no se puede deshacer!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, borrar!!',
            cancelButtonText: 'No, Cancelar',
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger',
            //buttonsStyling: false,
            reverseButtons: true
          }).then((result) => {

            if (result.value) {

                //Llamado a AJAX con JQUERY.
                $.ajax({
                    type: 'post',
                    data: { //Hacemo un objeto de todos los datos que deseamos enviar.
                        'id': id,
                        'registro': 'eliminar'
                    },
                    url: 'modelo-'+ tipo + '.php', //Arma en 
                    success: function(data){
                      
                        var resultado = JSON.parse(data); //Convierte el String enviado por el modelo a JSON.

                        if(resultado.mensaje === 'correcto'){
                            
                            swal("Eliminado", "Registro eliminado", "success");
                            jQuery('[data-id="'+ resultado.id_eliminado +'"]').parents('tr').remove(); //Seleciona el registro del data table luego va al padre y lo elimina del DOM

                        } else {

                            swal("Error", "NO se pudo eliminar", "error");

                        }
                       
                        

                    }

                }); //Fin AJAX
            } else if (result.dismiss === 'cancel') {
              swal(
                'Cancelado',
                'No se eliminó el registro',
                'error'
              )
            }

        });

        
    });



});