<?PHP

class Inicio extends CI_Controller{

    public function __construct() {

            parent::__construct();

    }

    function index()

    {
        $this->load->helper('url');        
        $this->load->view('inicio_view');
        //$this->load->view('carga');
        log_message ('info', 'haciendo una prueba hoy'); 
        

    }

    /*
     * Realiza la conexion con la pagina principal
     */
     function cargaLogin()
    {        
        $this->load->helper(array('form', 'url', 'html'));
        $this->load->library('form_validation');
        $this->load->view('php/login');
        log_message ('info', 'Ingreso al sistema2'); 
    }
   
   
    /*
     * Funcion encargada de conectar un usuario
     */
    function ingresar()
    { 
        $this->load->helper(array('form', 'url', 'html'));
        $this->load->library('form_validation');
        $this->form_validation->set_rules('usuario', 'usuario','trim|required|min_length[5]');
        $this->form_validation->set_rules('password', 'password','trim|required|min_length[10]|md5');
        $this->form_validation->set_message('min_length','La minima longitud es de 5 en usuario y 10 en la contraseña');
        $this->form_validation->set_message('required','El ingreso del campo es requerido'); 
        
        if ($this->form_validation->run('signup') == FALSE)
        {
            $this->load->view('php/login');
            log_message ('info', 'False'); 
        }
        else
        {
            $data['usuario'] = $_POST['usuario'];
            $data['password'] = $_POST['password'];
            //llamamos al modelo, concretamente a la funci�n insert() para que nos haga el insert en la base de datos.
            $this->load->model('inicio_model');
            $usuario = $this->inicio_model->devuelveUsuario($data);
            if($usuario->num_rows() > 0){
                $this->load->library('session');
                //session de usuario;
                $data['usuario'] = $usuario->result();
                $this->session->set_userdata('usuario' , $_POST['usuario']);
                $this->carga_login();
                log_message ('info', 'ingresar session: '.$this->session->userdata('usuario'));                
            }else{ 
          
                $data['mensajeError'] = "Disculpe el usuario ingresado no existe";
                $this->load->view('inicio_view', $data);
                log_message ('info', 'usuario no existe'); 
            }
        }
    }
    
    function cargarUser(){
        
        $this->load->helper('url');        

        $this->load->model('rol/menu_model'); //cargamos el modelo	
	$usuario = 'Admin';
        $menu = $this->menu_model->buscarMenu($usuario);
        $data['menu'] = $menu->result();
        
        $this->load->view('carga', $data);
        
    }
    
    function subMenu(){
        
        log_message('info', '[INICIO] ' . '[USUARIO CONECTADO: ' . 'usuario' . '][ACCION: subMenu()]');
        $this->load->helper('url');        

        $this->load->model('rol/menu_model'); //cargamos el modelo	
	$usuario = 'Admin';
	$servicio = $_GET['opcion'];
        $menu = $this->menu_model->buscarSubMenu($usuario, $servicio);
        $data['subMenu'] = $menu->result();
        
        $this->load->view('rol/menu_view', $data);
        log_message('info', '[FIN] ' . '[USUARIO CONECTADO: ' . 'usuario' . '][ACCION: subMenu()]');
        
    }
    
}

?>
