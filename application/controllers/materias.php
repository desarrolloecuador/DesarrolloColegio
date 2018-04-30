<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Materias extends CI_Controller {
    
    function __construct(){
        parent :: __construct();
        $this->load->model("periodo");
        $this->load->model("curso");
        $this->load->model("usuario");
        $this->load->model("materia");
        $this->load->model("estudiante");
        $this->load->model("representante");
    }
 
	public function materiasDocenteCurso($codigo_curso)
	{        
        if($this->session->userdata('comil_codigo_usu') && $this->session->userdata('comil_perfil_usu')=="DOCENTE"){        
            
            $data['materias']=$this->materia->obtenerMateriaPorDocentePeriodoCurso($this->session->userdata('comil_codigo_usu'),$this->session->userdata('comil_codigo_per'),$codigo_curso);
            $data['curso']=$this->curso->obtenerCursoPorId($codigo_curso);
            $this->load->view('header');
            $this->load->view('materias/MateriasDocenteCurso',$data);
            $this->load->view('footer');            
        }else{
            $this -> session -> sess_destroy();
            $this->session->sess_create();
            $this -> session ->set_flashdata("errorLogin","No tiene permisos para acceder a la página solicitada.");   
            redirect ("/security/login");   
        }
	}

 
}


?>