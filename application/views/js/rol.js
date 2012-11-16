/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/*
 * Funcion que se encarga de validar que un departamento se ingrese correctamente
 * @param idForm: id del formulario
 * @param direccion: ruta de envio
 */
function verificarIngresoRol(idForm, direccion) {
    //Extiendo por jQuery los mensajes del plugin validador     
    if((document.getElementById('nombreROL').value).trim() == ''){        
        $( "#MensajeError" ).dialog({
                height: 140,
                modal: true,
                resizable : false
        });
    }else{
        enviarFormPreg('MensajeIngresar', idForm , direccion);
    }
}

/*
 * Busca el archivo php a mostrar
 * @param idForm: id del formulario a enviar
 * @param arch: archivo a buscar
 */
function buscarEmpleado(idForm ,arch){
   dataString = $("#" + idForm).serialize();
   $.ajax({
       url: arch,
       type: "POST",
       data: {cedula: $("#ced").val()},
       traditional : true,
       dataType : "json",
       cache: false
   }).success (function( data ) {
       $("#nombreEmp").text(data.emp.nombre);
       $("#apellidoEmp").text(data.emp.apellido);
       $("#usuarioEmp").text(data.emp.nombre.substr(0,2) + data.emp.apellido);
       $("#ingreso").show("slow");
       $("#rolesEmp").show("slow");
   });
}

function verificaSeleccionModUser(idObjRol, estado) { 
    codActual = $('#seleccion').val();
    //Se oculta el anterior seleccionado 
    if(codActual != ''){        
        $("#rolEmpL" + codActual).show("slow");
        $("#rolEmp" + codActual).hide("slow"); 
        $("#estadoL" + codActual).show("slow");
        $("#estado" + codActual).hide("slow");
    }
    //Se muestra el actual
    if(estado == 'A'){
        $("#rolEmp" + idObjRol).show("slow");
        $("#rolEmpL" + idObjRol).hide("slow");        
    }else{        
        $("#estado" + idObjRol).show("slow");
        $("#estadoL" + idObjRol).hide("slow");
    }
    $("#seleccion").val(idObjRol);
}

function verificaSeleccionModRol(idObjRol, estado) { 
    codActual = $('#seleccion').val();
    //Se oculta el anterior seleccionado 
    if(codActual != ''){        
        $("#estadoL" + codActual).show("slow");
        $("#estado" + codActual).hide("slow");
        $("#tipoRolL" + codActual).show("slow");
        $("#tipoRol" + codActual).hide("slow");
        $("#descrRolL" + codActual).show("slow");
        $("#descrRol" + codActual).hide("slow");
    }
    //Se muestra el actual
    if(estado == 'A'){
        $("#tipoRol" + idObjRol).show("slow");
        $("#tipoRolL" + idObjRol).hide("slow");  
        $("#descrRol" + idObjRol).show("slow");
        $("#descrRolL" + idObjRol).hide("slow");       
    }else{        
        $("#estado" + idObjRol).show("slow");
        $("#estadoL" + idObjRol).hide("slow");
    }
    $("#seleccion").val(idObjRol);
}

