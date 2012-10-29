<?php

class Usuarios extends CI_Controller

{

    function index()

    {   
        
        $data['page_title'] = "Usuarios";
        $this->load->view('GUI/usuarios_view', $data); //llamada a la vista, que crearemos posteriormente
        log_message ('info', 'haciendo una prueba hoy'); 

    }
    

}

?>