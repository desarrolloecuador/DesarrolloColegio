<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Quimestres extends CI_Controller {
    
    function __construct(){
        parent :: __construct();
        $this->load->model("tipo");
    }
 
	public function index()
	{        
        if($this->session->userdata('comil_codigo_usu') && $this->session->userdata('comil_perfil_usu')=="ADMINISTRADOR"){        
            
            $data['tipos']=$this->tipo->obtenerTodos();            
            $this->load->view('header');
            $this->load->view('quimestres/index',$data);
            $this->load->view('footer');            
        }else{
            $this -> session -> sess_destroy();
            $this->session->sess_create();
            $this -> session ->set_flashdata("errorLogin","No tiene permisos para acceder a la página solicitada.");   
            redirect ("/security/login");   
        }
	}
    
    
    public function editar($id_tipo)
	{        
        if($this->session->userdata('comil_codigo_usu') && $this->session->userdata('comil_perfil_usu')=="ADMINISTRADOR"){        
            
            $data['tipo']=$this->tipo->obtenerTipo($id_tipo);            
            $this->load->view('header');
            $this->load->view('tipos/editar',$data);
            $this->load->view('footer');            
        }else{
            $this -> session -> sess_destroy();
            $this->session->sess_create();
            $this -> session ->set_flashdata("errorLogin","No tiene permisos para acceder a la página solicitada.");   
            redirect ("/security/login");   
        }
	}
    
    public function guardarTipo(){
        
        $data=array(
            "nombre_tip"=>$this->input->post("nombre_tip"),
            "porcentaje_tip"=>$this->input->post("porcentaje_tip")
        );
        
        if($this->tipo->insertar($data)){
            $this->session->set_flashdata("confirmacion","Tipo de Aporte insertado exitosamente");
        }else{
            $this->session->set_flashdata("error","Error al insertar. Intente nuevamente.");
        }
        
        redirect("/tipos/index");
        
    }
    
    public function editarTipo(){
        
         $id=$this->input->post('codigo_tip');
         $data=array(             
            "nombre_tip"=>$this->input->post("nombre_tip"),
            "porcentaje_tip"=>$this->input->post("porcentaje_tip")
        );
        
        if($this->tipo->editar($id,$data)){
            $this->session->set_flashdata("confirmacion","Tipo de Aporte editado exitosamente");
        } 
        
        redirect("/tipos/index");
        
    }
    
    public function eliminarTipo(){
            $codigo_tip = $this->input->post("codigo_tip");  
        
           
            
            if($this->tipo->eliminar($codigo_tip)>0){
                  $this->session->set_flashdata("confirmacion","Tipo de Aporte eliminado exitosamente");
            }else{
                $this->session->set_flashdata("error","Error al eliminar. Revise que el tipo no se relacione con otras áreas del sistema.");
            }
        
           redirect("/tipos/index");
           
    }
    
  
    
 
    
    
    //Editar
      public function validarNombreTipo(){
          
            $codigo_tip = $this->input->post("codigo_tip");
            $nombre_tip = $this->input->post("nombre_tip");                                      
            echo json_encode(!$this->tipo->existeNombre($codigo_tip,$nombre_tip));   
            
           
    }
    
    //Nuevo
     public function validarNombreTipoNuevo(){
          
            
            $nombre_tip = $this->input->post("nombre_tip");                                      
            echo json_encode(!$this->tipo->existeNombreNuevo($nombre_tip));   
            
           
    }
    
    
    
    
}
    
 
    
 



?>