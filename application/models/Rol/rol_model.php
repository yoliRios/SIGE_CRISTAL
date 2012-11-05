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
                                        FROM  `usuario` s
                                        WHERE s.cod_rol = r.cod_rol
                                     )cant_reg');
            $this->db->from('rol r');
            $this->db->where('((' . $codigo .' is null) or (cod_rol = ' . $codigo .'))and (("'. $nombre .'" is null or tipo_rol LIKE "%' . $nombre .'%"))');
            //$this->db->where('estado', 'A');
            $this->db->limit(10, $this->uri->segment(20));
            $contacto = $this->db->get();    
            return $contacto;
        }	
	 
        /*
         * Busca el total de la consulta de roles sin paginacion
          * @param  $codigo :  Codigo del rol a consultar
          * @param  $nombre :  Nombre del rol a consultar
         */
        function buscarTotalRol($codigo, $nombre)

        {   
            $this->db->select('r.*,  (
                                        SELECT count(1)
                                        FROM  `usuario` s
                                        WHERE s.cod_rol = r.cod_rol
                                     )cant_reg');
            $this->db->from('rol r');
            $this->db->where('((' . $codigo .' is null) or (cod_rol = ' . $codigo .'))and (("'. $nombre .'" is null or tipo_rol LIKE "%' . $nombre .'%"))');
            //$this->db->where('estado', 'A');
            $numReg = $this->db->get();
            return $numReg->num_rows();

        }	
	 
        /*
         * Busca el codigo del ultimo rol a ingresar
          * @param  $codigo :  Codigo del rol a consultar
          * @param  $nombre :  Nombre del rol a consultar
         */
        function ultimoRol($codigo, $nombre)

        {   
            $this->db->select('(max(cod_rol)+1) ultCod');
            $this->db->from('rol');
            $contacto = $this->db->get();
            return $contacto;

        } 
	 
        /*
         * Inserta un rol especifico
          * @param  $data :  Arreglo con la informacion a insertar en la tabla rol
         */
	function insertRol($data) {		
		 $this->db->set('cod_rol', $data['codigoNew']);
		 $this->db->set('tipo_rol', $data['nombre']);
		 $this->db->set('descr_rol', $data['descripcion']);
		 $this->db->set('estado', 'A');
		 $this->db->insert('rol'); //Nombre de la tabla
	 }	 
		
         /*
          * Elimina un rol especifico
          * @param  $codigoElim :  Codigo del rol a eliminar
          */
	function delete($codigoElim) {
		 $this->db->set('estado', 'E');
		 $this->db->where('cod_rol', $codigoElim);
		 $this->db->update('rol'); //Nombre de la tabla
	 }
		
         /*
          * Modifica un rol especifico
          * @param  $data :  Arreglo con inf. a eliminar
          */
	function updateRol($data) {
		 $this->db->set('estado', $data['estado']);
		 $this->db->where('cod_rol', $data['codRol']);
		 $this->db->update('rol'); //Nombre de la tabla
	 }
         
         //************************************ASIGNACION DE SERVICIOS A ROLES *************************************
         
         /*
          * Se encarga de realizar una consulta de los roles existentes
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
          * Busca los servicios existentes en bdd que no pertenezcan al rol
          * buscado
          * @param  $codigo :  Codigo del rol a buscar
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
         * Busca los servicios pertenecientes a un rol especifico
         * @param  $codigo :  Codigo del rol a buscar
         */
        function buscarServRol($codigo)

        {   
            $this->db->select('s.*');
            $this->db->from('servicio s');
            $this->db->join('rol_servicio rs', 's.cod_servicio = rs.cod_servicio');
            $this->db->where('((' . $codigo .' is null) or (rs.cod_rol = ' . $codigo .'))');
            $this->db->limit(10, $this->uri->segment(20));
            $servicio = $this->db->get();
            return $servicio;

        }	
	 
        /*
         * Busca los servicios pertenecientes a un rol especifico sin paginacion
         * @param  $codigo :  Codigo del rol a buscar
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
         * Inserta un servicio a un rol especifico
         * @param  $data :  Arreglo con inf. a insertar en rol_servicio
         */
	function insertServRol($data) {		
		 $this->db->set('cod_servicio', $data['codServ']);
		 $this->db->set('cod_rol', $data['codRol']);
		 $this->db->insert('rol_servicio'); //Nombre de la tabla
	 }	 
		
         /*
          * Elimina un servicio de un rol especifico
         * @param  $data :  Arreglo con inf. a insertar en rol_servicio
          */
	function deleteServRol($data) {
		 $this->db->where('cod_servicio', $data['codServ']);
		 $this->db->where('cod_rol', $data['codRol']);
		 $this->db->delete('rol_servicio'); //Nombre de la tabla
	 }	
         
         //************************************ASIGNACION DE ROLES A USUARIOS *************************************
         
         /*
          * Se encarga de realizar una consulta de las cedulas de los rmpleados
          * sin usuarios
          */
        function buscarCedEmp()

        {   
            $this->db->select('cedula');
            $this->db->from('empleado');
            $this->db->where('estado', 'A');
            $this->db->where('cedula NOT IN (
                                            SELECT cedula
                                            FROM usuario
                                            )');
            $contacto = $this->db->get();
            return $contacto;
        }
        
         /*
          * Busca los usuarios existentes y sus roles
          * @param  $cedula :  Cedula del usuario a buscar
          * @param  $user :  Nombre del suario a buscar
          */         
        function buscarRolUser($cedula, $user)

        {   
           
            $this->db->select('u.*, e.nombre, e.apellido, r.tipo_rol');
            $this->db->from('usuario u');
            $this->db->join('empleado e', 'e.cedula = u.cedula');
            $this->db->join('rol r', 'r.cod_rol = u.cod_rol');
            $this->db->where('e.estado = "A"');
            $this->db->where('((' . $cedula .' is null) or (e.cedula = ' . $cedula .'))and (("'. $user .'" is null or u.usuario LIKE "%' . $user .'%"))');
            $this->db->limit(10, $this->uri->segment(20));
            $servicio = $this->db->get();
            return $servicio;

        }	
	 
        /*
         * Busca los servicios pertenecientes a un rol especifico sin paginacion
         * @param  $cedula :  Cedula del usuario a buscar
         * @param  $user :  Nombre del suario a buscar
         */
        function buscarTotalRolUser($cedula, $user)

        {               
            $this->db->select('u.*, e.nombre, e.apellido, r.tipo_rol');
            $this->db->from('usuario u');
            $this->db->join('empleado e', 'e.cedula = u.cedula');
            $this->db->join('rol r', 'r.cod_rol = u.cod_rol');
            $this->db->where('e.estado = "A"');
            $this->db->where('((' . $cedula .' is null) or (e.cedula = ' . $cedula .'))and (("'. $user .'" is null or u.usuario LIKE "%' . $user .'%"))');
            $rolUser = $this->db->get();
            return $rolUser->num_rows();

        }
         /*
          * Se encarga de realizar una consulta de un empleado especifico
         * @param  $cedula :  Cedula del empleado a buscar
          */
        function buscarEmp($cedula)

        {   
            $this->db->select('*');
            $this->db->from('empleado');
            $this->db->where('estado', 'A');
            $this->db->where('cedula', $cedula);
            $empleado = $this->db->get();
            return $empleado;
        }	
	 
        /*
         * Busca el codigo del ultimo usuario a ingresar
         */
        function ultimoUser()

        {   
            $this->db->select('(max(cod_usuario)+1) ultCod');
            $this->db->from('usuario');
            $contacto = $this->db->get();
            return $contacto;

        } 
	 
        /*
         * Inserta un usuario con su rol
         * @param  $data :  Arreglo con la informacion a insertar en la tabla 
         * usuario
         */
	function insertUserRol($data) {		
		 $this->db->set('cod_usuario', $data['ultCod']);
		 $this->db->set('cod_rol', $data['codRol']);
		 $this->db->set('cod_sucursal', $data['codSuc']);
		 $this->db->set('cod_emp', $data['codEmp']);
		 $this->db->set('cedula', $data['cedula']);
		 $this->db->set('usuario', $data['user']);
		 $this->db->set('clave', MD5($data['user']));
		 $this->db->set('estado', 'A');
		 $this->db->insert('usuario'); //Nombre de la tabla
	 }
		
         /*
          * Elimina un usuario especifico
          * @param  $data :  Arreglo con inf. a eliminar
          */
	function deleteUserRol($data) {
		 $this->db->set('estado', 'E');
		 $this->db->where('cod_usuario', $data['codUser']);
		 $this->db->update('usuario'); //Nombre de la tabla
	 }
		
         /*
          * Modifica un rol de un usuario especifico
          * @param  $data :  Arreglo con inf. a eliminar
          */
	function updateUserRol($data) {
		 $this->db->set('cod_rol', $data['codRol']);
		 $this->db->set('estado', $data['estado']);
		 $this->db->where('cod_usuario', $data['codUser']);
		 $this->db->update('usuario'); //Nombre de la tabla
	 }
         
         
}
?>
