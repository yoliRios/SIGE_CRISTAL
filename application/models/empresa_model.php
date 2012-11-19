<?php
 class Empresa_model extends CI_Model {

	function Empresa_model() {
		 parent::__construct(); //llamada al constructor de Model.
	 }
         
         /*
          * Querys de departamento
          */
	
         /*
          * Se encarga de realizar una consulta de los departamentos por
          * codigo y nombre con paginacion
          * @param  $codigo :  Codigo del deparatamento a buscar
          * @param  $nombre :  Nombre del deparatmento
          */
        function buscarDepartamento($codigo, $nombre)

        {   
            $this->db->select('d.*,  (
                                        SELECT count(1)
                                        FROM  `sucursal_departamento` S
                                        WHERE s.cod_dpto = d.cod_dpto
                                     )cant_reg');
            $this->db->from('departamento d');
            $this->db->where('((' . $codigo .' is null) or (cod_dpto = ' . $codigo .'))and (("'. $nombre .'" is null or nombre_dpto LIKE "%' . $nombre .'%"))');
            $this->db->where('cod_dpto !=', '0');
            $this->db->limit(10, $this->uri->segment(3));
            $contacto = $this->db->get();
            return $contacto;

        }	
	 
        /*
         * Busca el total de la consulta de departamento sin paginacion
          * @param  $codigo :  Codigo del deparatamento a buscar
          * @param  $nombre :  Nombre del deparatmento
         */
        function buscarTotalDepto($codigo, $nombre)

        {   
            $this->db->select('d.*,  (
                                        SELECT count(1)
                                        FROM  `sucursal_departamento` S
                                        WHERE s.cod_dpto = d.cod_dpto
                                     )cant_reg');
            $this->db->from('departamento d');
            $this->db->where('((' . $codigo .' is null) or (cod_dpto = ' . $codigo .'))and (("'. $nombre .'" is null or nombre_dpto LIKE "%' . $nombre .'%"))');
            $this->db->where('cod_dpto !=', '0');
            $numReg = $this->db->get();
            return $numReg->num_rows();

        }	
	 
        /*
         * Busca el codigo del ultimo departamento a ingresar
          * @param  $codigo :  Codigo del deparatamento a buscar
          * @param  $nombre :  Nombre del deparatmento
         */
        function ultimoDepartamento($codigo, $nombre)

        {   
            $this->db->select('(max(cod_dpto)+1) ultCod');
            $this->db->from('departamento d');
            $contacto = $this->db->get();
            return $contacto;

        } 
	 
        /*
         * Inserta un departamento
          * @param  $data :  Arreglo con la informacion a insertar del departamento
         */
	function insertarDpto($data) {		
		 $this->db->set('cod_dpto', $data['codigoNew']);
		 $this->db->set('nombre_dpto', $data['nombre']);
		 $this->db->set('estado', 'A');
		 $this->db->insert('departamento'); //Nombre de la tabla
	 }	 
		
         /*
          * Desactiva un departamento
          * @param  $codigoElim :  codigo del departamento a desactivar
          */
	function desactivarDpto($codigoElim) {
		 $this->db->set('estado', 'E');
		 $this->db->where('cod_dpto', $codigoElim);
		 $this->db->update('departamento'); //Nombre de la tabla
	 }
		
         /*
          * Modifica un departamento especifico
          * @param  $data :  Arreglo con inf. a actualizar
          */
	function modificarDpto($data) {
		 $this->db->set('estado', $data['estado']);
		 $this->db->set('nombre_dpto', $data['nombreDpto']);
		 $this->db->where('cod_dpto', $data['codDpto']);
		 $this->db->update('departamento'); //Nombre de la tabla
	 }
         
         
         
         
         //************************************ ADMINISTRACION DE SUCURSALES *************************************
	
         /*
          * Se encarga de realizar una consulta de las sucursales por
          * codigo y nombre con paginacion
          */
        function buscarSucursal($codigo, $nombre)

        {   
            $this->db->select('s.*');
            $this->db->from('sucursal s');
            $this->db->where('((' . $codigo .' is null) or (cod_sucursal = ' . $codigo .'))and (("'. $nombre .'" is null or nombre_sucursal LIKE "%' . $nombre .'%"))');
            $this->db->where('estado', 'A');
            $this->db->limit(10, $this->uri->segment(3));
            $contacto = $this->db->get();
            return $contacto;

        }	
	 
        /*
         * Busca el total de la consulta de sucursales sin paginacion
         */
        function buscarTotalSucursal($codigo, $nombre)

        {   
            $this->db->select('s.*');
            $this->db->from('sucursal s');
            $this->db->where('((' . $codigo .' is null) or (cod_sucursal = ' . $codigo .'))and (("'. $nombre .'" is null or nombre_sucursal LIKE "%' . $nombre .'%"))');
            $this->db->where('estado', 'A');
            $numReg = $this->db->get();
            return $numReg->num_rows();

        }	
	 
        /*
         * Busca el codigo de la ultima sucursal a ingresar
         */
        function ultimaSucursal($codigo, $nombre)

        {   
            $this->db->select('(max(cod_sucursal)+1) ultCod');
            $this->db->from('sucursal');
            $contacto = $this->db->get();
            return $contacto;

        } 
	 
        /*
         * Inserta una sucursal
         */
	function insertSucursal($data) {		
		 $this->db->set('cod_sucursal', $data['codigoNew']);
		 $this->db->set('nombre_sucursal', $data['nombre']);
		 $this->db->set('direccion', $data['direccion']);
		 $this->db->set('rif', $data['rif']);
		 $this->db->set('telefono', $data['telefono']);
		 $this->db->set('email', $data['email']);
		 $this->db->set('estado', 'A');
		 $this->db->insert('sucursal'); //Nombre de la tabla
	 }	 
		
         /*
          * Elimina una sucursal
          */
	function deleteSucursal($codigoElim) {
		 $this->db->set('estado', 'E');
		 $this->db->where('cod_dpto', $codigoElim);
		 $this->db->update('departamento'); //Nombre de la tabla
	 }
}
?>
