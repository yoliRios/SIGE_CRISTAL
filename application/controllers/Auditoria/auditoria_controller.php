<?php

class Auditoria_controller extends CI_Controller {    
    /**
     * Constructor principal de la clase 
     */
    public function __construct() {
        parent::__construct();
    }
    
   /**
    *   Metodo de inicializacion de la funcionalidad Auditoria 
    */
    function auditoria(){
       // $this->load->library('session');
        log_message('info', '[INICIO] ' . '[USUARIO CONECTADO: ][ACCION: auditoria()]');
        $data['page_title'] = "Auditoria";
        $data['num_reg'] = -1;       
        $data['operaciones']= array("NULL" =>'',
                                    "INSERTAR" =>OPERACION_INSERTAR,
                                    "ACTUALIZAR" =>OPERACION_ACTUALIZAR,
                                    "ELIMINAR" =>OPERACION_ELIMINAR,
                                    "DESACTIVAR" =>OPERACION_DESACTIVAR); 
        $data['ind_reporte'] = 1;
        $data['tipo_operacion'] ="";
        log_message('info', '[FIN] ' . '[USUARIO CONECTADO: ][ACCION: auditoria()]');
        $this->load->view('Auditoria/auditoria_view', $data);
    }     
    
    /*
     * Function encargada las auditorias
     */
    function consultarAuditoria()

    {       
        log_message('info', '[INICIO] ' . '[USUARIO CONECTADO: ' . 'usuario' . '][ACCION: consultarAuditoria()]');
        $this->load->helper(array('text','form','url'));
        $this->load->library('pagination'); //Cargamos la librería de paginación
        $this->load->model('Auditoria/auditoria_model'); //cargamos el modelo	
        $data['page_title'] = "Auditoria";
        $data['ind_reporte'] = 1;              
        /**
         * Variable que indica si la consulta en el modelo se va a realizar con paginación o no
         * R = Indica reporte; no se pagina la consulta
         * P = Indica busqueda; se realiza la consulta con paginacion
         */
        try {  
            $indicador = empty($_POST['indicador']) == 1 ? 'P' : $_POST['indicador']; 
            $data['tipo_operacion'] = empty($_POST['nomb_operacion']) == 1 || $_POST['nomb_operacion'] == NULL ? 'NULL' : $_POST['nomb_operacion']; 
            $fecha_desde = empty($_POST['fecha_desde']) == 1 ? 'NULL' : explode('/',$_POST['fecha_desde']);                            
            $fecha_hasta= empty($_POST['fecha_hasta']) == 1 ? 'NULL' : explode('/',$_POST['fecha_hasta']);

            $data['fecha_desde'] = empty($_POST['fecha_desde']) == 1 ? 'NULL' : $fecha_desde[2].'-'.$fecha_desde[1].'-'.$fecha_desde[0];
            $data['fecha_hasta'] = empty($_POST['fecha_hasta']) == 1 ? 'NULL' : $fecha_hasta[2].'-'.$fecha_hasta[1].'-'.$fecha_hasta[0];

            //Obtener datos de la tabla 'Departamentos'	
            $reg_operaciones = $this->pagination($data, $this->auditoria_model, $indicador);
            $data['registro_operaciones'] = $reg_operaciones->result();
            $data['num_reg'] = $reg_operaciones->num_rows();
            $data['paginate'] = $this->pagination->create_links();	
            //load de vistas	
            log_message('info', '[FIN] ' . '[USUARIO CONECTADO: ' . 'usuario' . '][ACCION: consultarAuditoria()]');
        }catch(Exception $e){
            log_message('error', '[EXCEPCION] ' . '[USUARIO CONECTADO: ][ACCION: consultar_operaciones()][MENSAJE:'.$e->getMessage().' '._LINE.' ]');
        }        
        $data['operaciones']= array("NULL" =>'',
                                    "INSERTAR" =>OPERACION_INSERTAR,
                                    "ACTUALIZAR" =>OPERACION_ACTUALIZAR,
                                    "ELIMINAR" =>OPERACION_ELIMINAR,
                                    "DESACTIVAR" =>OPERACION_DESACTIVAR);
        // Se carga la vista con los resultados de la consulta
        $this->load->view('auditoria/auditoria_view', $data);
    }
    
    /*
     * Funcion encargada de realizar la paginacion de un departamento
     */
    function pagination($data, $modelo, $indicador){
        log_message('info', '[INICIO] ' . '[USUARIO CONECTADO: ' . 'usuario' . '][ACCION: paginacion()]'); 
        $config['base_url'] = base_url().'Auditoria/auditoria_controller/consultarAuditoria'; // parametro base de la aplicación, si tenemos un .htaccess nos evitamos el index.php
        $config['total_rows'] = $modelo->buscar_auditoria($data,'R')->num_rows(); 
        $config['num_links'] = 2; //Numero de links mostrados en la paginación
        $config['per_page'] = 10;
        $config['uri_segment'] = '4';  
        $this->pagination->initialize($config);         
        log_message('info', '[FIN] ' . '[USUARIO CONECTADO: ' . 'usuario' . '][ACCION: paginacion()]'); 
        $auditoria =  $modelo->buscar_auditoria($data,$indicador);
        
        return $auditoria;
		
    }
    
    /**
     * Metodo que se encarga de realizar la generacion del reporte de la auditoria en formato PDF
     */    
    function generar_reporte_operaciones($reg_operaciones){
       // $this->load->library('session');
        log_message('info', '[INICIO] ' . '[USUARIO CONECTADO: ][ACCION: generar_reporte_operaciones()]');
        require 'Auditoria_PDF.php';   
        try{
            // Cabecera de la tabla
            $header = array('Fecha y Hora', 'Usuario',iconv('UTF-8', 'windows-1252','Operación'), 'Funcionalidad','Registros Afectados');
            log_message('info', '[OPERACION] ' . '[USUARIO CONECTADO: ] [ACCION: crearTabla($header,$reg_operaciones)()][MENSAJE: llamado a la Clase Auditoria_PDF encargada de generar el reporte en PDF ]');
            $pdf = new Auditoria_PDF(); 
            $pdf->AddPage();      
            $pdf->crearTabla($header,$reg_operaciones);
            //Direccion en la que se va a almacenar el reporte generado
            $url = RUTA_REPORTE_AUDITORIA.NOMBRE_REPORTE_AUDITORIA.' '.date(FECHA_ARCHIVO).PDF;       
            $pdf->Output($url, 'F');
            log_message('info', '[OPERACION] ' . '[USUARIO CONECTADO: ] [ACCION:  $pdf->Output($url, F);][MENSAJE: Reporte guardado en la ruta '.$url.']');
            log_message('info', '[FIN] ' . '[USUARIO CONECTADO: ][ACCION: generar_reporte_operaciones()]');
        }catch (Exception $e){
            log_message('error', '[EXCEPCION] ' . '[USUARIO CONECTADO: ][ACCION: generar_reporte_operaciones()][MENSAJE:'.$e->getMessage().' '._LINE.' ]'); 
        }
   }

}
?>
