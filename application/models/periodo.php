<?php 

    class Periodo extends CI_Model{
        
        function __construct(){
            parent :: __construct();
        }
        
        
    function obtenerPeriodo($id_periodo){
                        
            $query = $this->db->get_where('periodo',array('codigo_per'=>$id_periodo));
            
            if($query -> num_rows > 0){
                
                return $query->row();
                
            }else{
                
                return false;
            }
    }
        
        
  function obtenerPeriodoActivo(){

        $query = $this->db->get_where('periodo',array('estado_per'=>1));

        if($query -> num_rows > 0){

            return $query->row();

        }else{

            return false;
        }
      
    }


    function obtenerTodos(){
                        
            $query = $this->db->get('periodo');
            
            if($query -> num_rows > 0){
                
                return $query;
                
            }else{
                
                return false;
            }
    }
        
        
    function insertar($data){
                        
        $this->db->insert('periodo',$data);
        return $this->db->affected_rows() > 0;
    }
        
    function editar($id_per,$data){    
        $this->db->where('codigo_per', $id_per);
        $this->db->update('periodo', $data); 
        return $this->db->affected_rows() > 0;
        
    }
    
    function eliminar($codigo_per){
        
        $db_debug = $this->db->db_debug; 

        $this->db->db_debug = FALSE;

          try{
                 $this->db->where("codigo_per",$codigo_per);
                 $this->db->delete('periodo');     
                 return $this->db->affected_rows();
           }catch (Exception $e) {
              return false;
           }
        
    }
     
        
        
    //Editar    
    function existePeriodoActivo($codigo_per){
        
        $query=$this->db->get_where('periodo',array('estado_per'=>1));
        
        if($query -> num_rows > 0){
            if($query->row()->codigo_per==$codigo_per){
                return false;
            }
            return true;
        }else{
            return false;
        }
    
    }
     
    //Editar    
    function existeNombre($codigo_per,$nombre_per){
           $query=$this->db->get_where('periodo',array('nombre_per'=>$nombre_per));
        
        if($query -> num_rows > 0){
            if($query->row()->codigo_per==$codigo_per){
                return false;
            }
            return true;
        }else{
            return false;
        }        
    }
        
    //Nuevo    
    function existeNombreNuevo($nombre_per){
        
        $query=$this->db->get_where('periodo',array('nombre_per'=>$nombre_per));
        
        if($query -> num_rows > 0){
            return true;
        }else{
            return false;
        }        
    }
        
    
}
        
    
?>