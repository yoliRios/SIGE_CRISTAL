/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
/*
 * Asigna la imagen a un boton de jquery
 * @param id: id del boton
 * @param icono: icono a ingresar
 */
function imagenBoton(id, icono){
    $( "#" + id ).button({
        icons: {
            primary: icono
        }
    });
}

/*
 * Busca el archivo php a mostrar
 * @param idAjax: id del ajax
 * @param idForm: id del formulario a enviar
 * @param arch: archivo a buscar
 */
function abrirHtml(idAjax, idForm ,arch){
   dataString = $("#" + idForm).serialize();
   $( "#general").remove();
   $.ajax({
       url: arch,
       type: "POST",
       data: dataString,
       cache: false
    }).done(function( add ) {
        $("#" + idAjax).append(add);
    });
}

/*
 * Busca el archivo php a mostrar
 * @param idForm: id del formulario a enviar
 * @param arch: archivo a buscar
 */
function inicio(){
   document.location.href='http://127.0.0.1/SIGE_CRISTAL/holaMundo';
}
/*
 * Funcion que se encarga de validar que un numero no contenga un cero por
 * delante. Ejemplo: 015, 0015 etc.
 */
function formato_numero_ceros(valor, key) {
	if (valor.length == 1) {
		if (valor.charAt(0) == '0' && key != 44) {
			return true;
		}
	}
	return false;
}

/*
 * Funcion que se encarga de aceptar solamente la entrada de numero positivos en
 * un campo de texto jsp
 */
function acceptNumPos(e, field, tomarCero) {
    key = e.keyCode ? e.keyCode : e.which;
    /*
        * backspace
        */
    if (key == 8){
            return true;            
    }
    /*
        * 0-9
        */
    if (key > 47 && key < 58) {
        if (formato_numero_ceros(field.value, key) && tomarCero) {
                return false;
        } else {
                regexp = /[0-9]+$/;
                if (regexp.test(field.value)) {
                        return (regexp.test(field.value));
                } else {
                        return !(regexp.test(field.value));
                }
        }
    }
    /*
        * other key
        */
    return false;
}

/*
 * Funcion que se encarga de eliminar espacios en blanco de una cadena
 */
String.prototype.trim = function() {
	return this.replace(/^\s+|\s+$/g, "");
};

/*
 * Recibe dos parametros, el primero es un string que contine el id 
 * del div del mensaje y el segundo son los botones del dialogo. 
 */
function dialogoCompleto(divMensaje, botones){
    $("body",window.parent.document)
    .append(function() {
            return $("#" + divMensaje)
    .hide()
    .clone()
    .attr("id","mostrar_dialogo_" + divMensaje);
    });
    parent.$("#mostrar_dialogo_" + divMensaje)
    .dialog({
            modal: true, 
            width: 400, 
            resizable : false, 
            show: "fade", 
            hide: "fade",
            buttons: botones,
            close: function(){
                    parent.$(this).remove();
                    parent.$("#mostrar_dialogo_" + divMensaje).remove();
            }
            });
}


/*
 * Muestra dialogo de jquery con boton aceptar y cancelar
 * @param idForm: id del formulario a enviar
 * @param direccion: direccion de envio
 * @param idPregunta: id del div contenedor de la pregunta a ejecutar
 */
function enviarFormPreg(idPregunta, idForm , direccion){
    dialogoCompleto(idPregunta, {
		"Aceptar" : function() {
			abrirHtml('ajaxHTML', idForm , direccion);
			parent.$(this).dialog("close");
		},
		"Cancelar": function() {
			parent.$(this).dialog("close");
		}
	});	
}

function modificarMensajes(){
  $.ketchup.messages({
        required : 'El campo es requerido!',
        email: 'Email invalido!',
        number: 'El campo debe ser númerico',
        date: 'El campo es de tipo fecha'
    });
    
}
//******************************Auditoria*************************************

function aplicarPaginacionAuditoria() {
      $("#ajax_paginacion_auditoria a").click(function() {
        var url = $(this).attr("href");
        $.ajax({
          type: "POST",
          url: url,
          beforeSend: function() {
            $("#general").html("");
          },
          success: function(msg) {
            $("#general").html(msg);
            applyPagination();
          }
        });
        return false;
      });
    }


