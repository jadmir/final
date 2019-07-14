//Archivo JS para controlar el FRONT del sitio.


$(document).ready(function () {
    $('.sidebar-menu').tree()


  //Cambio de Idioma y envío de algunos parametros a plugin DataTables.
    $('#registros').DataTable({
      'paging'      : true, //Conpagina
      'pageLength'  : 6, //conpagina a partir de 6 registros.
      'lengthChange': false, //
      'searching'   : true, //buscador
      'ordering'    : true, //ordenar
      'info'        : true, 
      'autoWidth'   : false, //adaptabilidad
      'language'    :{
        paginate: {
            next: 'Siguiente',
            previous: 'Anterior',
            last: 'Último',
            first: 'Primero'
        },
        info: 'Mostrando _START_ a _END_ de _TOTAL_ resultados', 
        emptyTable: 'No hay registros',
        infoEmpty: '0 Registros',
        search: 'Buscar'
      }
    });





    //Deshabilita el botón Añadir en CREAR ADMINISTRADOR.
    $('#crear_registro_admin').attr('disabled', true);


    //Código para validar la SIMILITUD de contraseñas al crear un usuario administrador.
    $('#repetir_contrasenia').on('input', function(){
        var contrasenia_nuevo  = $('#contrasenia').val(); //Accede al valor del input.

        if($(this).val() === contrasenia_nuevo){
          $('#resultado_contrasenia').text('Correcto'); //Anade texto al spam
          $('#resultado_contrasenia').parents('.form-group').addClass('has-success').removeClass('has-error'); //Traversing desde el spam al div FORM GROUP. añade clases y remueve
          $('input#contrasenia').parents('.form-group').addClass('has-success').removeClass('has-error');// Añade clases al input contraseña
          $('#crear_registro_admin').attr('disabled', false); //Deshace la deshabilitación del botón.
        } else {
          $('#resultado_contrasenia').text('No son iguales');
          $('#resultado_contrasenia').parents('.form-group').addClass('has-error').removeClass('has-success'); //Traversing desde el spam al div FORM GROUP. añade clases y remueve
          $('input#contrasenia').parents('.form-group').addClass('has-error').removeClass('has-success');// Añade clases al input contraseña
          $('#crear_registro_admin').attr('disabled', true);
        }

    });


    //Código para mostrar mensaje cuando se seleccione el nivel de usuario administrador.
    $('#nivel').change(function(){
      $('#resultado_nivel_usuario').text("");
      var nivel_usuario = parseInt($('#nivel').val());
      
      console.log("valor de nivel: " + nivel_usuario);
      if(nivel_usuario === 0){
        $('#resultado_nivel_usuario').text("Este usuario no podrá crear usuarios administradores.")
        $('#resultado_nivel_usuario').parents('.form-group').addClass('has-success').removeClass('has-error');
      } else {
        $('#resultado_nivel_usuario').text("Este usuario podrá crear usuarios administradores.")
        $('#resultado_nivel_usuario').parents('.form-group').addClass('has-error').removeClass('has-success');
      }

    });




    //Código para inicializar la libreria de calendario. Para campos date.
    $('#datepicker').datepicker({
      autoclose: true
    });



    //Código para inicializar la libreria de select. 
    $('.select2').select2();


    // Código para inicializar Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    });

    //Código para inicializar Selector de íconos font-awesome
    $('#iconoCategoria').iconpicker();



    //Flat blue color for iCheck
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_flat-blue',
      radioClass   : 'iradio_flat-blue'
    })



    // Gráfica de usuario registrados por fecha usando morris(LINE CHART).
    // Usamos un servicio para obtener el json de usuarios registrados en la BD.
    $.getJSON('servicio-registrados.php', function(data){

        var line = new Morris.Line({
          element: 'grafica-registrados',
          resize: true,
          data: data,
          xkey: 'fecha',
          ykeys: ['cantidad'],
          labels: ['Item 1'],
          lineColors: ['#3c8dbc'],
          hideHover: 'auto'
        });

    });



});