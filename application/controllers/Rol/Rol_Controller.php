<?php

class Rol_Controller extends CI_Controller {

    public function __construct() {

            parent::__construct();	

    }
    
    /*
     * Funcion encargada de la primera vista de la funcionalidad roles.
     */
    function rol()

    {   
        //$this->load->library('session');
        log_message('info', '[INICIO] ' . '[USUARIO CONECTADO: ' . 'usuario' . '][ACCION: rol()]');
        $data['page_title'] = "Creación de Roles";
        $data['numReg'] = -1;
        //llamada a la vista, por defecto se llama a creacion de roles
        $this->load->view('rol/crearRol_view', $data);         
        log_message ('info', '[FIN] ' . '[USUARIO CONECTADO: ' . 'usuario' . '][ACCION: rol()]');
    }
    
    /*
     * Function encargada de consultar los departamentos por codigo y nombre
     */
    function buscarRol()

    {       
        //$this->load->library('session');
        log_message('info', '[INICIO] ' . '[USUARIO CONECTADO: ' . 'usuario' . '][ACCION: buscarRol()]');
        $this->load->helper(array('text','form','url'));
        $this->load->library('pagination'); //Cargamos la librería de paginación
        $this->load->model('rol/rol_model'); //cargamos el modelo	
        $data['page_title'] = "Creación de Roles";
	$codigo = empty($_POST['codigo']) == 1 ? 'NULL' : $_POST['codigo'];
	$nombre = empty($_POST['nombre']) == 1 ? NULL : $_POST['nombre'];

        //Obtener datos de la tabla 'Rol'	
        $rol = $this->pagination($this->rol_model, $codigo, $nombre);
        $data['rol'] = $rol->result();
        $data['numReg'] = $rol->num_rows();	
        $data['ultCod'] = $this->rol_model->ultimoRol($codigo, $nombre)->row()->ultCod;	
        //load de vistas	
        log_message('info', '[FIN] ' . '[USUARIO CONECTADO: ' . 'usuario' . '][ACCION: buscarRol()]');
        $this->load->view('rol/crearRol_view', $data); //llamada a la vista, que crearemos posteriormente

    }
    
    /*
     * Funcion encargada del ingreso de un departamento
     */
    function insertRol() {
        log_message('info', '[INICIO] ' . '[USUARIO CONECTADO: ' . 'usuario' . '][ACCION: insertRol()]');
        //recogemos los datos obtenidos por POST
        $data['codigoNew'] = $_POST['codigoNew'];
        $data['nombre'] = $_POST['nombreROL'];
        $data['descripcion'] = $_POST['descrROL'];
        //llamamos al modelo, concretamente a la funci�n insert() para que nos haga el insert en la base de datos.
        $this->load->model('rol/rol_model');
        $this->rol_model->insertRol($data);
        log_message('info', '[FIN] ' . '[USUARIO CONECTADO: ' . 'usuario' . '][ACCION: insertRol()]');
        //volvemos a visualizar la tabla
        $this->buscarRol();
    }
    
        /*
        * Funcion encargada de la eliminacion de un rol
        */
    function deleteRol() {        
        log_message('info', '[INICIO] ' . '[USUARIO CONECTADO: ' . 'usuario' . '][ACCION: deleteRol()] [ELIMINAR: '. $_POST['eliminarProd'].']');        
        //obtenemos el nombre
        $codigoElim = $_POST['eliminarProd'];
        //cargamos el modelo y llamamos a la funci�n baja(), pasandole el codigo del registro a eliminar.
        $this->load->model('rol/rol_model');
        $this->rol_model->delete($codigoElim);
        //mostramos la vista de nuevo.
        log_message('info', '[FIN] ' . '[USUARIO CONECTADO: ' . 'usuario' . '][ACCION: deleteRol()] [ELIMINAR: '. $_POST['eliminarProd'].']');   
        $this->buscarRol();
    }
    
    /*
     * Funcion encargada de realizar la paginacion de un departamento
     * @param  $modelo :  Modelo a usar en la paginacion
     * @param  $codigo :  Codigo del rol a paginar (puede ser un valor null)
     * @param  $nombre :  Nombre del rol a paginar (puede ser un valor null)
     */
    function pagination($modelo, $codigo, $nombre){
        log_message('info', '[INICIO] ' . '[USUARIO CONECTADO: ' . 'usuario' . '][ACCION: pagination()]');
        $config['base_url'] = base_url().'/Rol/Rol_Controller/buscarRol'; // parametro base de la aplicación, si tenemos un .htaccess nos evitamos el index.php
        $config['total_rows'] = $modelo->buscarTotalRol($codigo, $nombre); 
        $config['num_links'] = 2; //Numero de links mostrados en la paginación
        $config['per_page'] = 10;
        $this->pagination->initialize($config);         
        $rol =  $modelo->buscarRol($codigo, $nombre);
        log_message('info', '[FIN] ' . '[USUARIO CONECTADO: ' . 'usuario' . '][ACCION: pagination()]');
        
        return $rol;
		
    }
    
    //************************************ASIGNACION DE SERVICIOS A ROLES *************************************
    
    /*
     * Funcion encargada de la vista asignar servicios.
     */
    function servicio()

    {   
        //$this->load->library('session');
        log_message('info', '[INICIO] ' . '[USUARIO CONECTADO: ' . 'usuario' . '][ACCION: servicio()]');
        $this->load->model('rol/rol_model'); //cargamos el modelo
        $data['page_title'] = "Asignación de Servicios";
        $data['numReg'] = -1;
        $data['roles'] = $this->rol_model->buscarRoles()->result(); 
        //llamada a la vista, por defecto se llama a creacion de roles
        $this->load->view('rol/asignarServ_view', $data);         
        log_message ('info', '[FIN] ' . '[USUARIO CONECTADO: ' . 'usuario' . '][ACCION: servicio()]');
    }
    
    /*
     * Function encargada de consultar los servicios por rol
     */
    function buscarServicios()

    {       
        //$this->load->library('session');
	$codigo = $_POST['roles'];
        log_message('info', '[INICIO] ' . '[USUARIO CONECTADO: ' . 'usuario' . '][ACCION: buscarServicios()] [CODIGO ROL: ' . $codigo . ']');
        $this->load->helper(array('text','form','url'));
        $this->load->library('pagination'); //Cargamos la librería de paginación
        $this->load->model('rol/rol_model'); //cargamos el modelo	
        $data['page_title'] = "Asignación de Servicios";

        //Obtener datos de la tabla 'Rol'	
        $servicio = $this->paginationServ($this->rol_model, $codigo);
        $data['servicio'] = $servicio->result();
        $data['numReg'] = $servicio->num_rows();
        $servicios = $this->rol_model->buscarServicios($codigo);
        $data['servicios'] = $servicios->result();
        $data['roles'] = $this->rol_model->buscarRoles()->result(); 
        $data['num_serv'] = $servicios->num_rows();
        $data['cod_rol'] = $codigo; 
        //load de vistas	
        log_message('info', '[FIN] ' . '[USUARIO CONECTADO: ' . 'usuario' . '][ACCION: buscarServicios()] [CODIGO ROL: ' . $codigo . ']');
        $this->load->view('rol/asignarServ_view', $data); //llamada a la vista, que crearemos posteriormente

    }
    
    /*
     * Funcion encargada del ingreso de un servicio a un rol
     */
    function insertServRol() {
        log_message('info', '[INICIO] ' . '[USUARIO CONECTADO: ' . 'usuario' . '][ACCION: insertServRol()]');
        //recogemos los datos obtenidos por POST
        $data['codServ'] = $_POST['servicios'];
        $data['codRol'] = $_POST['rol'];
        //llamamos al modelo, concretamente a la funci�n insert() para que nos haga el insert en la base de datos.
        $this->load->model('rol/rol_model');
        $this->rol_model->insertServRol($data);
        log_message('info', '[FIN] ' . '[USUARIO CONECTADO: ' . 'usuario' . '][ACCION: insertServRol()]');
        //volvemos a visualizar la tabla
        $this->buscarServicios();
    }
    
        /*
        * Funcion encargada de la eliminacion de un rol
        */
    function deleteServRol() {        
        log_message('info', '[INICIO] ' . '[USUARIO CONECTADO: ' . 'usuario' . '][ACCION: deleteServRol()] [ELIMINAR: '. $_POST['eliminarProd'].']');        
        //obtenemos el nombre
        $data['codServ'] = $_POST['eliminarProd'];
        $data['codRol'] = $_POST['rol'];
        //cargamos el modelo y llamamos a la funci�n baja(), pasandole el codigo del registro a eliminar.
        $this->load->model('rol/rol_model');
        $this->rol_model->deleteServRol($data);
        //mostramos la vista de nuevo.
        log_message('info', '[FIN] ' . '[USUARIO CONECTADO: ' . 'usuario' . '][ACCION: deleteServRol()] [ELIMINAR: '. $_POST['eliminarProd'].']');   
        $this->buscarServicios();
    }
    
    /*
     * Funcion encargada de realizar la paginacion de la asignacion de servicios
     */
    function paginationServ($modelo, $codigo){
        log_message('info', '[INICIO] ' . '[USUARIO CONECTADO: ' . 'usuario' . '][ACCION: paginationServ()]');
        $config['base_url'] = base_url().'/Rol/Rol_Controller/buscarServicios'; // parametro base de la aplicación, si tenemos un .htaccess nos evitamos el index.php
        $config['total_rows'] = $modelo->buscarTotalServ($codigo); 
        $config['num_links'] = 2; //Numero de links mostrados en la paginación
        $config['per_page'] = 10;
        $this->pagination->initialize($config);         
        $servicio =  $modelo->buscarServRol($codigo);
        log_message('info', '[FIN] ' . '[USUARIO CONECTADO: ' . 'usuario' . '][ACCION: paginationServ()]');
        
        return $servicio;
		
    }
}

?>