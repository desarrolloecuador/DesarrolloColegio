<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Security extends CI_Controller {
    
     function __construct(){
        parent :: __construct();
        
        $this->load->model('usuario');
        $this->load->model('periodo');
    }
    

 
	public function login()
	{       
		$this->load->view('security/login');       
	}
    
    
    public function perfil()
	{   
        $this->load->view('header');       
		$this->load->view('security/perfil');       
        $this->load->view('footer');       
	}
    
    public function validarDatos(){

        $data=array(
            "username_usu" => $this->input->post("username_usu"),
            "password_usu" => MD5($this->input->post("password_usu"))        
        );

        $resultado = $this->usuario->buscarPorUsernamePassword($data);
        
       

        if($resultado){

            if ($resultado -> estado_usu){
                $variableSesion = array(
                    'comil_codigo_usu' => $resultado -> codigo_usu,
                    'comil_username_usu' => $resultado->username_usu,
                    'comil_nombre_usu' => $resultado->nombre_usu. ' '.$resultado->apellido_usu,
                    'comil_imagen_usu' => $resultado->imagen_usu,
                    'comil_telefono_usu' => $resultado->telefono_usu,
                    'comil_email_usu' => $resultado->email_usu,
                    'comil_perfil_usu' => $resultado -> perfil_usu,                                        
                );
                
                if($resultado->perfil_usu=="DOCENTE"){
                    $periodoActivo=$this->periodo->obtenerPeriodoActivo();
                    if($periodoActivo){
                        $variableSesion['comil_codigo_per']=$periodoActivo->codigo_per;
                        $variableSesion['comil_nombre_per']=$periodoActivo->nombre_per;
                    }else{
                        $variableSesion['comil_codigo_per']=false;
                        $variableSesion['comil_nombre_per']=false;
                    }
                }

                $this->session->set_userdata($variableSesion);
                $this->session->set_flashdata("bienvenida","Bienvenido al Sistema, ".$variableSesion['comil_nombre_usu']);
                redirect('/');
            }else{
                $this -> session ->set_flashdata("errorLogin","El usuario solicitado no puede iniciar sesión ya que tiene su estado inactivo. Contactese con el administrador.");            
            }

        }else{
            $this -> session ->set_flashdata("errorLogin","Usuario o contraseña incorrectos");            
        }

        redirect('security/login');
        
    }
    
    
     public function cerrarSesion(){
        $this -> session -> sess_destroy();
        $this->session->sess_create();
        $this -> session ->set_flashdata("cerrarSesion","Sesión cerrada exitosamente");   
        redirect ("/security/login");        
     }
    
    
    public function cambiarPassword(){
        $password_actual=$this->input->post('password_actual');
        $password_nueva=$this->input->post('password_nueva');
        
        $usuario=$this->usuario->buscarPorCodigo($this->session->userdata('comil_codigo_usu'));
        
        if($usuario->password_usu==md5($password_actual)){            
            
            $this->usuario->actualizarPassword($this->session->userdata('comil_codigo_usu'),md5($password_nueva));
            $this -> session -> sess_destroy();
            $this->session->sess_create();
            $this -> session ->set_flashdata("cerrarSesion","Contraseña actualizada de manera exitosa. Por motivos de seguridad ingrese nuevamente.");   
            redirect ("/security/login"); 
            
            
            
        }else{
            $this->session->set_flashdata("error","No se pueden hacer cambios debido a que la contraseña actual proporcionada no es la correcta.");
        }
        
        redirect('security/perfil');        
        
    }
    
    
    public function cambiarPasswordMovil(){
        $codigo_usu=$this->input->post('codigo_usu');
        $password_actual=$this->input->post('password_actual');
        $password_nueva=$this->input->post('password_nuevo');
        
        $usuario=$this->usuario->buscarPorCodigo($codigo_usu);
        
        if($usuario){
            if($usuario->password_usu==md5($password_actual)){            

                $this->usuario->actualizarPassword($codigo_usu,md5($password_nueva));

                $data=array(
                    "resultado"=>"ok"
                );

                echo json_encode($data);



            }else{

                 $data=array(
                    "resultado"=>"error"
                 );

                echo json_encode($data);
            }
        }else{
             $data=array(
                    "resultado"=>"error"
                 );

                echo json_encode($data);
        }
        
                
        
    }
    
    
    
    
    public function validarDatosMovil(){

       $data=array(
            "username_usu" => $this->input->post("username_usu"),
            "password_usu" => MD5($this->input->post("password_usu"))        
        );
    
 
        $resultado = $this->usuario->buscarPorUsernamePassword($data);

        if($resultado){

            if ($resultado -> estado_usu){
                
                echo json_encode($resultado);          
                
            }else{
               echo json_encode(false);          
            }

        }else{
               echo json_encode(false);          
        }
        
    }
    
    
    

    
}

 