<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');

/*
|--------------------------------------------------------------------------
| CONSTANTES DEFINIDAS PARA EL DESARROLLO PROPIO DE LA APLICACION
|--------------------------------------------------------------------------
| 
|
*/

// Constantes fechas
define("PDF" , ".pdf");
define("FECHA_ARCHIVO" , "d-m-Y His");
define("FECHA_COMPLETA", "d/m/Y H:i:s");
define("SOLO_FECHA", "d/m/Y");
define("FECHA_REGISTRO", "Y-m-d H:i:s");

//Constantes de operaciones
define("OPERACION_ELIMINAR", "ELIMINAR");
define("OPERACION_ACTUALIZAR", "ACTUALIZAR");
define("OPERACION_INSERTAR", "INSERTAR");
define("OPERACION_DESACTIVAR", "DESACTIVAR");

//Constantes error
define("NO_EXISTEN_REGISTROS"," Disculpe no existen registros disponibles para la consulta");
define("ATENCION","Atención! ");
define("ERROR","Error! ");
define("ERROR_FECHA_DESDE","Debe introducir la fecha hasta");

//Constantes de preguntas operaciones
define("MENSAJE_INGRESO","¿Está seguro de Crear el");
define("MENSAJE_ACTUALIZAR","¿Está seguro de Modificar el");
define("MENSAJE_ELIMINAR","¿Está seguro de Eliminar el");
define("MENSAJE_DESACTIVAR","¿Está seguro de Desactivar el");
define("MENSAJE_ASIGANCION","¿Está seguro de Asignar el");

//Constantes de filtros
define("FILTRO_CODIGO","Código:");
define("FILTRO_NOMBRE","Nombre:");
define("FILTRO_CEDULA","Cédula:");
define("FILTRO_USUARIO","Usuario:");
define("FILTRO_ROL","Rol:");
define("FILTRO_DESDE","Fecha Desde:");
define("FILTRO_HASTA","Fecha Hasta:");
define("FILTRO_OPERACION","Operación:");

//Constantes tablas
define("CEDULA","Cédula");
define("CODIGO","Código");
define("NOMBRE","Nombre");
define("APELLIDO","Apellido");
define("USUARIO","Usuario");
define("ROL","Rol");
define("ESTADO","Estado");
define("DESCRIPCION","Descripción");
define("MOD","Mod");
define("DESAC","Desac");
define("FECHA","Fecha");
define("OPERACION","Operación");
define("FUNCIONALIDAD","Funcionalidad");
define("NUM_REGISTROS","Cant. Registros");


// Constantes de la funcinalidad Auditoria
define("NOMBRE_REPORTE_AUDITORIA", "\Auditoria");
define("RUTA_REPORTE_AUDITORIA", "C:\Reportes");
define("MENSAJE_REPORTE", "El reporte fue emitido con éxito.");
define("CIFRAR", "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890#@*-/_");
define("CORREO_CREAR_USUARIO", "Estimado(a) Sr(a).  *N*, se ha efectuado la creación de su usuario *U* con clave *C* para el ingreso al sistema SIGE_CRISTAL. Que tenga un buen día");

/* End of file constants.php */
/* Location: ./application/config/constants.php */