<?php 

    class Curso extends CI_Model{
        
        function __construct(){
            parent :: __construct();
        }
        


    function obtenerCursosPorPeriodo($id_periodo){
            $this->db->join('periodo', 'periodo.codigo_per = curso.codigo_per');
            $this->db->join('usuario', 'curso.codigo_usu = usuario.codigo_usu');
            $query = $this->db->get_where('curso',array('curso.codigo_per'=>$id_periodo));        
            if($query -> num_rows > 0){                
                return $query;                
            }else{                
                return false;
            }
    }
        
        
    function editar($id_cur,$data){    
        $this->db->where('codigo_cur', $id_cur);
        $this->db->update('curso', $data); 
        return $this->db->affected_rows() > 0;        
    }
        
    function insertar($data){
                        
        $this->db->insert('curso',$data);
        return $this->db->affected_rows() > 0;
    }
        
     function obtenerCursoPorId($id_curso){
            $this->db->join('periodo', 'periodo.codigo_per = curso.codigo_per');
            $query = $this->db->get_where('curso',array('curso.codigo_cur'=>$id_curso));        
            if($query -> num_rows > 0){                
                return $query->row();                
            }else{                
                return false;
            }
    }
        
        
    function eliminar($codigo_cur){

          $db_debug = $this->db->db_debug; 

          $this->db->db_debug = FALSE;

          try{
                 $this->db->where("codigo_cur",$codigo_cur);
                 $this->db->delete('curso');     
                 return $this->db->affected_rows();
           }catch (Exception $e) {
              return false;
           }
        
    }
 
        
}
        
    
?>