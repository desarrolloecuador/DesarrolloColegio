
<?php 

    class Comunicado extends CI_Model{
        
    function __construct(){
        parent :: __construct();
    }
        

    function insertar($data){                        
        $this->db->insert('comunicado',$data);        
        if($this->db->affected_rows() > 0){
            return $this->db->insert_id();
        }else{
            return -1;
        }
    }                
        
        
    function consultarPorMateria($codigo_mat){                                                        
        $query=$this->db->get_where('comunicado',array('codigo_mat'=>$codigo_mat,"tipo_com"=>"MANUAL"));
         if($query -> num_rows > 0){                
            return $query;                
        }else{                
            return false;
        }
    }
 
    function eliminar($codigo_com){

      $db_debug = $this->db->db_debug; 

      $this->db->db_debug = FALSE;

      try{
             $this->db->where("codigo_com",$codigo_com);
             $this->db->delete('comunicado');     
             return $this->db->affected_rows();
       }catch (Exception $e) {
          return false;
       }
        
    }
        
        
    function registrarComunicadoEstudiante($data){
        $this->db->insert('estudiantecomunicado',$data);     
    }
        
    function consultarComunicadoPorId($codigo_com){        
        $query=$this->db->get_where('comunicado',array("comunicado.codigo_com"=>$codigo_com));        
        if($query -> num_rows > 0){                
            return $query->row();                
        }else{                
            return false;
        }
    }
    
    function actualizarEstudianteComunicado($codigo_cd,$data){        
        $this->db->where('codigo_cd', $codigo_cd);
        $this->db->update('estudiantecomunicado', $data);            
    }
        
    function consultarEstudiantePorCodigoComunicado($codigo_com){
        $this->db->join('estudiante','estudiante.codigo_est=estudiantecomunicado.codigo_est');
        $this->db->join('comunicado','comunicado.codigo_com=estudiantecomunicado.codigo_com');
        $query=$this->db->get_where('estudiantecomunicado',array("comunicado.codigo_com"=>$codigo_com));
        
        if($query -> num_rows > 0){                
            return $query;                
        }else{                
            return false;
        }
    }
        
        
    //Para generar las notificaciones en android
    function consultarComunicadosSinAlarmaPorRepresentante($representante_usu){
        $this->db->join('estudiante','estudiante.codigo_est=estudiantecomunicado.codigo_est');
        $this->db->join('comunicado','comunicado.codigo_com=estudiantecomunicado.codigo_com');
        $this->db->join('materia','comunicado.codigo_mat=materia.codigo_mat');
        $query=$this->db->get_where('estudiantecomunicado',array("estudiantecomunicado.alarma_ec"=>0, "estudiantecomunicado.representante_usu"=>$representante_usu));
        
        if($query -> num_rows > 0){                
            return $query;                
        }else{                
            return false;
        }
        
    }
        
    function desactivarAlarma($codigo_com,$representante_usu){
        $data=array(
            "alarma_ec"=>1
        );
        $this->db->where("codigo_com",$codigo_com);
        $this->db->where("representante_usu",$representante_usu);
        $this->db->update("estudiantecomunicado",$data);
    }
     
  
}
  

 
    
?>






