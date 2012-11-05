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
        $data['ultCod'] = $this->rol_model->ultimoRol($codigo, $nombre)->row()->ultCod == NULL ? 0 : $this->rol_model->ultimoRol($codigo, $nombre)->row()->ultCod;	
        //load de vistas	
        log_message('info', '[FIN] ' . '[USUARIO CONECTADO: ' . 'usuario' . '][ACCION: buscarRol()]');
        $this->load->view('rol/crearRol_view', $data); //llamada a la vista, que crearemos posteriormente

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
    * Funcion encargada de modificar los datos de un rol
    */
    function updateRol() {        
        log_message('info', '[INICIO] ' . '[USUARIO CONECTADO: ' . 'usuario' . '][ACCION: updateRol()] [MODIFICAR: '. $_POST['eliminarProd'].']');        
        //obtenemos el nombre
        $data['codRol'] = $_POST['eliminarProd'];
        $codRol = $_POST['eliminarProd'];
        $data['estado'] = $_POST['estado'.$codRol];
        //cargamos el modelo y llamamos a la funci�n baja(), pasandole el codigo del registro a eliminar.
        $this->load->model('rol/rol_model');
        $this->rol_model->updateRol($data);
        //mostramos la vista de nuevo.
        log_message('info', '[FIN] ' . '[USUARIO CONECTADO: ' . 'usuario' . '][ACCION: updateRol()] [MODIFICAR: '. $_POST['eliminarProd'].']');   
        $this->buscarRol();
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
    
    //************************************ASIGNACION DE ROLES A USUARIOS *************************************
    
    /*
     * Funcion encargada de la vista crear usuario y asignar roles.
     */
    function usuario()

    {   
        //$this->load->library('session');
        log_message('info', '[INICIO] ' . '[USUARIO CONECTADO: ' . 'usuario' . '][ACCION: usuario()]');
        $this->load->model('rol/rol_model'); //cargamos el modelo
        $data['page_title'] = "Crear usuario";
        $data['numReg'] = -1;
        //llamada a la vista, por defecto se llama a creacion de roles
        $this->load->view('rol/crearUser_view', $data);         
        log_message ('info', '[FIN] ' . '[USUARIO CONECTADO: ' . 'usuario' . '][ACCION: usuario()]');
    }
    
    /*
     * Function encargada de consultar los usuarios y sus roles
     */
    function buscarRolUser()

    {       
        //$this->load->library('session');
        log_message('info', '[INICIO] ' . '[USUARIO CONECTADO: ' . 'usuario' . '][ACCION: buscarRolUser()] ');
        $this->load->helper(array('text','form','url'));
        $this->load->library('pagination'); //Cargamos la librería de paginación
        $this->load->model('rol/rol_model'); //cargamos el modelo
        $data['page_title'] = "Crear Usuario";
	$cedula = empty($_POST['cedula']) == 1 ? 'NULL' : $_POST['cedula'];
	$user = empty($_POST['user']) == 1 ? NULL : $_POST['user'];

        //Obtener datos de la tabla 'Rol'	
        $usuario = $this->paginationUser($this->rol_model, $cedula, $user);
        $data['userRol'] = $usuario->result();
        $data['numReg'] = $usuario->num_rows();   
        //Lista de cedula de empleados
        $empleados = $this->rol_model->buscarCedEmp();
        $data['cedulas'] = $empleados->result();
        $data['num_emp'] = $empleados->num_rows();
        $data['roles'] = $this->rol_model->buscarRoles()->result();
        //load de vistas	
        log_message('info', '[FIN] ' . '[USUARIO CONECTADO: ' . 'usuario' . '][ACCION: buscarRolUser()] ');
        $this->load->view('rol/crearUser_view', $data); //llamada a la vista, que crearemos posteriormente

    }
    
    /*
     * Funcion encargada de buscar los empleado por cedula
     */
    function buscarEmp()

    {       
        //$this->load->library('session');
        log_message('info', '[INICIO] ' . '[USUARIO CONECTADO: ' . 'usuario' . '][ACCION: buscarEmp()] ');
        $this->load->helper(array('text','form','url'));
        $this->load->model('rol/rol_model'); //cargamos el modelo
        header("Access-Control-Allow-Origin: *");
	$cedula = $_POST['cedula'];
        
        //load de vistas	
        log_message('info', '[FIN] ' . '[USUARIO CONECTADO: ' . 'usuario' . '][ACCION: buscarEmp()] ');
        header('content-type: application/json');
        echo json_encode(array('emp' => $this->rol_model->buscarEmp($cedula)->row())); 
    }
    
    /*
     * Funcion encargada de realizar la paginacion de la asignacion de servicios
     * @param  $modelo :  Modelo a usar
     * @param  $cedula :  Cedula del usuario a buscar
     * @param  $user :  Nombre del usuario a buscar
     */
    function paginationUser($modelo, $cedula, $user){
        log_message('info', '[INICIO] ' . '[USUARIO CONECTADO: ' . 'usuario' . '][ACCION: paginationUser()]');
        $config['base_url'] = base_url().'/Rol/Rol_Controller/buscarRolUser'; // parametro base de la aplicación, si tenemos un .htaccess nos evitamos el index.php
        $config['total_rows'] = $modelo->buscarTotalRolUser($cedula, $user); 
        $config['num_links'] = 2; //Numero de links mostrados en la paginación
        $config['per_page'] = 10;
        $this->pagination->initialize($config);         
        $servicio =  $modelo->buscarRolUser($cedula, $user);
        log_message('info', '[FIN] ' . '[USUARIO CONECTADO: ' . 'usuario' . '][ACCION: paginationUser()]');
        
        return $servicio;
		
    }    
    
    /*
     * Funcion encargada del ingreso de un usuario con su rol
     */
    function insertUserRol() {
        log_message('info', '[INICIO] ' . '[USUARIO CONECTADO: ' . 'usuario' . '][ACCION: insertUserRol()] [USUARIO: ' . $_POST['ced'] . ']');
        $this->load->model('rol/rol_model');
        //recogemos los datos obtenidos por POST
        $data['cedula'] = $_POST['ced'];
        $data['codRol'] = $_POST['rolesEmp'];
        $empleado = $this->rol_model->buscarEmp($_POST['ced'])->row();
        $data['user'] = substr($empleado->nombre, 0, 2).$empleado->apellido;
        $data['codSuc'] = $empleado->cod_sucursal;
        $data['codEmp'] = $empleado->cod_emp;        	
        //llamamos al modelo, concretamente a la funci�n insert() para que nos haga el insert en la base de datos.
        $data['ultCod'] = $this->rol_model->ultimoUser()->row()->ultCod == NULL ? 0 : $this->rol_model->ultimoUser()->row()->ultCod;
        $this->rol_model->insertUserRol($data);
        log_message('info', '[FIN] ' . '[USUARIO CONECTADO: ' . 'usuario' . '][ACCION: insertUserRol()] [USUARIO: ' . $_POST['ced'] . ']');
        //volvemos a visualizar la tabla
        $this->buscarRolUser();
    }
    
    /*
    * Funcion encargada de la eliminacion de un usuario
    */
    function deleteUserRol() {        
        log_message('info', '[INICIO] ' . '[USUARIO CONECTADO: ' . 'usuario' . '][ACCION: deleteUserRol()] [ELIMINAR: '. $_POST['eliminarProd'].']');        
        //obtenemos el nombre
        $data['codUser'] = $_POST['eliminarProd'];
        //cargamos el modelo y llamamos a la funci�n baja(), pasandole el codigo del registro a eliminar.
        $this->load->model('rol/rol_model');
        $this->rol_model->deleteUserRol($data);
        //mostramos la vista de nuevo.
        log_message('info', '[FIN] ' . '[USUARIO CONECTADO: ' . 'usuario' . '][ACCION: deleteUserRol()] [ELIMINAR: '. $_POST['eliminarProd'].']');   
        $this->buscarRolUser();
    }
    
    /*
    * Funcion encargada de modificar un rol de un usuario
    */
    function updateUserRol() {        
        log_message('info', '[INICIO] ' . '[USUARIO CONECTADO: ' . 'usuario' . '][ACCION: updateUserRol()] [MODIFICAR: '. $_POST['eliminarProd'].']');        
        //obtenemos el nombre
        $data['codUser'] = $_POST['eliminarProd'];
        $codUser = $_POST['eliminarProd'];
        $data['codRol'] = $_POST['rolEmp'.$codUser];
        $data['estado'] = $_POST['estado'.$codUser];
        //cargamos el modelo y llamamos a la funci�n baja(), pasandole el codigo del registro a eliminar.
        $this->load->model('rol/rol_model');
        $this->rol_model->updateUserRol($data);
        //mostramos la vista de nuevo.
        log_message('info', '[FIN] ' . '[USUARIO CONECTADO: ' . 'usuario' . '][ACCION: updateUserRol()] [MODIFICAR: '. $_POST['eliminarProd'].']');   
        $this->buscarRolUser();
    }
}

?>