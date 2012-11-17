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
          * Metodo que devuelve todos los registros de la tabla auditoria
          * @return $operaciones varable que contiene los registros 
          */
        function get_auditoria($paginar) {
           // $this->load->library('session');
            log_message('info', '[INICIO] ' . '[USUARIO CONECTADO: ][ACCION: model get_auditoria()]');
            $this->db->select('*');
            $this->db->from('auditoria');
            $this->db->order_by("fecha_operacion", "asc"); 
            if ($paginar == "P"){                    
                $this->db->limit(10, $this->uri->segment(20));
            }
            $operaciones = $this->db->get();
            log_message('info', '[FIN] ' . '[USUARIO CONECTADO: ][ACCION: model get_auditoria()]');
            return $operaciones;
	 }        
         /**
          * Metodo que realiza la consuta por tipo de operacion
          * @return $operaciones variable que contiene los registros 
          */
         function buscar_operaciones($data, $paginar){
           //  $this->load->library('session');
             log_message('info', '[INICIO] ' . '[USUARIO CONECTADO: ][ACCION: model buscar_operaciones()]');
             $this->db->select('*');
             $this->db->from ('auditoria');
             $this->db->where('fecha_operacion BETWEEN '."'".$data['fecha_desde']."'".' AND '."'".$data['fecha_hasta']."'");
             $this->db->where('operacion',$data['tipo_operacion']);
             $this->db->order_by('fecha_operacion', 'asc'); 
             if ($paginar == "P"){                    
                 $this->db->limit(10, $this->uri->segment(20));
             }
             $operaciones = $this->db->get();
             log_message('info', '[FIN] ' . '[USUARIO CONECTADO: ][ACCION: model buscar_operaciones()]');
             return $operaciones;
         }
         /**
          * Metodo que realiza la consuta de las operaciones por rango de fecha y tipos de operacion
          * recibe por parametro en el arreglo $data el nombre de la operacion y la fecha desde y hasta
          * @return $operaciones variable que contiene los registros 
          */
         function buscar_operaciones_fechas($data,$paginar){
          //   $this->load->library('session');
             log_message('info', '[INICIO] ' . '[USUARIO CONECTADO: ][ACCION: model buscar_operaciones_fechas()]');
             $this->db->select('*');
             $this->db->from('auditoria');
             $this->db->where('fecha_operacion BETWEEN '."'".$data['fecha_desde']."'".' AND '."'".$data['fecha_hasta']."'");
              $this->db->order_by('fecha_operacion', 'asc');  
             if ($paginar == "P"){                    
                 $this->db->limit(10, $this->uri->segment(20));
             }
             $operaciones = $this->db->get();
             log_message('info', '[FIN] ' . '[USUARIO CONECTADO: ][ACCION: model buscar_operaciones_fechas()]');
             return $operaciones;             
         }     
        /**
        * Metodo que realiza la consuta por tipo de operacion recibe 
        * por parametro el nombre de la operacion
        * @return $operaciones variable que contiene los registros 
        */
         function buscar_operaciones_nombre($tipo_operacion,$paginar){
          //   $this->load->library('session');
             log_message('info', '[INICIO] ' . '[USUARIO CONECTADO: ][ACCION: model buscar_operaciones_nombre()]');
             $this->db->select('*');
             $this->db->from('auditoria');
             $this->db->where('operacion',$tipo_operacion);
             $this->db->order_by('fecha_operacion', 'asc'); 
             if ($paginar == "P"){                    
                 $this->db->limit(10, $this->uri->segment(20));
             }
             $operaciones = $this->db->get();
             log_message('info', '[FIN] ' . '[USUARIO CONECTADO: ][ACCION: model buscar_operaciones_nombre()]');
             return $operaciones;             
         }
 }
?>
