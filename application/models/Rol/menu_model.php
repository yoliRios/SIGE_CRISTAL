<?php
 class Menu_model extends CI_Model {

	function Menu_model() {
		 parent::__construct(); //llamada al constructor de Model.
	 }
         
         /*
          * Querys del menu
          */
	
         /*
          * Se encarga de realizar una consulta del menu principal
          * por el rol que contenga el usuario
          * @param  $usuario :  Usuario que ingreso
          */
        function buscarMenu($usuario)

        {   
            $this->db->select('s.*');
            $this->db->from('usuario u');
            $this->db->join('rol_servicio rs', 'u.cod_rol = rs.cod_rol');
            $this->db->join('servicio s', 'rs.cod_servicio = s.cod_servicio');
            $this->db->where('u.usuario', $usuario);
            $this->db->where('s.cod_servicio = s.cod_serv_P');
            $contacto = $this->db->get();    
            return $contacto;
        }	
	
         /*
          * Se encarga de buscar el sub/menu de uno principal
          * @param  $usuario :  Usuario que ingreso
          * @param  $servicio :  Servicio padre seleccionado por el usuario
          */
        function buscarSubMenu($usuario, $servicio)

        {   
            $this->db->select('s.*');
            $this->db->from('usuario u');
            $this->db->join('rol_servicio rs', 'u.cod_rol = rs.cod_rol');
            $this->db->join('servicio s', 'rs.cod_servicio = s.cod_servicio');
            $this->db->where('u.usuario', $usuario);
            $this->db->where('s.cod_serv_P', $servicio);
            $this->db->where('s.cod_servicio != ', $servicio);
            $contacto = $this->db->get();    
            return $contacto;
        }	         
}
?>
