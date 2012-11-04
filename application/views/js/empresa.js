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


