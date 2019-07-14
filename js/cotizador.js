(function(){
    'use strict';
    
    var regalo = document.getElementById('regalo');

    document.addEventListener('DOMContentLoaded', function(){
        console.log("Listo");

        //Campos datos usuarios.
        var nombre = document.getElementById('nombre');
        var apellidos = document.getElementById('apellidos');
        var email = document.getElementById('email');
    
        //Campos pases.
        var pase_dia = document.getElementById("pase_dia");
        var pase_dosdias = document.getElementById("pase_dosdias");
        var pase_completo = document.getElementById("pase_completo");

        //Botones y Divs
        var calcular = document.getElementById("calcular");
        var errorDiv = document.getElementById("error");
        var botonRegistro = document.getElementById("btnRegistro");
        var lista_productos = document.getElementById("lista-productos");
        var suma = document.getElementById("suma-total");

        //Extras.
        var camisas = document.getElementById("camisa_evento");
        var etiquetas = document.getElementById("etiquetas");

        //Script para manejar la activación y desactivación de boton registro.
        if(document.getElementById('registro') || document.getElementById('guardar-registro')){
            botonRegistro.disabled = true; //botón registro deshabilitado.
        }
    


        //Script para el btnCalcular
        //==========================
        if(calcular){ //validamos que el botón calcular exista
            calcular.addEventListener('click', calcularMontos);
        }
        
        function calcularMontos(event){
            event.preventDefault();
            if(regalo.value === ""){ /*Validamos el campo regalo.*/
                alert("Debes elegir un regalo.")
                regalo.focus(); /*Enfoca regalo.*/
            }else {
                //Variables con data del numero de boletos.(ParseInt para convertir a numeros, 10 a base 10 sino a 0)
                var cntBoletosDia = parseInt(pase_dia.value, 10) || 0,
                    cntBoletos2Dias = parseInt(pase_dosdias.value, 10) || 0,
                    cntBoletosCompleto = parseInt(pase_completo.value, 10) || 0,
                    cntCamisas = parseInt(camisas.value, 10) || 0,
                    cntEtiquetas = parseInt(etiquetas.value, 10) || 0;
                
                //Cálculo del precio a pagar.
                var totalPagar = (cntBoletosDia * 30 ) + (cntBoletos2Dias * 45) + (cntBoletosCompleto * 50) + ((cntCamisas*10)*0.93) + (cntEtiquetas*2);
                
                //Resumen de productos.
                var listadoProductos = [];

                if(cntBoletosDia >= 1 ){ //Validamos que como min se ingrese 1
                    listadoProductos.push(cntBoletosDia + " pases por 1 día.");
                }

                if( cntBoletos2Dias >= 1 ){//Validamos que como min se ingrese 1
                    listadoProductos.push(cntBoletos2Dias + " pases por 2 días.");
                }
                
                if(cntBoletosCompleto >=1 ){//Validamos que como min se ingrese 1
                    listadoProductos.push(cntBoletosCompleto + " pases completos.");
                }
                if(cntCamisas >=1 ){
                    listadoProductos.push(cntCamisas + " camisas");
                }
                if(cntEtiquetas >= 1){
                    listadoProductos.push(cntEtiquetas + " paq. de etiquetas.");
                }

                //Script para mostrar en total de productos.
                lista_productos.style.display = "block"; //Para mostrar con js
                lista_productos.innerHTML = '';
                for(var i=0; i < listadoProductos.length; i++){
                    lista_productos.innerHTML += listadoProductos[i] + '</br>';
                }

            }//Else

            //Script para mostrar el total a pagar.
            suma.innerHTML = "$ " + totalPagar.toFixed(2);

            //Script para manejar la activación y desactivación de boton registro.
            botonRegistro.disabled = false; //botón registro Habilitado.
            document.getElementById('total_pedido').value = totalPagar;

        }//funcion calcularMontos.


        //Script para mostrar los días.
        //============================
        if(document.getElementById('registro') || document.getElementById('guardar-registro')){ //Inicio validación de formulario registro
            pase_dia.addEventListener('change', mostrarDias);
            pase_dosdias.addEventListener('change', mostrarDias);
            pase_completo.addEventListener('change', mostrarDias);
        
            //Funcion mostrarDias()
            function mostrarDias(){
                //Variables con la data de dias ingresados.
                var cntBoletosDia = parseInt(pase_dia.value, 10) || 0,
                    cntBoletos2Dias = parseInt(pase_dosdias.value, 10) || 0,
                    cntBoletosCompleto = parseInt(pase_completo.value, 10) || 0;

                var diasElegidos = [];

                if(cntBoletosDia > 0 ){
                    diasElegidos.push('viernes');//Agregamos el div de viernes al array.
                }else{
                    document.getElementById('viernes').style.display = 'none';
                }

                if(cntBoletos2Dias > 0 ){
                    diasElegidos.push('viernes', 'sabado');
                }else {
                    document.getElementById('viernes').style.display = 'none';
                    document.getElementById('sabado').style.display = 'none';
                }

                if(cntBoletosCompleto > 0){
                    diasElegidos.push('viernes', 'sabado', 'domingo');
                }else {
                    document.getElementById('viernes').style.display = 'none';
                    document.getElementById('sabado').style.display = 'none';
                    document.getElementById('domingo').style.display = 'none';
                }

                //Recorriendo el array de días elegidos.
                for( var i=0; i < diasElegidos.length; i++){
                    //Obtenemos el id de cada div, selecionamos con getElementById
                    document.getElementById(diasElegidos[i]).style.display = "block";
                }
            } //Mostrar días.

            //Código paraa mostrar los eventos cuando se edite un registrado en el panel de administrador.
            var formularioEditar = document.getElementsByClassName('editar-registrado');
            if(formularioEditar.length >  0){
                //Validación para mostrar los eventos cuando se edite el panel de administrador.
                if(pase_dia.value || pase_dosdias.value || pase_completo.value){
                    mostrarDias();
                }
            }

            //Funcion para validar campos de datos personales.
            //Para campo Nombre.
            function validarCampos(){
                if(this.value === ""){
                    errorDiv.style.display = 'block';
                    errorDiv.innerHTML = "Este campo es obligatorio."
                    this.style.border = '2px solid red';    
                    errorDiv.style.border = '1px solid red';
                } else {
                    errorDiv.style.display = 'none';
                    this.style.border = '1px solid #cccccc';
                }
            }

            nombre.addEventListener('blur', validarCampos);
            apellidos.addEventListener('blur', validarCampos);
            email.addEventListener('blur', validarCampos);

            //Funcion para validar email.
            function validarEmail(){
                if(this.value.indexOf("@") > -1){
                    errorDiv.style.display = 'none';
                    this.style.border = '1px solid #cccccc';
                } else {
                    errorDiv.style.display = 'block';
                    errorDiv.innerHTML = "Debe tener al menos una @";
                    this.style.border = '2px solid red';
                    errorDiv.style.border = '1px solid red';
                }
            }

            email.addEventListener('blur', validarEmail);
        } //fin validación de formulario registro

    }); //DOMContentLoaded
})();