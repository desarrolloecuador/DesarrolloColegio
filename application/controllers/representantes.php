<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Representantes extends CI_Controller {
    
    public function __construct(){
        parent :: __construct();
        $this->load->model("periodo");
        $this->load->model("curso");
        $this->load->model("usuario");
        $this->load->model("materia");
        $this->load->model("estudiante");
        $this->load->model("docente");
        $this->load->model("representante");
    }
    
    
    public function index()
        {        
            if($this->session->userdata('comil_codigo_usu') && $this->session->userdata('comil_perfil_usu')=="ADMINISTRADOR"){        
                $data['representantes']=$this->representante->obtenerTodos();            
                $this->load->view('header');
                $this->load->view('/representantes/index',$data);
                $this->load->view('footer');            
            }else{
                $this -> session -> sess_destroy();
                $this->session->sess_create();
                $this -> session ->set_flashdata("errorLogin","No tiene permisos para acceder a la página solicitada.");   
                redirect ("/security/login");   
            }
        }
    
    
    public function guardarRepresentante(){
        
        $data=array(
            "cedula_usu"=>$this->input->post("cedula_usu"),            
            "nombre_usu"=>$this->input->post("nombre_usu"),            
            "telefono_usu"=>$this->input->post("telefono_usu"),
            "username_usu"=>$this->input->post("username_usu"),
            "email_usu"=>$this->input->post("email_usu"),
            "password_usu"=>md5($this->input->post("password_usu")),
            "estado_usu"=>1,
            "parentesco_usu"=>$this->input->post("parentesco_usu"),
            "perfil_usu"=>"REPRESENTANTE"
        );
        
        if($this->representante->insertar($data)){
            $this->session->set_flashdata("confirmacion","Representante insertado exitosamente");
        }else{
            $this->session->set_flashdata("error","Error al insertar. Intente nuevamente.");
        }       
        redirect("representantes/index");
        
    }
    
    public function editar($codigo_representante){
        
         if($this->session->userdata('comil_codigo_usu') && $this->session->userdata('comil_perfil_usu')=="ADMINISTRADOR"){        
            
            $data['representante']=$this->representante->obtenerRepresentante($codigo_representante);            
            $this->load->view('header');
            $this->load->view('representantes/editar',$data);
            $this->load->view('footer');            
        }else{
            $this -> session -> sess_destroy();
            $this->session->sess_create();
            $this -> session ->set_flashdata("errorLogin","No tiene permisos para acceder a la página solicitada.");   
            redirect ("/security/login");   
        }
        
    }
    
    
       
    public function eliminarRepresentante(){
            $codigo_usu = $this->input->post("codigo_usu");  

            
            if($this->representante->eliminar($codigo_usu)>0){
                  $this->session->set_flashdata("confirmacion","Representante eliminado exitosamente");
            }else{
                $this->session->set_flashdata("error","Error al eliminar. Revise que el representante no se relacione con otras áreas del sistema.");
            }
        
           redirect("/representantes/index");
           
    }
    
      public function editarRepresentante(){
        
             $id=$this->input->post('codigo_usu');
             $data=array(             
                "nombre_usu"=>$this->input->post("nombre_usu"),
                "apellido_usu"=>$this->input->post("apellido_usu"),
                "telefono_usu"=>$this->input->post("telefono_usu"),
                "email_usu"=>$this->input->post("email_usu"),
                "username_usu"=>$this->input->post("username_usu"),
                "parentesco_usu"=>$this->input->post("parentesco_usu"),
                "cedula_usu"=>$this->input->post("cedula_usu")
            );

            if($this->usuario->editar($id,$data)){
                $this->session->set_flashdata("confirmacion","Representante editado exitosamente");
            }

            redirect("/representantes/index");
        
    }
    
    
     public function cambiarPassword(){
        
        $id=$this->input->post('codigo_usu');
        $pass=$this->input->post('password_usu');

        $this->usuario->cambiarPassword($id,$pass);
        $this->session->set_flashdata("confirmacion","Contraseña reestablecida exitosamente");
        

        $url=site_url('/representantes/editar').'/'.$id;
        redirect($url);
        
    }
    
    
    
     //Nuevo
     public function validarUsernameNuevo(){
            $username_usu = $this->input->post("username_usu");                                                  
            echo json_encode(!$this->usuario->existeUsernameNuevo($username_usu));     
    }
    
     //Nuevo
     public function validarEmailNuevo(){
            $email_usu = $this->input->post("email_usu");                                                  
            echo json_encode(!$this->usuario->existeEmailNuevo($email_usu));         
     }
         
    //Nuevo
     public function validarCedulaNuevo(){
            $cedula_usu = $this->input->post("cedula_usu");                                                  
            echo json_encode(!$this->usuario->existeCedulaNuevo($cedula_usu));     
     }
    
    
    //Editar
    public function validarUsername(){
          
            $codigo_usu = $this->input->post("codigo_usu");
            $username_usu = $this->input->post("username_usu");                                      
            echo json_encode(!$this->usuario->existeUsername($codigo_usu,$username_usu));   
            
           
    }
    
    
    //Editar
    public function validarEmail(){
          
            $codigo_usu = $this->input->post("codigo_usu");
            $email_usu = $this->input->post("email_usu");                                      
            echo json_encode(!$this->usuario->existeEmail($codigo_usu,$email_usu));   
            
           
    }
    
    
    
    //Editar
    public function validarCedula(){          
            $codigo_usu = $this->input->post("codigo_usu");
            $cedula_usu = $this->input->post("cedula_usu");                                      
            echo json_encode(!$this->usuario->existeCedula($codigo_usu,$cedula_usu));      
    }
    
    
    public function obtenerEstudiantesRepresentadosMovil(){
        $codigo_usu=$this->input->post('codigo_usu');
        $resultado=$this->estudiante->obtenerEstudiantesPorRepresentante($codigo_usu);
        if($resultado){
            echo json_encode($resultado->result());
        }else{
            echo json_encode(false);
        }
    }
 
  


    
}
    
?>