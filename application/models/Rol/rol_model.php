<?php
 class Rol_model extends CI_Model {

	function Rol_model() {
		 parent::__construct(); //llamada al constructor de Model.
	 }
         
         /*
          * Querys de departamento
          */
	
         /*
          * Se encarga de realizar una consulta de los roles por
          * codigo y nombre con paginacion
          * @param  $codigo :  Codigo del rol a buscar
          * @param  $nombre :  Tipo de rol
          */
        function buscarRol($codigo, $nombre)

        {   
            $this->db->select('r.*,  (
                                        SELECT count(1)
                                        FROM  `rol_servicio` s
                                        WHERE s.cod_rol = r.cod_rol
                                     )cant_reg');
            $this->db->from('rol r');
            $this->db->where('((' . $codigo .' is null) or (cod_rol = ' . $codigo .'))and (("'. $nombre .'" is null or tipo_rol LIKE "%' . $nombre .'%"))');
            $this->db->where('estado', 'A');
            $this->db->limit(10, $this->uri->segment(20));
            $contacto = $this->db->get();    
            return $contacto;
        }	
	 
        /*
         * Busca el total de la consulta de roles sin paginacion
         */
        function buscarTotalRol($codigo, $nombre)

        {   
            $this->db->select('r.*,  (
                                        SELECT count(1)
                                        FROM  `rol_servicio` s
                                        WHERE s.cod_rol = r.cod_rol
                                     )cant_reg');
            $this->db->from('rol r');
            $this->db->where('((' . $codigo .' is null) or (cod_rol = ' . $codigo .'))and (("'. $nombre .'" is null or tipo_rol LIKE "%' . $nombre .'%"))');
            $this->db->where('estado', 'A');
            $numReg = $this->db->get();
            return $numReg->num_rows();

        }	
	 
        /*
         * Busca el codigo del ultimo departamento a ingresar
         */
        function ultimoRol($codigo, $nombre)

        {   
            $this->db->select('(max(cod_rol)+1) ultCod');
            $this->db->from('rol');
            $contacto = $this->db->get();
            return $contacto;

        } 
	 
        /*
         * Inserta un rol
         */
	function insertRol($data) {		
		 $this->db->set('cod_rol', $data['codigoNew']);
		 $this->db->set('tipo_rol', $data['nombre']);
		 $this->db->set('descr_rol', $data['descripcion']);
		 $this->db->set('estado', 'A');
		 $this->db->insert('rol'); //Nombre de la tabla
	 }	 
		
         /*
          * Elimina un rol
          */
	function delete($codigoElim) {
		 $this->db->set('estado', 'E');
		 $this->db->where('cod_rol', $codigoElim);
		 $this->db->update('rol'); //Nombre de la tabla
	 }
         
         //************************************ASIGNACION DE SERVICIOS A ROLES *************************************
         
         /*
          * Se encarga de realizar una consulta de los roles por
          * codigo y nombre con paginacion
          */
        function buscarRoles()

        {   
            $this->db->select('*');
            $this->db->from('rol');
            $this->db->where('estado', 'A');
            $contacto = $this->db->get();
            return $contacto;
        }
        
         /*
          * Busca los servicios existentes en bdd
          */         
        function buscarServicios($codigo)

        {  
            $this->db->select('s.*');
            $this->db->from('servicio s');
            $this->db->where('s.cod_servicio NOT IN (
                                                        SELECT cod_servicio
                                                        FROM rol_servicio
                                                        WHERE cod_rol = '. $codigo . 
                                                     ')');    
            $this->db->where('ruta != ""');
            $servicio = $this->db->get();
            return $servicio;
        }	
	 
        /*
         * Busca el total de la consulta de roles sin paginacion
         */
        function buscarServRol($codigo)

        {   
            $this->db->select('s.*');
            $this->db->from('servicio s');
            $this->db->join('rol_servicio rs', 's.cod_servicio = rs.cod_servicio');
            $this->db->where('((' . $codigo .' is null) or (rs.cod_rol = ' . $codigo .'))');
            $servicio = $this->db->get();
            return $servicio;

        }	
	 
        /*
         * Busca el total de la consulta de roles sin paginacion
         */
        function buscarTotalServ($codigo)

        {   
            $this->db->select('s.*');
            $this->db->from('servicio s');
            $this->db->join('rol_servicio rs', 's.cod_servicio = rs.cod_servicio');
            $this->db->where('((' . $codigo .' is null) or (rs.cod_rol = ' . $codigo .'))');
            $numReg = $this->db->get();
            return $numReg->num_rows();

        }	 
	 
        /*
         * Inserta un servicio a un rol
         */
	function insertServRol($data) {		
		 $this->db->set('cod_servicio', $data['codServ']);
		 $this->db->set('cod_rol', $data['codRol']);
		 $this->db->insert('rol_servicio'); //Nombre de la tabla
	 }	 
		
         /*
          * Elimina un servicio de un rol
          */
	function deleteServRol($data) {
		 $this->db->where('cod_servicio', $data['codServ']);
		 $this->db->where('cod_rol', $data['codRol']);
		 $this->db->delete('rol_servicio'); //Nombre de la tabla
	 }	
}
?>
