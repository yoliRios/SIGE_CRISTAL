<?php

class Empresa extends CI_Controller {

    public function __construct() {

            parent::__construct();

    }
    
    /*
     * Funcion encargada de la primera vista de la funcionalidad departamento
     */
    function departamento()

    {   
        $data['page_title'] = "Departamentos";
        $data['numReg'] = -1;
        $this->load->view('php/departamento_view', $data); //llamada a la vista, que crearemos posteriormente
        log_message ('info', 'Ingreso a departamento');    
    }
    
    /*
     * Function encargada de consultar los departamentos por codigo y nombre
     */
    function buscarDepartamento()

    {       
        $this->load->helper(array('text','form','url'));
        $this->load->library('pagination'); //Cargamos la librería de paginación
        $this->load->model('empresa_model'); //cargamos el modelo	
        $data['page_title'] = "Departamentos";
	$codigo = empty($_POST['codigo']) == 1 ? 'NULL' : $_POST['codigo'];
	$nombre = empty($_POST['nombre']) == 1 ? NULL : $_POST['nombre'];

        //Obtener datos de la tabla 'Departamentos'	
        $departamento = $this->pagination($this->empresa_model, $codigo, $nombre);
        $data['departamento'] = $departamento->result();
        $data['numReg'] = $departamento->num_rows();	
        $data['ultCod'] = $this->empresa_model->ultimoDepartamento($codigo, $nombre)->row()->ultCod;	
        //load de vistas	
        log_message ('info', 'Envio informacion departamento'); 
        $this->load->view('php/departamento_view', $data); //llamada a la vista, que crearemos posteriormente

    }
    
    /*
     * Funcion encargada del ingreso de un departamento
     */
    function insertDpto() {
            //recogemos los datos obtenidos por POST
            $data['codigoNew'] = $_POST['codigoNew'];
            $data['nombre'] = $_POST['nombreDPTO'];
            //llamamos al modelo, concretamente a la funci�n insert() para que nos haga el insert en la base de datos.
            $this->load->model('empresa_model');
            $this->empresa_model->insertDpto($data);
            //volvemos a visualizar la tabla
            $this->buscarDepartamento();
    }
    
        /*
        * Funcion encargada de la eliminacion de un departamento
        */
    function deleteDpto() {                
        //obtenemos el nombre
        log_message ('info', 'Eliminar: '.$_POST['eliminarProd']); 
        $codigoElim = $_POST['eliminarProd'];
        //cargamos el modelo y llamamos a la funci�n baja(), pasandole el codigo del registro a eliminar.
        $this->load->model('empresa_model');
        $this->empresa_model->delete($codigoElim);
        //mostramos la vista de nuevo.
        log_message ('info', 'Entre al eliminar');   
        $this->buscarDepartamento();
    }
    
    /*
     * Funcion encargada de realizar la paginacion de un departamento
     */
    function pagination($modelo, $codigo, $nombre){
        $config['base_url'] = base_url().'/Empresa/buscarDepartamento'; // parametro base de la aplicación, si tenemos un .htaccess nos evitamos el index.php
        $config['total_rows'] = $modelo->buscarTotalDepto($codigo, $nombre); 
        $config['num_links'] = 2; //Numero de links mostrados en la paginación
        $config['per_page'] = 10;
        $this->pagination->initialize($config);         
        $departamento =  $modelo->buscarDepartamento($codigo, $nombre);
        
        return $departamento;
		
    }
    
    /*
     * 
     * ***************************** SUCURSALES *******************************
     * 
     */

    
    /*
     * Funcion encargada de la primera vista de la funcionalidad sucursal
     */
    function sucursal()

    {   
        $data['page_title'] = "Sucursales";
        $data['numReg'] = -1;
        $this->load->view('php/sucursal_view', $data); //llamada a la vista, que crearemos posteriormente
        log_message ('info', 'Ingreso a sucursal');    
    }
    
    /*
     * Function encargada de consultar las sucursales por codigo y nombre
     */
    function buscarSucursal()

    {       
        $this->load->helper(array('text','form','url'));
        $this->load->library('pagination'); //Cargamos la librería de paginación
        $this->load->model('empresa_model'); //cargamos el modelo	
        $data['page_title'] = "Sucursales";
	$codigo = empty($_POST['codigo']) == 1 ? 'NULL' : $_POST['codigo'];
	$nombre = empty($_POST['nombre']) == 1 ? NULL : $_POST['nombre'];

        //Obtener datos de la tabla 'Sucursal'	
        $sucursal = $this->paginationSucursal($this->empresa_model, $codigo, $nombre);
        $data['sucursal'] = $sucursal->result();
        $data['numReg'] = $sucursal->num_rows();	
        $data['ultCod'] = $this->empresa_model->ultimaSucursal($codigo, $nombre)->row()->ultCod;	
        //load de vistas	
        log_message ('info', 'Envio informacion sucursal'); 
        $this->load->view('php/sucursal_view', $data); //llamada a la vista, que crearemos posteriormente

    }
    
    /*
     * Funcion encargada del ingreso de una sucursal
     */
    function insertSucursal() {
            //recogemos los datos obtenidos por POST
            $data['codigoNew'] = $_POST['codigoNew'];
            $data['nombre'] = $_POST['nombreSucursal'];
            //llamamos al modelo, concretamente a la funci�n insert() para que nos haga el insert en la base de datos.
            $this->load->model('empresa_model');
            $this->empresa_model->insertSucursal($data);
            //volvemos a visualizar la tabla
            $this->buscarSucursal();
    }
    
        /*
        * Funcion encargada de la eliminacion de una sucursal
        */
    function deleteSucursal() {                
        //obtenemos el nombre
        log_message ('info', 'Eliminar: '.$_POST['eliminarProd']); 
        $codigoElim = $_POST['eliminarProd'];
        //cargamos el modelo y llamamos a la funci�n baja(), pasandole el codigo del registro a eliminar.
        $this->load->model('empresa_model');
        $this->empresa_model->deleteSucursal($codigoElim);
        //mostramos la vista de nuevo.
        log_message ('info', 'Entre al eliminar');   
        $this->buscarSucursal();
    }
    
    /*
     * Funcion encargada de realizar la paginacion de un departamento
     */
    function paginationSucursal($modelo, $codigo, $nombre){
        $config['base_url'] = base_url().'/Empresa/buscarSucursal'; // parametro base de la aplicación, si tenemos un .htaccess nos evitamos el index.php
        $config['total_rows'] = $modelo->buscarTotalSucursal($codigo, $nombre); 
        $config['num_links'] = 2; //Numero de links mostrados en la paginación
        $config['per_page'] = 10;
        $this->pagination->initialize($config);         
        $sucursal =  $modelo->buscarSucursal($codigo, $nombre);
        
        return $sucursal;
		
    }
}

?>