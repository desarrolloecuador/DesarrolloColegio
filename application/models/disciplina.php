
<?php 

    class Disciplina extends CI_Model{
        
    function __construct(){
        parent :: __construct();
    }
        

    function insertar($data){                        
        $this->db->insert('disciplina',$data);        
        if($this->db->affected_rows() > 0){
            return $this->db->insert_id();
        }else{
            return -1;
        }
    }                
        
        
    function consultarPorMateria($codigo_mat){                                                        
        $query=$this->db->get_where('disciplina',array('codigo_mat'=>$codigo_mat));
         if($query -> num_rows > 0){                
            return $query;                
        }else{                
            return false;
        }
    }
 
    function eliminar($codigo_dis){

      $db_debug = $this->db->db_debug; 

      $this->db->db_debug = FALSE;

      try{
             $this->db->where("codigo_dis",$codigo_dis);
             $this->db->delete('disciplina');     
             return $this->db->affected_rows();
       }catch (Exception $e) {
          return false;
       }
        
    }
        
        
    function registrarCalificacionEstudiante($data){
        $this->db->insert('calificaciondisciplina',$data);     
    }
        
    function consultarDisciplinaPorId($codigo_dis){        
        $query=$this->db->get_where('disciplina',array("disciplina.codigo_dis"=>$codigo_dis));        
        if($query -> num_rows > 0){                
            return $query->row();                
        }else{                
            return false;
        }
    }
    
    function actualizarNotaCalificacionDisciplina($codigo_cd,$data){        
        $this->db->where('codigo_cd', $codigo_cd);
        $this->db->update('calificaciondisciplina', $data);            
    }
        
    function consultarNotaPorCodigoDisciplina($codigo_dis){
        $this->db->join('estudiante','estudiante.codigo_est=calificaciondisciplina.codigo_est');
        $this->db->join('disciplina','disciplina.codigo_dis=calificaciondisciplina.codigo_dis');
        $query=$this->db->get_where('calificaciondisciplina',array("disciplina.codigo_dis"=>$codigo_dis));
        
        if($query -> num_rows > 0){                
            return $query;                
        }else{                
            return false;
        }
    }
        
        
        
    function consultarCalificacionDisciplina($codigo_cd){        
        $query=$this->db->get_where('calificaciondisciplina',array("codigo_cd"=>$codigo_cd));
        
        if($query -> num_rows > 0){                
            return $query->row();                
        }else{                
            return false;
        }
    }
     
  
}
  

 
    
?>






