<?PHP

class Inicio extends CI_Controller

{

    function index()

    {
        $this->load->helper('url');        

        $this->load->view('inicio');
        //$this->load->view('carga');
        log_message ('info', 'haciendo una prueba hoy'); 
        

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
