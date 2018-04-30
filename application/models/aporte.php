
<?php 

    class Aporte extends CI_Model{
        
    function __construct(){
        parent :: __construct();
    }
        

    function insertar($data){                        
        $this->db->insert('aporte',$data);        
        if($this->db->affected_rows() > 0){
            return $this->db->insert_id();
        }else{
            return -1;
        }
    }                
        
        
    function consultarPorMateria($codigo_mat){  
        $this->db->join("tipoaporte","aporte.codigo_tip=tipoaporte.codigo_tip");
        $query=$this->db->get_where('aporte',array('codigo_mat'=>$codigo_mat));
         if($query -> num_rows > 0){                
            return $query;                
        }else{                
            return false;
        }
    }
 
    function eliminar($codigo_apo){

      $db_debug = $this->db->db_debug; 

      $this->db->db_debug = FALSE;

      try{
             $this->db->where("codigo_apo",$codigo_apo);
             $this->db->delete('aporte');     
             return $this->db->affected_rows();
       }catch (Exception $e) {
          return false;
       }
        
    }
        
        
    function registrarCalificacionEstudiante($data){
        $this->db->insert('calificacionaporte',$data);     
    }
        
    function consultarAportePorId($codigo_apo){      
        $this->db->join("tipoaporte","aporte.codigo_tip=tipoaporte.codigo_tip");
        $query=$this->db->get_where('aporte',array("aporte.codigo_apo"=>$codigo_apo));        
        if($query -> num_rows > 0){                
            return $query->row();                
        }else{                
            return false;
        }
    }
    
    function actualizarNotaCalificacionAporte($codigo_ca,$data){        
        $this->db->where('codigo_ca', $codigo_ca);
        $this->db->update('calificacionaporte', $data);            
    }
        
    function consultarNotaPorCodigoAporte($codigo_apo){
        $this->db->join('estudiante','estudiante.codigo_est=calificacionaporte.codigo_est');
        $this->db->join('aporte','aporte.codigo_apo=calificacionaporte.codigo_apo');
        $query=$this->db->get_where('calificacionaporte',array("aporte.codigo_apo"=>$codigo_apo));
        
        if($query -> num_rows > 0){                
            return $query;                
        }else{                
            return false;
        }
    }
        
    function consultarCalificacionAportePorCodigo($codigo_ca){                
        $query=$this->db->get_where('calificacionaporte',array("calificacionaporte.codigo_ca"=>$codigo_ca));
        
        if($query -> num_rows > 0){                
            return $query->row();                
        }else{                
            return false;
        }
    }
        
        
    function consultarAportesPorMateriaEstudiante($codigo_mat,$cedula_est,$quimestre_apo){
        
        $sql="select * from estudiante,aporte,calificacionaporte,materia,tipoaporte where 
            tipoaporte.codigo_tip=aporte.codigo_tip and
            materia.codigo_mat=aporte.codigo_mat and
            aporte.codigo_apo=calificacionaporte.codigo_apo AND
            estudiante.codigo_est=calificacionaporte.codigo_est and
            calificacionaporte.calificacion_ca>-1 and
            aporte.codigo_mat=? and            
            estudiante.cedula_est=?
            and quimestre_apo=?";
        
        $query=$this->db->query($sql,array($codigo_mat,$cedula_est,$quimestre_apo));
        
        if($query -> num_rows > 0){                
            return $query;                
        }else{                
            return false;
        }
        
    }
    
    //promedios general
    function consultarAportesPorMateria($codigo_mat,$quimestre_apo){
        
        $sql="select * from estudiante,aporte,calificacionaporte,materia,tipoaporte where 
            tipoaporte.codigo_tip=aporte.codigo_tip and
            materia.codigo_mat=aporte.codigo_mat and
            aporte.codigo_apo=calificacionaporte.codigo_apo AND
            estudiante.codigo_est=calificacionaporte.codigo_est and
            calificacionaporte.calificacion_ca>-1 and
            aporte.codigo_mat=?
            and quimestre_apo=?";
        
        $query=$this->db->query($sql,array($codigo_mat,$quimestre_apo));
        
        if($query -> num_rows > 0){                
            return $query;                
        }else{                
            return false;
        }
        
    }
     
  
     
  
}
  

 
    
?>






