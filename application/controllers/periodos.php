<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Periodos extends CI_Controller {
    
    function __construct(){
        parent :: __construct();
        $this->load->model("periodo");
    }
 
	public function index()
	{        
        if($this->session->userdata('comil_codigo_usu') && $this->session->userdata('comil_perfil_usu')=="ADMINISTRADOR"){        
            
            $data['periodos']=$this->periodo->obtenerTodos();            
            $this->load->view('header');
            $this->load->view('periodos/index',$data);
            $this->load->view('footer');            
        }else{
            $this -> session -> sess_destroy();
            $this->session->sess_create();
            $this -> session ->set_flashdata("errorLogin","No tiene permisos para acceder a la página solicitada.");   
            redirect ("/security/login");   
        }
	}
    
    
    public function editar($id_periodo)
	{        
        if($this->session->userdata('comil_codigo_usu') && $this->session->userdata('comil_perfil_usu')=="ADMINISTRADOR"){        
            
            $data['periodo']=$this->periodo->obtenerPeriodo($id_periodo);            
            $this->load->view('header');
            $this->load->view('periodos/editar',$data);
            $this->load->view('footer');            
        }else{
            $this -> session -> sess_destroy();
            $this->session->sess_create();
            $this -> session ->set_flashdata("errorLogin","No tiene permisos para acceder a la página solicitada.");   
            redirect ("/security/login");   
        }
	}
    
    public function guardarPeriodo(){
        
        $data=array(
            "nombre_per"=>$this->input->post("nombre_per")
        );
        
        if($this->periodo->insertar($data)){
            $this->session->set_flashdata("confirmacion","Periodo Lectivo insertado exitosamente");
        }else{
            $this->session->set_flashdata("error","Error al insertar. Intente nuevamente.");
        }
        
        redirect("/periodos/index");
        
    }
    
    public function editarPeriodo(){
        
         $id=$this->input->post('codigo_per');
         $data=array(             
            "nombre_per"=>$this->input->post("nombre_per"),
             "estado_per"=>$this->input->post("estado_per")
        );
        
        if($this->periodo->editar($id,$data)){
            $this->session->set_flashdata("confirmacion","Periodo Lectivo editado exitosamente");
        } 
        
        redirect("/periodos/index");
        
    }
    
    public function eliminarPeriodo(){
            $codigo_per = $this->input->post("codigo_per");  
        
           
            
            if($this->periodo->eliminar($codigo_per)>0){
                  $this->session->set_flashdata("confirmacion","Periodo Lectivo eliminado exitosamente");
            }else{
                $this->session->set_flashdata("error","Error al eliminar. Revise que el periodo no se relacione con otras áreas del sistema.");
            }
        
           redirect("/periodos/index");
           
    }
    
  
    
    public function validarEstadoPeriodo(){
            $codigo_per = $this->input->post("codigo_per");
            $estado_per = $this->input->post("estado_per");

            if($estado_per==0){
                echo json_encode(true); 
            }else{                               
               echo json_encode(!$this->periodo->existePeriodoActivo($codigo_per));   
            }
           
    }
    
    
    
    //Editar
      public function validarNombrePeriodo(){
          
            $codigo_per = $this->input->post("codigo_per");
            $nombre_per = $this->input->post("nombre_per");                                      
            echo json_encode(!$this->periodo->existeNombre($codigo_per,$nombre_per));   
            
           
    }
    
    //Nuevo
     public function validarNombrePeriodoNuevo(){
          
            
            $nombre_per = $this->input->post("nombre_per");                                      
            echo json_encode(!$this->periodo->existeNombreNuevo($nombre_per));   
            
           
    }
    
    
    
    
}
    
 
    
 



?>