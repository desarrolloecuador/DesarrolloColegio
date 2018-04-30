<?php 

    class Estudiante extends CI_Model{
        
        function __construct(){
            parent :: __construct();
        }
        

    function insertar($data){                        
        $this->db->insert('estudiante',$data);
        return $this->db->affected_rows() > 0;
    }
        
 
        
        
     function obtenerEstudiantePorId($id_est){    
        $this->db->join("usuario","estudiante.codigo_usu=usuario.codigo_usu");
        $query=$this->db->get_where('estudiante',array('codigo_est'=>$id_est));
         if($query -> num_rows > 0){                
            return $query->row();                
        }else{                
            return false;
        }
    }
        
        
    function obtenerListadoPorCurso($codigo_cur){
        
        $this->db->join('usuario', 'usuario.codigo_usu = estudiante.codigo_usu');
        $this->db->join('curso', 'curso.codigo_cur = estudiante.codigo_cur');
        $this->db->order_by('nombre_est','asc');
        $query = $this->db->get_where('estudiante',array('curso.codigo_cur'=>$codigo_cur));        
        if($query -> num_rows > 0){                
            return $query;                
        }else{                
            return false;
        }
        
        
    }
        
        
    function editar($id_est,$data){    
        $this->db->where('codigo_est', $id_est);
        $this->db->update('estudiante', $data); 
        return $this->db->affected_rows() > 0;        
    }
        
        
    //Nuevo    
    function existeCedulaNuevo($cedula_est,$codigo_cur){
        
        $this->db->join('curso','curso.codigo_cur=estudiante.codigo_cur');
        
        $query=$this->db->get_where('estudiante',array('cedula_est'=>$cedula_est,'estudiante.codigo_cur'=>$codigo_cur));
        
        if($query -> num_rows > 0){
            return true;
        }else{
            return false;
        }        
    }
        
        
        //Editar    
    function existeCedula($codigo_cur,$codigo_est,$cedula_est){
           $this->db->join('curso','curso.codigo_cur=estudiante.codigo_cur');
          $query=$this->db->get_where('estudiante',array('cedula_est'=>$cedula_est,'estudiante.codigo_cur'=>$codigo_cur));
        
        if($query -> num_rows > 0){
            if($query->row()->codigo_est==$codigo_est){
                return false;
            }
            return true;
        }else{
            return false;
        }        
    }
        
        
    //MOVIL
    function obtenerEstudiantesPorRepresentante($codigo_usu){
       $sql="select DISTINCT(cedula_est) as cedula_est,nombre_est from estudiante, usuario where estudiante.codigo_usu=usuario.codigo_usu and estudiante.codigo_usu=?";
        
        $query = $this->db->query($sql,array($codigo_usu));
        
        if($query -> num_rows > 0){                
            return $query;                
        }else{                
            return false;
        }
        
    }
        
        
        function obtenerCursoMaterias($cedula_est){
            
            $sql=" select * from materia,curso where curso.codigo_cur=materia.codigo_cur and materia.codigo_cur=(select codigo_cur from estudiante where cedula_est=? limit 0,1)";
        
            $query = $this->db->query($sql,array($cedula_est));

            if($query -> num_rows > 0){                
                return $query;  
            }else{                
                return false;
            }
            
           
        }
        
        
        function obtenerAsistenciaPorEstudianteMateria($codigo_mat,$cedula_est,$fecha_inicial,$fecha_final){
            
            $sql=" select * from estudiante,asistencia,registroasistencia WHERE
                    asistencia.codigo_asi=registroasistencia.codigo_asi AND estudiante.codigo_est=registroasistencia.codigo_est
                    and estudiante.cedula_est=? and asistencia.codigo_mat=? and  asistencia.fecha_asi BETWEEN ? and ?";
        
            $query = $this->db->query($sql,array($cedula_est,$codigo_mat,$fecha_inicial,$fecha_final));

            if($query -> num_rows > 0){                
                return $query;  
            }else{                
                return false;
            }
            
           
        }
        
        
         function consultarComunicadosPorEstudiante($cedula_est){
            
            $sql=" select * from comunicado,estudiante, estudiantecomunicado,materia where 
                    estudiante.codigo_est=estudiantecomunicado.codigo_est and 
                    comunicado.codigo_com=estudiantecomunicado.codigo_com and
                    comunicado.codigo_mat=materia.codigo_mat and
                    estudiante.cedula_est=? order by fecha_com desc ";
        
            $query = $this->db->query($sql,array($cedula_est));

            if($query -> num_rows > 0){                
                return $query;  
            }else{                
                return false;
            }
            
           
        }
        
        
         function consultarDisciplinaPorEstudiante($codigo_mat,$cedula_est){
            
            $sql="select * from disciplina,calificaciondisciplina,materia,estudiante WHERE calificaciondisciplina.codigo_est=estudiante.codigo_est and disciplina.codigo_dis=calificaciondisciplina.codigo_dis and disciplina.codigo_mat=materia.codigo_mat and disciplina.codigo_mat=? and cedula_est=? ";
        
            $query = $this->db->query($sql,array($codigo_mat,$cedula_est));

            if($query -> num_rows > 0){                
                return $query;  
            }else{                
                return false;
            }
            
           
        }
        
        
       
        
        
        
        
        
        
        
        
        
  
}
        
    
?>