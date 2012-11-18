<?PHP

class Email extends CI_Model {

    public function __construct() {

            parent::__construct();	

    }

    function email($correo, $titulo, $tipoMensaje, $cuerpo){     
        
        log_message('info', '[INICIO] ' . '[USUARIO CONECTADO: ' . 'usuario' . '][ACCION: email()]');
        $config['protocol']    = "smtp";
        $config['smtp_host']    = "ssl://smtp.googlemail.com";
        $config['smtp_port']    = 465;
        $config['smtp_user']    = "suhjail.caldera@gmail.com";
        $config['smtp_pass']    = "SUHJAIL20155564";   

        $config['charset']    = "utf-8";
        $config['newline']    = "\r\n";
        $config['mailtype'] = $tipoMensaje; // or html
        $config['validation'] = TRUE; // bool whether to validate email or not
        
        $this->load->library('email');

        $this->email->initialize($config);

        $this->email->from("suhjail.caldera@gmail.com", "Administrador SIGE_CRISTAL");

        $this->email->to($correo); 

        $this->email->subject($titulo);
        $this->email->message($cuerpo);  

        $this->email->send();
        //echo $this->email->print_debugger();
        log_message('info', '[FIN] ' . '[USUARIO CONECTADO: ' . 'usuario' . '][ACCION: email()]');
    }

}

?>
