<?php 

    class Materia extends CI_Model{
        
        function __construct(){
            parent :: __construct();
        }
        


    function obtenerMateriasPorCurso($id_curso){
            $this->db->join('usuario', 'usuario.codigo_usu = materia.codigo_usu');
            $this->db->join('curso', 'curso.codigo_cur = materia.codigo_cur');
            $query = $this->db->get_where('materia',array('materia.codigo_cur'=>$id_curso));        
            if($query -> num_rows > 0){                
                return $query;                
            }else{                
                return false;
            }
    }
        
    function obtenerMateriaPorId($id_materia){         
            $query = $this->db->get_where('materia',array('codigo_mat'=>$id_materia));        
            if($query -> num_rows > 0){                
                return $query->row();                
            }else{                
                return false;
            }
    }
        
        
    function insertar($data){                        
        $this->db->insert('materia',$data);
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
        
        
        
    function obtenerMateriaPorDocentePeriodo($codigo_docente,$codigo_periodo){        
        $sql="select * from curso,periodo,materia,usuario as docente where curso.codigo_per =  periodo.codigo_per and materia.codigo_cur=curso.codigo_cur and materia.codigo_usu=docente.codigo_usu and docente.codigo_usu=? and periodo.codigo_per=?;";        
        $query = $this->db->query($sql,array($codigo_docente,$codigo_periodo));
        if($query -> num_rows > 0){                
            return $query;                
        }else{                
            return false;
        }
    }
        
        
        
    function obtenerMateriaPorDocentePeriodoCurso($codigo_docente,$codigo_periodo,$codigo_curso){        
        $sql="select * from curso,periodo,materia,usuario as docente where curso.codigo_per =  periodo.codigo_per and materia.codigo_cur=curso.codigo_cur and materia.codigo_usu=docente.codigo_usu and docente.codigo_usu=? and periodo.codigo_per=? and curso.codigo_cur=?;";        
        $query = $this->db->query($sql,array($codigo_docente,$codigo_periodo,$codigo_curso));
        if($query -> num_rows > 0){                
            return $query;                
        }else{                
            return false;
        }
    }
       
        
     function obtenerCursoPorDocentePeriodo($codigo_docente,$codigo_periodo){  
         
        $sql="select DISTINCT(curso.codigo_cur),nombre_cur,seccion_cur,paralelo_cur from curso,periodo,materia,usuario as docente where curso.codigo_per = periodo.codigo_per and materia.codigo_cur=curso.codigo_cur and materia.codigo_usu=docente.codigo_usu and docente.codigo_usu=? and periodo.codigo_per=? order by codigo_cur asc;";       
         
        $query = $this->db->query($sql,array($codigo_docente,$codigo_periodo));
        if($query -> num_rows > 0){                
            return $query;                
        }else{                
            return false;
        }
    }
        
        
       
        
    function editar($id_mat,$data){    
        $this->db->where('codigo_mat', $id_mat);
        $this->db->update('materia', $data); 
        return $this->db->affected_rows() > 0;        
    }   
        
        
        
    function eliminar($codigo_mat){

          $db_debug = $this->db->db_debug; 

          $this->db->db_debug = FALSE;

          try{
                 $this->db->where("codigo_mat",$codigo_mat);
                 $this->db->delete('materia');     
                 return $this->db->affected_rows();
           }catch (Exception $e) {
              return false;
           }
        
    }
    
        
          //Nuevo    
    function existeNombreNuevo($nombre_mat,$codigo_cur){
        
        $this->db->join('curso','curso.codigo_cur=materia.codigo_cur');
        
        $query=$this->db->get_where('materia',array('nombre_mat'=>$nombre_mat,'materia.codigo_cur'=>$codigo_cur));
        
        if($query -> num_rows > 0){
            return true;
        }else{
            return false;
        }        
    }
        
        
        //Editar    
    function existeNombre($codigo_cur,$codigo_mat,$nombre_mat){
           $this->db->join('curso','curso.codigo_cur=materia.codigo_cur');
          $query=$this->db->get_where('materia',array('nombre_mat'=>$nombre_mat,'materia.codigo_cur'=>$codigo_cur));
        
        if($query -> num_rows > 0){
            if($query->row()->codigo_mat==$codigo_mat){
                return false;
            }
            return true;
        }else{
            return false;
        }        
    }
        
}
        
    
?>