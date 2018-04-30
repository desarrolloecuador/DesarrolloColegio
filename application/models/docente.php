<?php 

    class Docente extends CI_Model{
        
        function __construct(){
            parent :: __construct();
        }
        


      function obtenerDocente($id_docente){

        $query = $this->db->get_where('usuario',array('codigo_usu'=>$id_docente));

        if($query -> num_rows > 0){

            return $query->row();

        }else{

            return false;
        }
    }
        
    function insertar($data){                        
        $this->db->insert('usuario',$data);
        return $this->db->affected_rows() > 0;
    }
        
        
    function obtenerTodos(){        
        $this->db->order_by("apellido_usu","asc");
        $query = $this->db->get_where('usuario',array('perfil_usu'=>'DOCENTE'));        
        if($query -> num_rows > 0){                
            return $query;                
        }else{                
            return false;
        }
        
        
    }
        
        
  function eliminar($codigo_usu){

      $db_debug = $this->db->db_debug; 

      $this->db->db_debug = FALSE;

      try{
             $this->db->where("codigo_usu",$codigo_usu);
             $this->db->delete('usuario');     
             return $this->db->affected_rows();
       }catch (Exception $e) {
          return false;
       }
        
    }
        
        
        
        
        

}
        
    
?>