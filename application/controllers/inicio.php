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

        $this->load->view('carga');
        
    }

}

?>
