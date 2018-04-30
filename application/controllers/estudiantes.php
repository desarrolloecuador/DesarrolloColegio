<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Estudiantes extends CI_Controller {
    
    function __construct(){
        parent :: __construct();
        $this->load->model("periodo");
        $this->load->model("curso");
        $this->load->model("usuario");
        $this->load->model("materia");
        $this->load->model("estudiante");
    }
 
 
    
       
    public function listado($id_periodo,$id_curso,$id_materia)
	{        
        if($this->session->userdata('comil_codigo_usu') && $this->session->userdata('comil_perfil_usu')=="DOCENTE"){        
            
            $data['curso']=$this->curso->obtenerCursoPorId($id_curso); 
            $data['periodo']=$this->periodo->obtenerPeriodo($id_periodo); 
            $data['materia']=$this->materia->obtenerMateriaPorId($id_materia);
            $data['estudiantes']=$this->estudiante->obtenerListadoPorCurso($id_curso);             
            $this->load->view('header');
            $this->load->view('estudiantes/listado',$data);
            $this->load->view('footer');           
        }else{
            $this -> session -> sess_destroy();
            $this->session->sess_create();
            $this -> session ->set_flashdata("errorLogin","No tiene permisos para acceder a la página solicitada.");   
            redirect ("/security/login");   
        }
	}
    
    public function obtenerCursoMateriasMovil(){
        
        $cedula_est=$this->input->post('cedula_est');
        $resultado=$this->estudiante->obtenerCursoMaterias($cedula_est);
        
        //$resultado=$this->estudiante->obtenerCursoMaterias('1755145750');
        
        if($resultado){
            echo json_encode($resultado->result());
        }else{
            echo json_encode(false);
        }
    }
    
    
    public function obtenerAsistenciaPorEstudianteMateriaMovil(){
        
        $cedula_est=$this->input->post('cedula_est');
        $codigo_mat=$this->input->post('codigo_mat');
        $fecha_inicial=$this->input->post('fecha_inicial');
        $fecha_final=$this->input->post('fecha_final');
        $resultado=$this->estudiante->obtenerAsistenciaPorEstudianteMateria($codigo_mat,$cedula_est,$fecha_inicial,$fecha_final);
        
        //$resultado=$this->estudiante->obtenerAsistenciaPorEstudianteMateria(8,'1755145750');
        
        if($resultado){
            echo json_encode($resultado->result());
        }else{
            echo json_encode(false);
        }
    }
    
    
        
    public function consultarComunicadosPorEstudianteMovil(){
        
        $cedula_est=$this->input->post('cedula_est');       
        //$resultado=$this->estudiante->consultarComunicadosPorEstudiante('1755145750');
        
        $resultado=$this->estudiante->consultarComunicadosPorEstudiante($cedula_est);
   
        if($resultado){
            echo json_encode($resultado->result());
        }else{
            echo json_encode(false);
        }
        
    }
    
    
    public function consultarDisciplinasPorEstudianteMovil(){
        
        $cedula_est=$this->input->post('cedula_est');
        $codigo_mat=$this->input->post('codigo_mat');
        
        //$resultado=$this->estudiante->consultarDisciplinaPorEstudiante(8,'1755145750');
        
        $resultado=$this->estudiante->consultarDisciplinaPorEstudiante($codigo_mat,$cedula_est);
   
        if($resultado){
            echo json_encode($resultado->result());
        }else{
            echo json_encode(false);
        }
        
    }
    
    
    
    
    
    
    
    
    
    
 
}


?>