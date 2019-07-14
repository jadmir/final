(function(){
    'use strict';
    document.addEventListener('DOMContentLoaded', function(){
    /* Integración de Colorbox
    ***************************/
    //Para visualizar fotos + biografía del invitado.
    if(document.getElementById("invitados")){
        $('.invitado-info').colorbox({inline:true, width:"50%"});
        console.log("encontramos id invitados");
    }

    /* Script para mostrar en qué página se encuentra el usuario
    ************************************************************/
    $('body.conferencia .navegacion-principal a:contains("Conferencia")').addClass('activo');
    $('body.calendario .navegacion-principal a:contains("Calendario")').addClass('activo');
    $('body.invitados .navegacion-principal a:contains("Invitados")').addClass('activo');


    /* Integración de Colorbox + Mailchimp
    **************************************/
    //Para visualizar el formulario de suscripción al neswletter.
    $('.boton_newsletter').colorbox({inline:true, width:"50%"});
    console.log("Encontramos botón newsletter");


}); //DOMContentLoaded
})();

// Integración de Lettering.
$(function(){
   $('.nombre-sitio').lettering();
   
});

// Función para programa de Conferencias(Evento, Seminario y Conferencia).
$(function(){
 
    $('.programa-evento .info-curso:first').show(); //Mostramos solo el primer evento
    $('.menu-programa a:first').addClass('activo'); //Antes del clicl agregamos activo a todos los a del menú

    $('.menu-programa a').on('click', function(){ //Cuando se haga clic en el menú de programas.
        $('.menu-programa a').removeClass('activo'); // Eliminamos la clase activo de todas las anclas.
        $(this).addClass('activo'); //Adicionamos la clase Activo en el anlace clicquead

        var enlace = $(this).attr('href'); //Extreamos  el link de cada ancla (Enlaces de menú.)
        $('.ocultar').hide();
        $(enlace).fadeIn(1000);

        return false; //Desactivamos el brinco brusco al hacer clic
    });
});

// Integración de AnimateNumber (Cantidad de invitados, Talleres,etc.)
$('.resumen-evento li:nth-child(1) p').animateNumber({number: 6}, 1200); //Numer {6} y tiempo (1200miliseg.).
$('.resumen-evento li:nth-child(2) p').animateNumber({number: 15}, 1200);
$('.resumen-evento li:nth-child(3) p').animateNumber({number: 3}, 1100);
$('.resumen-evento li:nth-child(4) p').animateNumber({number: 9}, 1200);

//Integración de CountDown (Cuenta regresiva para el evento.)
$('.cuenta-regresiva').countdown('2050/01/01 12:00:00',function(event){
    $('#dias').html(event.strftime('%D')); //Para días.
    $('#horas').html(event.strftime('%H')); //Para horas.
    $("#minutos").html(event.strftime('%M')); // Para minutos
    $('#segundos').html(event.strftime('%S')); // Para segundos.


/* Funciones para Páginas Internas */

/* CONFERENCIAS */
/****************/

/*Scrooll - Menú fijo*/
$(function(){
    var windowHeight = $(window).height(); //Altura de ventana
    var barraAltura = $('.barra').innerHeight(); //Altura de la barra de Navegación.

    $(window).scroll(function(){
        var scroll = $(window).scrollTop();
        if(scroll > windowHeight){
            $('.barra').addClass('fixed');
            $('body').css({'margin-top' : barraAltura + 'px'}); /*Evitamos el brinco hacia abajo,agregano altura de barra en px */
        }else {
            $('.barra').removeClass('fixed');
            $('body').css({'margin-top' : 0 + 'px'}); /*Evitamos el brinco hacia arriba,agregano altura de barra en px */
        }
    });

});

/*Menú Responsive - Móvil */
/*************************/
$(function(){
    var i = 0;    
    $('.menu-movil').on('click', function(){
        $('nav.navegacion-principal').slideToggle();        
        i += 1;
        console.log(i);
    });

});





















});