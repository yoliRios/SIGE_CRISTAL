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
        //$this->load->library('session');
        //log_message('info', '[INICIO] ' . '[USUARIO CONECTADO: ' . $this->session->userdata('usuario') . '][ACCION: auditoria()]');
        log_message('info', '[INICIO] ' . '[USUARIO CONECTADO: ' . 'usuario' . '][ACCION: auditoria()]');
        $data['page_title'] = "Auditoria";
        $data['num_reg'] = -1;
        $this->load->view('Auditoria/auditoria_view', $data);
        $data['operaciones']= array("INSERTAR" =>OPERACION_INSERTAR,
                                    "ACTUALIZAR" =>OPERACION_ACTUALIZAR,
                                    "ELIMINAR" =>OPERACION_ELIMINAR);
        log_message('info', '[FIN] ' . '[USUARIO CONECTADO: ' . 'usuario' . '][ACCION: auditoria()]');
    }    
    /**
     *  Metodo que se encarga de realizar la consulta de las operaciones realizadas sobre las BDD
     */    
    function consultar_operaciones(){
        //$this->load->library('session');
        log_message('info', '[INICIO] ' . '[USUARIO CONECTADO: ' . 'usuario' . '][ACCION: consultar_operaciones()]');
        //Cargamos las librerias que se necesitan
        $this->load->helper(array('text','form','url'));
        $this->load->library('pagination'); 
        
        //Incluimos el modelo correspondiente
        $this->load->model('Auditoria/auditoria_model');       
        $data['page_title'] = "Auditoria";
        
        /**
         * Variable que indica si la consulta en el modelo se va a realizar con paginación o no
         * R = Indica reporte; no se pagina la consulta
         * P = Indica busqueda; se realiza la consulta con paginacion
         */
        try {            
            $indicador = $_POST['indicador'];
            //Se realiza la consulta solo por tipo de operacion       
            if(isset($_POST['nomb_operacion']) && (!isset($_POST['fecha_desde']))){
                $data['tipo_operacion'] = $_POST['nomb_operacion']; 
                log_message('info', '[OPERACION] ' . '[USUARIO CONECTADO: ][ACCION: Consultando operaciones por tipo de operacion: '.$data['tipo_operacion'].']');
                $reg_operaciones = $this->auditoria_model->buscar_operaciones_nombre($data['tipo_operacion'],$indicador);            
                $data['registro_operaciones'] = $this->paginacion_auditoria($reg_operaciones)->result();           
                if($indicador == "R"){
                    $this->generar_reporte_operaciones($data['registro_operaciones']);
                }
                $data['numReg'] = $reg_operaciones->num_rows();
            }
            else{ //Se realiza la consulta solo por rango de fechas   
                    $data['fecha_desde'] = $_POST['fecha_desde'];
                    $data['fecha_hasta'] = $_POST['fecha_hasta'];
                    log_message('info', '[OPERACION] ' . '[USUARIO CONECTADO: ][ACCION: Consultando operaciones por rango de fechas: '. $data['fecha_desde'].' '.$data['fecha_hasta'].']');
                    $reg_operaciones = $this->auditoria_model->buscar_operaciones_fechas($data,$indicador);
                    $data['registro_operaciones'] = $this->paginacion_auditoria($reg_operaciones)->result();                   
                    if($indicador == "R"){
                    $this->generar_reporte_operaciones($data['registro_operaciones']);
                    }
                    $data['numReg'] = $reg_operaciones->num_rows();
                }
                //Se realiza la consulta por tipo de operacion y por rango de fechas   
            if(isset($_POST['nomb_operacion']) && (isset($_POST['fecha_desde']))){
                $data['fecha_desde']    = $_POST['fecha_desde'];
                $data['fecha_hasta']    = $_POST['fecha_hasta'];
                $data['tipo_operacion'] = $_POST['nomb_operacion'];
                log_message('info', '[OPERACION] ' . '[USUARIO CONECTADO: ][ACCION: buscar_operaciones()] [MENSAJE]:Consultando operaciones por rango de fechas y tipo operacion: '. $data['fecha_desde'].' '.$data['fecha_hasta'].' '.$data['fecha_hasta'].']');
                $reg_operaciones = $this->auditoria_model->buscar_operaciones($data,$indicador);
                $data['registro_operaciones'] = $this->paginacion_auditoria($reg_operaciones)->result();
                if($indicador == "R"){
                    $this->generar_reporte_operaciones($data['registro_operaciones']);
                }
                $data['numReg'] = $reg_operaciones->num_rows();
            }
        }catch(Exception $e){
            log_message('error', '[EXCEPCION] ' . '[USUARIO CONECTADO: ][ACCION: consultar_operaciones()][MENSAJE:'.$e->getMessage().' '._LINE.' ]');
        }       
        // Se carga la vista con los resultados de la consulta
        $this->load->view('Auditoria/auditoria_view', $data);
        log_message('info', '[FIN] ' . '[USUARIO CONECTADO: ][ACCION: consultar_operaciones()]');
    }
    
    /*
     * Metodo encargado de realizar la paginacion de los registros de la tabla auditoria
     */
    function paginacion_auditoria($obj_auditoria){
        $config['base_url']   = base_url().'/Auditoria/auditoria_controller/consultarOperaciones';
        $config['total_rows'] = $obj_auditoria->num_rows(); 
        $config['per_page']   = 10;
        $config['num_links']  = 2; //Numero de links mostrados en la paginación       
        $this->pagination->initialize($config); 
        return $obj_auditoria;
    }
    /**
     * Metodo que se encarga de realizar la generacion del reporte de la auditoria en formato PDF
     */    
    function generar_reporte_operaciones(){
       // $this->load->library('session');
        log_message('info', '[INICIO] ' . '[USUARIO CONECTADO: ][ACCION: generar_reporte_operaciones()]');
        require 'Auditoria_PDF.php';   
        try{
            // Cabecera de la tabla
            $header = array('Fecha y Hora', 'Usuario',iconv('UTF-8', 'windows-1252','Operación'), 'Funcionalidad','Registros Afectados');

            //esto luego se va a quitar, se hace asi para poder probar de forma directa
            $this->load->model('Auditoria/Auditoria_model');
            $reg_operaciones = $this->Auditoria_model->get_auditoria("R")->result();
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
