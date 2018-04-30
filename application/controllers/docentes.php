<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Docentes extends CI_Controller {
    
    public function __construct(){
        parent :: __construct();
        $this->load->model("periodo");
        $this->load->model("curso");
        $this->load->model("usuario");
        $this->load->model("materia");
        $this->load->model("estudiante");
        $this->load->model("docente");
    }
    
    
    public function index()
        {        
            if($this->session->userdata('comil_codigo_usu') && $this->session->userdata('comil_perfil_usu')=="ADMINISTRADOR"){        

                $data['docentes']=$this->docente->obtenerTodos();            
                $this->load->view('header');
                $this->load->view('/docentes/index',$data);
                $this->load->view('footer');            
            }else{
                $this -> session -> sess_destroy();
                $this->session->sess_create();
                $this -> session ->set_flashdata("errorLogin","No tiene permisos para acceder a la página solicitada.");   
                redirect ("/security/login");   
            }
        }
    
    
    public function guardarDocente(){
        
        $data=array(
            "nombre_usu"=>$this->input->post("nombre_usu"),
            "apellido_usu"=>$this->input->post("apellido_usu"),
            "telefono_usu"=>$this->input->post("telefono_usu"),
            "username_usu"=>$this->input->post("username_usu"),
            "email_usu"=>$this->input->post("email_usu"),
            "password_usu"=>md5($this->input->post("password_usu")),
            "estado_usu"=>1,
            "perfil_usu"=>"DOCENTE"
        );
        
        if($this->docente->insertar($data)){
            $this->session->set_flashdata("confirmacion","Docente insertado exitosamente");
        }else{
            $this->session->set_flashdata("error","Error al insertar. Intente nuevamente.");
        }       
        redirect("docentes/index");
        
    }
    
    public function editar($codigo_docente){
        
         if($this->session->userdata('comil_codigo_usu') && $this->session->userdata('comil_perfil_usu')=="ADMINISTRADOR"){        
            
            $data['docente']=$this->docente->obtenerDocente($codigo_docente);            
            $this->load->view('header');
            $this->load->view('docentes/editar',$data);
            $this->load->view('footer');            
        }else{
            $this -> session -> sess_destroy();
            $this->session->sess_create();
            $this -> session ->set_flashdata("errorLogin","No tiene permisos para acceder a la página solicitada.");   
            redirect ("/security/login");   
        }
        
    }
    
    
       
    public function eliminarDocente(){
            $codigo_usu = $this->input->post("codigo_usu");  

            
            if($this->docente->eliminar($codigo_usu)>0){
                  $this->session->set_flashdata("confirmacion","Docente eliminado exitosamente");
            }else{
                $this->session->set_flashdata("error","Error al eliminar. Revise que el docente no se relacione con otras áreas del sistema.");
            }
        
           redirect("/docentes/index");
           
    }
    
      public function editarDocente(){
        
             $id=$this->input->post('codigo_usu');
             $data=array(             
                "nombre_usu"=>$this->input->post("nombre_usu"),
                "apellido_usu"=>$this->input->post("apellido_usu"),
                "telefono_usu"=>$this->input->post("telefono_usu"),
                "email_usu"=>$this->input->post("email_usu"),
                "username_usu"=>$this->input->post("username_usu"),
                "estado_usu"=>$this->input->post("estado_usu")
            );

            if($this->usuario->editar($id,$data)){
                $this->session->set_flashdata("confirmacion","Docente editado exitosamente");
            }

            redirect("/docentes/index");
        
    }
    
    
     public function cambiarPassword(){
        
        $id=$this->input->post('codigo_usu');
        $pass=$this->input->post('password_usu');

        $this->usuario->cambiarPassword($id,$pass);
        $this->session->set_flashdata("confirmacion","Contraseña reestablecida exitosamente");
        

        $url=site_url('/docentes/editar').'/'.$id;
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
 
    
    
     


    
}
    
?>