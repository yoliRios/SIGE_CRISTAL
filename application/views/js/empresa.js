/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/*
 * Funcion que se encarga de validar que un departamento se ingrese correctamente
 * @param idForm: id del formulario
 * @param direccion: ruta de envio
 */
function verificarIngresoDpto(idForm, direccion) {
    //Extiendo por jQuery los mensajes del plugin validador     
    if((document.getElementById('nombreDPTO').value).trim() == ''){        
        $( "#MensajeError" ).dialog({
                height: 140,
                modal: true,
                resizable : false
        });
    }else{
        enviarFormPreg('MensajeIngresar', idForm , direccion);
    }
}

function verificaSeleccionModDpto(idObj, estado) { 
    codActual = $('#seleccion').val();
    //Se oculta el anterior seleccionado 
    if(codActual != ''){        
        $("#estadoL" + codActual).show("slow");
        $("#estado" + codActual).hide("slow");
        $("#nombreDptoL" + codActual).show("slow");
        $("#nombreDpto" + codActual).hide("slow");
    }
    //Se muestra el actual
    if(estado == 'A'){  
        $("#nombreDpto" + idObj).show("slow");
        $("#nombreDptoL" + idObj).hide("slow");       
    }else{        
        $("#estado" + idObj).show("slow");
        $("#estadoL" + idObj).hide("slow");
    }
    $("#seleccion").val(idObj);
}

/*
 * Funcion que se encarga de validar que un departamento se ingrese correctamente
 * @param idForm: id del formulario
 * @param direccion: ruta de envio
 */
function verificarIngresoSucursal(idForm, direccion) {
    //Extiendo por jQuery los mensajes del plugin validador  
    if((document.getElementById('nombreSucursal').value).trim() == ''){        
        $( "#MensajeError" ).dialog({
                height: 140,
                modal: true,
                resizable : false
        });
    }else{
        enviarFormPreg('MensajeIngresar', idForm , direccion);
    }
}


