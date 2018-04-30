<?php 

    class Tipo extends CI_Model{
        
        function __construct(){
            parent :: __construct();
        }
        
        
    function obtenerTipo($id_tipo){
                        
            $query = $this->db->get_where('tipoaporte',array('codigo_tip'=>$id_tipo));
            
            if($query -> num_rows > 0){
                
                return $query->row();
                
            }else{
                
                return false;
            }
    }
        
 

    function obtenerTodos(){
                        
            $query = $this->db->get('tipoaporte');
            
            if($query -> num_rows > 0){
                
                return $query;
                
            }else{
                
                return false;
            }
    }
        
        
    function insertar($data){
                        
        $this->db->insert('tipoaporte',$data);
        return $this->db->affected_rows() > 0;
    }
        
    function editar($id_tip,$data){    
        $this->db->where('codigo_tip', $id_tip);
        $this->db->update('tipoaporte', $data); 
        return $this->db->affected_rows() > 0;
        
    }
    
    function eliminar($codigo_tip){
        
        $db_debug = $this->db->db_debug; 

        $this->db->db_debug = FALSE;

          try{
                 $this->db->where('codigo_tip', $codigo_tip);
                 $this->db->delete('tipoaporte');     
                 return $this->db->affected_rows();
           }catch (Exception $e) {
              return false;
           }
        
    }
     
      
     
    //Editar    
    function existeNombre($codigo_tip,$nombre_tip){
           $query=$this->db->get_where('tipoaporte',array('nombre_tip'=>$nombre_tip));
        
        if($query -> num_rows > 0){
            if($query->row()->codigo_tip==$codigo_tip){
                return false;
            }
            return true;
        }else{
            return false;
        }        
    }
        
    //Nuevo    
    function existeNombreNuevo($nombre_tip){
        
        $query=$this->db->get_where('tipoaporte',array('nombre_tip'=>$nombre_tip));
        
        if($query -> num_rows > 0){
            return true;
        }else{
            return false;
        }        
    }
        
    
}
        
    
?>