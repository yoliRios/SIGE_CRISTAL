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

/**
 *  Funcion que implementa el calendario del jquery, recibe por parametro 
 *  la fecha_desde, fecha_hasta, la fecha minima y maxima.
 */
function calendarioDesdeHasta(fecha, hasta, minimo, maximo) {
	var dates = $(fecha + "," + hasta).datepicker(
			{
				dateFormat : 'dd/mm/yy',
				minDate : minimo,
				maxDate : maximo,
				changeMonth : true,
				changeYear : true,
				numberOfMonths : 1,
				showOn : "button",
				buttonImage : "http://127.0.0.1/SIGE_CRISTAL/application/views/img/iconos/icono_calendario.gif",
				buttonImageOnly : true,
				showAnim : 'blind',
				onSelect : function(selectedDate) {
					var option = this.id == "fecha_desde" ? "minDate" : "maxDate", instance = $(this).data("datepicker"), date = $.datepicker.parseDate(instance.settings.dateFormat
							|| $.datepicker._defaults.dateFormat, selectedDate, instance.settings);
					dates.not(this).datepicker("option", option, date);
				}
			});
	$(fecha + "," + hasta).datepicker($.datepicker.regional['es']);
}

/*
 * Funcion que se encarga de verificar la fecha actual.
 */
function fechaActual() {
	var mydate = new Date();
	var year = mydate.getYear();
	if (year < 1000) {
		year += 1900;
	}
	var month = mydate.getMonth() + 1;
	if (month < 10) {
		month = "0" + month;
	}
	var daym = mydate.getDate();
	if (daym < 10) {
		daym = "0" + daym;
	}
	var fecha = daym + "/" + month + "/" + year;
	return fecha;
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
 * @param idAjax: id del ajax
 * @param idForm: id del formulario a enviar
 * @param arch: archivo a buscar
 * @param idRemov: id a remover
 */
function abrirAjaxHtml(idAjax, idForm ,arch, idRemov){
   dataString = $("#" + idForm).serialize();
   $( "#" + idRemov).remove();
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

function verificaSeleccion(mensaje, idForm, direccion, codigo) {
    if($('[name="eliminarProd"]:checked').val() == codigo ){  
        enviarFormPreg(mensaje, idForm , direccion);
    }  
}

function verificarOpcion(mensaje, idForm, direccion, codigo) {
    document.getElementById('eliminar_cod_cliente').value = codigo;
    enviarFormPreg(mensaje, idForm , direccion);   
}


function applyPagination() {
      $("#ajax_paging a").click(function() {
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
    
//******************************Auditoria*************************************

/**
 * Funcion que se encarga de aplicar la paginacion en la funcionalidad Auditoria
 */
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

/*Funcion que valida los campos de formulario Auditoria antes de enviarlo*/

function verificarBuscarAuditoria(indicador){    
    document.getElementById('indicador').value = indicador;
    
    if(document.getElementById('fecha_desde').value!= '' && document.getElementById('fecha_hasta').value==''){
        document.getElementById('error_fecha').style.display = "inline-block";
        document.getElementById('fecha_hasta').style.border = "2px solid #D62C2C";
    }else{        
        abrirHtml('ajaxHTML', 'auditoria' ,'http://127.0.0.1/SIGE_CRISTAL/Auditoria/Auditoria_controller/consultar_operaciones');
    }
}

/**
 * funcion que cambia el icono de los botones
 * @param id: id del boton a modificar
 * @param icono: icono que se le colocara
 */
function botonModificar(id, icono){
	$( "#"+id ).button({
        icons: {
            primary: icono
        },
        text: false
	});
}
function mostrar(nombreDiv) {
   $("#"+nombreDiv).fadeIn('slow');
} //checkHover

function popUp(nombreDiv){
    
   $(document).ready(function (){
            //Conseguir valores de la img
    var img_w = $("#pop img").width() + 10;
    var img_h = $("#pop img").height() + 28;

    //Darle el alto y ancho
    $("#"+nombreDiv).css('width', img_w + 'px');
    $("#"+nombreDiv).css('height', img_h + 'px');

    //Esconder el popup
   // $("#"+nombreDiv).hide();
        //Consigue valores de la ventana del navegador
    var w = $(this).width();
    var h = $(this).height();

    //Centra el popup   
    w = (w/2) - (img_w/2);
    h = (h/2) - (img_h/2);
    $("#"+nombreDiv).css("left",w + "px");
    $("#"+nombreDiv).css("top",h + "px");
        //temporizador, para que no aparezca de golpe
    setTimeout("mostrar()",1500);
    //Función para cerrar el popup
    $("#"+nombreDiv).click(function (){
        $(this).fadeOut('slow');
    });
   });
}

function formDialog(nombre_div){
  
 $("#"+nombre_div).dialog({
            autoOpen: false,
            height: 250,
            width: 540,
            show: "blind",
            hide: "blind",
            resizable: false,
            modal: true,
            buttons: {
                "Guardar": function() {                    
                 /*   var bValid = true;
                    allFields.removeClass( "ui-state-error" );
 
                    bValid = bValid && checkLength( name, "username", 3, 16 );
                    bValid = bValid && checkLength( email, "email", 6, 80 );
                    bValid = bValid && checkLength( password, "password", 5, 16 );
 
                    bValid = bValid && checkRegexp( name, /^[a-z]([0-9a-z_])+$/i, "Username may consist of a-z, 0-9, underscores, begin with a letter." );
                    // From jquery.validate.js (by joern), contributed by Scott Gonzalez: http://projects.scottsplayground.com/email_address_validation/
                    bValid = bValid && checkRegexp( email, /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i, "eg. ui@jquery.com" );
                    bValid = bValid && checkRegexp( password, /^([0-9a-zA-Z])+$/, "Password field only allow : a-z 0-9" );
 
                    if ( bValid ) {
                        $( "#users tbody" ).append( "<tr>" +
                            "<td>" + name.val() + "</td>" + 
                            "<td>" + email.val() + "</td>" + 
                            "<td>" + password.val() + "</td>" +
                        "</tr>" ); 
                        $( this ).dialog( "close" );
                    }*/
                    $( this ).dialog( "close" );
                },
                "Cancelar": function() {
                    $( this ).dialog( "close" );
                }
            },
            close: function() {
                allFields.val( "" ).removeClass( "ui-state-error" );
            }
        });
        //$( "#"+nombre_div).dialog({ position: { my: "center", at: "center", of: window } });
        $("#"+nombre_div).dialog( "open" );   
}
function validarFechaHasta(){
    
}


