<?php

 class Auditoria_model extends CI_Model {

	function Auditoria_model() {
		 parent::__construct(); //llamada al constructor de Model.
	 }         
         /**
          * Metodo que encarga de registrar en la BD en la tabla auditoria una operacion.
          * @param  $fecha : fecha de la ejecucion de la operacion
          * @param  $tipo_operacion : tipo de operacion realizada [Eliminar, Actualizar, Insertar]
          * @param  $usuario :  Usuario de session que realizo la operacion
          * @param  $cant_reg :  Cantidad de registros afectados por la operacion
          * @param  $funcionalidad : Nombre de la funcionalidad en la que se realizo la operacion
          */         
         function registrar_operacion($fecha, $tipo_operacion, $usuario, $cant_reg, $funcionalidad){
         //    $this->load->library('session');
             log_message('info', '[INICIO] ' . '[USUARIO CONECTADO: ][ACCION: model registrar_operacion('.$fecha.' '.$tipo_operacion.' '. $usuario.' '. $cant_reg.' '.$funcionalidad.')]');
             $this->db->set('fecha_operacion',$fecha);
             $this->db->set('operacion', $tipo_operacion);
             $this->db->set('usuario', $usuario);
             $this->db->set('cant_registros', $cant_reg);
             $this->db->set('funcionalidad', $funcionalidad);
             $this->db->insert('auditoria'); 
             log_message('info', '[FIN] ' . '[USUARIO CONECTADO: ][ACCION: model registrar_operacion()]');
         }
         /**
          * Metodo que realiza la consuta de las auditorias del sistema
          * @return $data arreglo con filtro a buscar 
          * @return $paginar variable que indica si se realizara o no la paginacion 
          */
         function buscar_auditoria($data, $paginar){
             
             log_message('info', '[INICIO] ' . '[USUARIO CONECTADO: ][ACCION: model buscar_auditoria()]');
             $this->db->select('*');
             $this->db->from('auditoria');
             $this->db->where('(('. $data["fecha_desde"] .' is null) or (fecha_operacion BETWEEN "' . $data["fecha_desde"] .'" AND DATE_ADD("' . $data["fecha_hasta"] .'", INTERVAL 1 DAY)))');
             $this->db->where('(("'. $data["tipo_operacion"] .'" = "NULL") or (operacion = "' . $data["tipo_operacion"] .'" ))');
              $this->db->order_by('fecha_operacion', 'asc');  
             if ($paginar == "P"){                    
                 $this->db->limit(10, $this->uri->segment(4));
             }
             $operaciones = $this->db->get();
             log_message('info', '[FIN] ' . '[USUARIO CONECTADO: ][ACCION: model buscar_auditoria()]');
             return $operaciones;             
         }
 }
?>
