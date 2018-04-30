
<?php 

    class Asistencia extends CI_Model{
        
    function __construct(){
        parent :: __construct();
    }
        

    function insertar($data){                        
        $this->db->insert('asistencia',$data);        
        if($this->db->affected_rows() > 0){
            return $this->db->insert_id();
        }else{
            return -1;
        }
    }                
        
        
    function consultarPorMateria($codigo_mat){                                                        
        $query=$this->db->get_where('asistencia',array('codigo_mat'=>$codigo_mat));
         if($query -> num_rows > 0){                
            return $query;                
        }else{                
            return false;
        }
    }
 
    function eliminar($codigo_asi){

      $db_debug = $this->db->db_debug; 

      $this->db->db_debug = FALSE;

      try{
             $this->db->where("codigo_asi",$codigo_asi);
             $this->db->delete('asistencia');     
             return $this->db->affected_rows();
       }catch (Exception $e) {
          return false;
       }
        
    }
        
        
    function registrarAsistenciaEstudiante($data){
        $this->db->insert('registroasistencia',$data);     
    }
        
    function consultarAsistenciaPorId($codigo_asi){        
        $query=$this->db->get_where('asistencia',array("asistencia.codigo_asi"=>$codigo_asi));        
        if($query -> num_rows > 0){                
            return $query->row();                
        }else{                
            return false;
        }
    }
    
    function actualizarEstadoRegistroAsistencia($codigo_ra,$data){        
        $this->db->where('codigo_ra', $codigo_ra);
        $this->db->update('registroasistencia', $data);            
    }
        
    function consultarRegistroPorCodigoAsistencia($codigo_asi){
        $this->db->join('estudiante','estudiante.codigo_est=registroasistencia.codigo_est');
        $this->db->join('asistencia','asistencia.codigo_asi=registroasistencia.codigo_asi');
        $query=$this->db->get_where('registroasistencia',array("asistencia.codigo_asi"=>$codigo_asi));
        
        if($query -> num_rows > 0){                
            return $query;                
        }else{                
            return false;
        }
    }
        
    function consultarRegistroAsistenciaPorCodigo($codigo_ra){
         $this->db->where('codigo_ra', $codigo_ra);
            $query=$this->db->get('registroasistencia');

            if($query -> num_rows > 0){                
                return $query->row();                
            }else{                
                return false;
            }
    }
     
  
}
  


/*
create table registroasistencia(
	codigo_ra bigint(10) AUTO_INCREMENT,
    estado_ra tinyint,
    codigo_asi bigint(10),    
    codigo_est bigint(10),
    primary key (codigo_ra),
    FOREIGN key (codigo_asi) REFERENCES asistencia(codigo_asi) on DELETE cascade on UPDATE RESTRICT,
    FOREIGN key (codigo_est) REFERENCES estudiante(codigo_est) on DELETE cascade on UPDATE RESTRICT
);
*/
    
?>






