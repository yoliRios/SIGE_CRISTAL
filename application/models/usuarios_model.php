<?php
 class Usuarios_model extends CI_Model {

	function Usuarios_model() {
		 parent::__construct(); //llamada al constructor de Model.
	 }
	
	function getData() {
		 $usuarios = $this->db->get('usuarios'); //obtenemos la tabla 'USUARIOS'. db->get('nombre_tabla') equivale a SELECT * FROM nombre_tabla.
		 return $usuarios->result(); //devolvemos el resultado de lanzar la query.
	 }	 
	 
	function insert($data) {		
		 $this->db->set('Nombre', $data['nombre']);
		 $this->db->set('Email', $data['email']);
		 $this->db->set('Telefono', $data['telefono']);
		 $this->db->set('Direccion', $data['direccion']);
		 $this->db->insert('cliente'); //Nombre de la tabla
	 }	 
		 
	function delete($nombre) {
		 $this->db->where('Nombre', $nombre);
		 $this->db->delete('cliente'); //Nombre de la tabla
	 }

	 // Otra forma de hacer una consulta
	 function obtenerContacto($idContacto) {
		$this->db->select('Nombre, Email, Telefono, Direccion, cod_cliente');
		$this->db->from('cliente');
		$this->db->where('cod_cliente = ' . $idContacto);
		$contacto = $this->db->get();
		return $contacto->result();
	}	
	
	function update($data) {
		 $this->db->set('Nombre', $data['nombre']);
		 $this->db->set('Email', $data['email']);
		 $this->db->set('Telefono', $data['telefono']);
		 $this->db->set('Direccion', $data['direccion']);
		 $this->db->where('cod_cliente', $data['id']);
		 $this->db->update('cliente'); //Nombre de la tabla
	 }
}
?>