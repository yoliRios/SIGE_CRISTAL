<?php
 class Inicio_model extends CI_Model {

	function Inicio_model() {
		 parent::__construct(); //llamada al constructor de Model.
	 }
	 
        function buscarDestino()
        {   
            $this->db->select('P.NOMBRE_PAIS pais, E.NOMBRE_ESTADO estado, C.NOMBRE_CIUDAD ciudad');
            $this->db->from('ORIGEN_DESTINO OD');
            $this->db->join('PAIS P', 'OD.ID_PAIS = P.ID_PAIS', 'INNER');
            $this->db->join('ESTADO E', 'OD.ID_ESTADO = E.ID_ESTADO', 'INNER');
            $this->db->join('CIUDAD C', 'OD.ID_CIUDAD = C.ID_CIUDAD', 'INNER');
            $contacto = $this->db->get();
            return $contacto;

        }
	 
        function devuelveUsuario($data) {
            $this->db->select('*');
            $this->db->from('usuarios');
            $this->db->where('clave',$data['password']);
            $this->db->where('usuario',$data['usuario']);
            $usuario = $this->db->get();
            return $usuario;
        }	
	 
        function crearCuenta($data) {
            $this->db->select('(max(id_usuario)+1) id_nuevo');
            $this->db->from('usuario');
            $id = $this->db->get()->row()->id_nuevo;
            
            log_message ('info', $id);
        
            $this->db->set('id_usuario', $id);	
            $this->db->set('nombre', UPPER($data['nombre']));
            $this->db->set('apellido', UPPER($data['apellido']));
            $this->db->set('cedula', $data['cedula']);
            $this->db->set('telefono', $data['telefono']);
            $this->db->set('correo', UPPER($data['email']));
            $this->db->set('contrasena',$data['password']);
            $this->db->set('usuario', UPPER($data['usuario']));
            $this->db->set('tipo', 'U');
            $this->db->insert('usuario'); //Nombre de la tabla
        }	
	 
}
?>
