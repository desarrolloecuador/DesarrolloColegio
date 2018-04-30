<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

 
	public function index()
	{
        
        if($this->session->userdata('comil_codigo_usu')){
        
            $this->load->view('header');
            $this->load->view('welcome/index');
            $this->load->view('footer');            
        }else{
            $this -> session -> sess_destroy();
            $this->session->sess_create();
            $this -> session ->set_flashdata("errorLogin","No tiene permisos para acceder a la página solicitada.");   
            redirect ("/security/login");   
        }
	}
    
    
    public function crearSesionPeriodo(){
        $codigo_per=$this->input->post('codigo_per');
        if($codigo_per>0){
            $this->session->set_userdata('codigo_per',$codigo_per);
            $this->session->set_flashdata('confirmacion','Periodo Lectivo seleccionado de manera exitosa.');
            echo json_encode(true);
        }else{
            $this->session->unset_userdata('codigo_per');
            $this->session->set_flashdata('error','No se ha seleccionado ningun Periodo Lectivo.');
            echo json_encode(false);
        }
        
    }
    
 
}

 