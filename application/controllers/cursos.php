<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cursos extends CI_Controller {
    
    function __construct(){
        parent :: __construct();
        $this->load->model("periodo");
        $this->load->model("curso");
        $this->load->model("usuario");
        $this->load->model("materia");
        $this->load->model("estudiante");
        $this->load->model("representante");
    }
 
	public function index()
	{        
        if($this->session->userdata('comil_codigo_usu') && $this->session->userdata('comil_perfil_usu')=="ADMINISTRADOR"){        
            
            $data['periodos']=$this->periodo->obtenerTodos();            
            $this->load->view('header');
            $this->load->view('cursos/index',$data);
            $this->load->view('footer');            
        }else{
            $this -> session -> sess_destroy();
            $this->session->sess_create();
            $this -> session ->set_flashdata("errorLogin","No tiene permisos para acceder a la página solicitada.");   
            redirect ("/security/login");   
        }
	}
    
    
    public function listado()
	{        
        if($this->session->userdata('comil_codigo_usu') && $this->session->userdata('comil_perfil_usu')=="ADMINISTRADOR"){       
            
            $data['periodo']=$this->periodo->obtenerPeriodoActivo();
            
            if($data['periodo']){
                $data['cursos']=$this->curso->obtenerCursosPorPeriodo($data['periodo']->codigo_per);                               
            }else{
                $data['cursos']=false;                               
                
            }
            
            $this->load->view('header');
            $this->load->view('cursos/listado',$data);
            $this->load->view('footer');            
        }else{
            $this -> session -> sess_destroy();
            $this->session->sess_create();
            $this -> session ->set_flashdata("errorLogin","No tiene permisos para acceder a la página solicitada.");   
            redirect ("/security/login");   
        }
	}
    
    
    public function consultarDocentes(){
         $docentes=$this->usuario->obtenerDocentes();    
         if($docentes){
            echo json_encode($docentes->result());
         }else{
             echo json_encode(false);
         }
    }
    
       public function editar($id_periodo,$id_curso)
        {        
            if($this->session->userdata('comil_codigo_usu') && $this->session->userdata('comil_perfil_usu')=="ADMINISTRADOR"){        

                $data['curso']=$this->curso->obtenerCursoPorId($id_curso); 
                $data['periodo']=$this->periodo->obtenerPeriodo($id_periodo);
                $data['docentes']=$this->usuario->obtenerDocentes($id_periodo); 
                $this->load->view('header');
                $this->load->view('cursos/editar',$data);
                $this->load->view('footer');            
            }else{
                $this -> session -> sess_destroy();
                $this->session->sess_create();
                $this -> session ->set_flashdata("errorLogin","No tiene permisos para acceder a la página solicitada.");   
                redirect ("/security/login");   
            }
        }
    
    
    public function guardarCurso(){
        
        $data=array(
            "seccion_cur"=>$this->input->post("seccion_cur"),
            "nombre_cur"=>$this->input->post("nombre_cur"),
            "paralelo_cur"=>$this->input->post("paralelo_cur"),
            "codigo_usu"=>$this->input->post("codigo_usu"),
            "codigo_per"=>$this->input->post("codigo_per")
        );
        
        if($this->curso->insertar($data)){
            $this->session->set_flashdata("confirmacion","Curso insertado exitosamente");
        }else{
            $this->session->set_flashdata("error","Error al insertar. Intente nuevamente.");
        }
        $url="/cursos/listado/".$this->input->post("codigo_per");
        redirect($url);
        
    }
    
    
     public function editarCurso(){
        
        $data=array(
            "seccion_cur"=>$this->input->post("seccion_cur"),
            "nombre_cur"=>$this->input->post("nombre_cur"),
            "paralelo_cur"=>$this->input->post("paralelo_cur"),
            "codigo_usu"=>$this->input->post("codigo_usu"),
            "codigo_per"=>$this->input->post("codigo_per")
        );
        
        if($this->curso->editar($this->input->post("codigo_cur"),$data)){
            $this->session->set_flashdata("confirmacion","Curso insertado exitosamente");
        } 
         
        $url="/cursos/listado/".$this->input->post("codigo_per");
        redirect($url);
        
    }
    
    
    
     public function eliminarCurso(){
            $codigo_cur = $this->input->post("codigo_cur");
            $codigo_per = $this->input->post("codigo_per");

            
            if($this->curso->eliminar($codigo_cur)>0){
                  $this->session->set_flashdata("confirmacion","Curso eliminado exitosamente");
            }else{
                $this->session->set_flashdata("error","Error al eliminar. Revise que el curso no se relacione con otras áreas del sistema.");
            }
        
           $url=site_url('/cursos/listado').'/'.$codigo_per;
           redirect($url);
           
    }
    
    
    public function materias($id_periodo,$id_curso)
	{        
        if($this->session->userdata('comil_codigo_usu') && $this->session->userdata('comil_perfil_usu')=="ADMINISTRADOR"){        
            
            $data['curso']=$this->curso->obtenerCursoPorId($id_curso); 
            $data['periodo']=$this->periodo->obtenerPeriodo($id_periodo); 
            $data['docentes']=$this->usuario->obtenerDocentes($id_periodo); 
            $data['materias']=$this->materia->obtenerMateriasPorCurso($id_curso);    
            $this->load->view('header');
            $this->load->view('cursos/materias',$data);
            $this->load->view('footer');           
        }else{
            $this -> session -> sess_destroy();
            $this->session->sess_create();
            $this -> session ->set_flashdata("errorLogin","No tiene permisos para acceder a la página solicitada.");   
            redirect ("/security/login");   
        }
	}
    
    
    public function guardarMateria(){
        
        $data=array(
            "nombre_mat"=>$this->input->post("nombre_mat"),
            "codigo_usu"=>$this->input->post("codigo_usu"),
            "codigo_cur"=>$this->input->post("codigo_cur")
        );
        
        if($this->materia->insertar($data)){
            $this->session->set_flashdata("confirmacion","Materia insertada exitosamente");
        }else{
            $this->session->set_flashdata("error","Error al insertar. Intente nuevamente.");
        }
        $url="/cursos/materias/".$this->input->post("codigo_per").'/'.$this->input->post("codigo_cur");
        redirect($url);
        
    }
    
    
    
    
     //Nuevo
     public function validarNombreMateriaNuevo(){

            $nombre_mat = $this->input->post("nombre_mat");
            $codigo_cur = $this->input->post("codigo_cur");
            echo json_encode(!$this->materia->existeNombreNuevo($nombre_mat,$codigo_cur));             
           //echo $nombre_mat.' CURSO:'.$codigo_cur;
    }
    
    
    public function editarMateria($id_periodo,$id_curso,$id_materia){
          if($this->session->userdata('comil_codigo_usu') && $this->session->userdata('comil_perfil_usu')=="ADMINISTRADOR"){        
            
            $data['curso']=$this->curso->obtenerCursoPorId($id_curso); 
            $data['periodo']=$this->periodo->obtenerPeriodo($id_periodo); 
            $data['materia']=$this->materia->obtenerMateriaPorId($id_materia); 
            $data['docentes']=$this->usuario->obtenerDocentes($id_periodo);
            $this->load->view('header');
            $this->load->view('cursos/editarMateria',$data);
            $this->load->view('footer');           
        }else{
            $this -> session -> sess_destroy();
            $this->session->sess_create();
            $this -> session ->set_flashdata("errorLogin","No tiene permisos para acceder a la página solicitada.");   
            redirect ("/security/login");   
        }
    }
    

    
       //Editar
      public function validarNombreMateria(){
          
            $codigo_mat = $this->input->post("codigo_mat");
            $nombre_mat = $this->input->post("nombre_mat");                                      
            $codigo_cur=  $this->input->post("codigo_cur");                                      
            echo json_encode(!$this->materia->existeNombre($codigo_cur,$codigo_mat,$nombre_mat));   
            
           
    }
    
    
     public function actualizarMateria(){
        
        $codigo_mat=$this->input->post("codigo_mat");
         
        $data=array(
            "nombre_mat"=>$this->input->post("nombre_mat"),
            "codigo_usu"=>$this->input->post("codigo_usu")            
        );
        
        if($this->materia->editar($codigo_mat,$data)){
            $this->session->set_flashdata("confirmacion","Materia editada exitosamente");
        }
         
        $url="/cursos/materias/".$this->input->post("codigo_per").'/'.$this->input->post("codigo_cur");
        redirect($url);
        
    }
    
    
      public function eliminarMateria(){
            $codigo_cur = $this->input->post("codigo_cur");
            $codigo_per = $this->input->post("codigo_per");
            $codigo_mat = $this->input->post("codigo_mat");

            
            if($this->materia->eliminar($codigo_mat)>0){
                  $this->session->set_flashdata("confirmacion","Materia eliminada exitosamente");
            }else{
                $this->session->set_flashdata("error","Error al eliminar. Revise que la materia no se relacione con otras áreas del sistema.");
            }
        
           $url=site_url('/cursos/materias').'/'.$codigo_per.'/'.$codigo_cur;
           redirect($url);
           
    }
    
    
    
       
    public function estudiantes($id_periodo,$id_curso)
	{        
        if($this->session->userdata('comil_codigo_usu') && $this->session->userdata('comil_perfil_usu')=="ADMINISTRADOR"){        
            
            $data['curso']=$this->curso->obtenerCursoPorId($id_curso); 
            $data['periodo']=$this->periodo->obtenerPeriodo($id_periodo); 
            $data['estudiantes']=$this->estudiante->obtenerListadoPorCurso($id_curso);   
            $data['representantes']=$this->representante->obtenerTodos();   
            $this->load->view('header');
            $this->load->view('cursos/estudiantes',$data);
            $this->load->view('footer');           
        }else{
            $this -> session -> sess_destroy();
            $this->session->sess_create();
            $this -> session ->set_flashdata("errorLogin","No tiene permisos para acceder a la página solicitada.");   
            redirect ("/security/login");   
        }
	}
    
    public function leerArchivo()
    {
        
            // INICIO -> subiendo el archivo csv
        
            $this->load->library('csvreader');                    
            $archivo = 'archivo';
            $config['upload_path'] = "uploads/";
            $config['file_name'] = "archivo_auxiliar";
            $config['allowed_types'] = "*";
            $config['max_size'] = "50000";
            $config['max_width'] = "2000";
            $config['max_height'] = "2000";

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload($archivo)) {              
                $data['uploadError'] = $this->upload->display_errors();
                echo $this->upload->display_errors();
                return;
            }

            $archivo_subido= $this->upload->data();
               
            $result =$this->csvreader->parse_file($archivo_subido['full_path']);
            unlink($archivo_subido['full_path']);
            
            // FIN -> subiendo el archivo csv
        
        
           /*   0->$numeroEstudiante=0; 
                1->$nombreEstudiante="";
                2->$cedulaEstudiante="";
                3->$fechaNacimientoEstudiante="";
                4->$direccionEstudiante="";
                5->$lugarNacimientoEstudiante="";
                6->$nombreRepresentante="";
                7->$cedulaRepresentante="";
                8->$nombrePadre="";
                9->$cedulaPadre="";
                10->$nombreMadre="";
                11->$cedulaMadre="";
                12->$telefonoRepresentante="";
            */
            
 
            foreach($result as $fila){
                
                $datosEstudiante=array(
                    "nombre_est"=>$fila[1],
                    "cedula_est"=>$fila[2],
                    "fechanacimiento_est"=>$fila[3],
                    "direccion_est"=>$fila[4],
                    "lugarnacimiento_est"=>$fila[5],
                    "nombrepadre_est"=>$fila[8],
                    "cedulapadre_est"=>$fila[9],
                    "nombremadre_est"=>$fila[10],
                    "cedulamadre_est"=>$fila[11],
                    "codigo_cur"=>$this->input->post("codigo_cur")
                );
                
             
                
                $datosRepresentante=array(
                    "nombre_usu"=>$fila[6],
                    "cedula_usu"=>$fila[7],
                    "telefono_usu"=>$fila[12]
                );
                
                
                $representante=$this->usuario->buscarPorCedula($datosRepresentante["cedula_usu"]);
                if($representante){
                    $datosEstudiante['codigo_usu']=$representante->codigo_usu;
                }else{
                   $datosEstudiante['codigo_usu']=$this->usuario->insertarRepresentante($datosRepresentante);
                }
                
                $this->estudiante->insertar($datosEstudiante);
                
                
            }
        
            $this->session->set_flashdata('confirmacion',"Los estudiantes han sido cargados exitosamente en este curso.");
            
            $codigo_per=$this->input->post("codigo_per");
        
            $url=site_url("/cursos/estudiantes")."/".$codigo_per."/".$datosEstudiante['codigo_cur'];
            redirect($url);
            
        
          
    }
    
    
    public function guardarEstudiante(){
           
                
            $datosEstudiante=array(
                "nombre_est"=>$this->input->post('nombre_est'),
                "cedula_est"=>$this->input->post('cedula_est'),
                "fechanacimiento_est"=>$this->input->post('fechanacimiento_est'),
                "direccion_est"=>$this->input->post('direccion_est'),
                "lugarnacimiento_est"=>$this->input->post('lugarnacimiento_est'),
                "nombrepadre_est"=>$this->input->post('nombrepadre_est'),
                "cedulapadre_est"=>$this->input->post('cedulapadre_est'),
                "nombremadre_est"=>$this->input->post('nombremadre_est'),
                "cedulamadre_est"=>$this->input->post('cedulamadre_est'),
                "codigo_cur"=>$this->input->post("codigo_cur"),
                "codigo_usu"=>$this->input->post("codigo_usu")
            );
            
        
            if($this->estudiante->insertar($datosEstudiante)){
                $this->session->set_flashdata('confirmacion',"Estudiante guardado exitosamente");    
            }else{
                $this->session->set_flashdata('error',"Error al insertar. Intente Nuevamente");    
            }
     
            $codigo_per=$this->input->post("codigo_per");
        
            $url=site_url("/cursos/estudiantes")."/".$codigo_per."/".$datosEstudiante['codigo_cur'];
            redirect($url);
        
    }
    
    
    
    public function editarEstudiante($id_periodo,$id_curso,$id_estudiante)
	{        
        if($this->session->userdata('comil_codigo_usu') && $this->session->userdata('comil_perfil_usu')=="ADMINISTRADOR"){        
            
            $data['curso']=$this->curso->obtenerCursoPorId($id_curso); 
            $data['periodo']=$this->periodo->obtenerPeriodo($id_periodo); 
            $data['estudiante']=$this->estudiante->obtenerEstudiantePorId($id_estudiante);   
            $data['representantes']=$this->representante->obtenerTodos();   
            $this->load->view('header');
            $this->load->view('cursos/editarEstudiante',$data);
            $this->load->view('footer');           
        }else{
            $this -> session -> sess_destroy();
            $this->session->sess_create();
            $this -> session ->set_flashdata("errorLogin","No tiene permisos para acceder a la página solicitada.");   
            redirect ("/security/login");   
        }
	}
    
    
    
    
    
    public function actualizarEstudiante(){
   
            $id_est=$this->input->post('codigo_est');
        
            $datosEstudiante=array(
                "nombre_est"=>$this->input->post('nombre_est'),
                "cedula_est"=>$this->input->post('cedula_est'),
                "fechanacimiento_est"=>$this->input->post('fechanacimiento_est'),
                "direccion_est"=>$this->input->post('direccion_est'),
                "lugarnacimiento_est"=>$this->input->post('lugarnacimiento_est'),
                "nombrepadre_est"=>$this->input->post('nombrepadre_est'),
                "cedulapadre_est"=>$this->input->post('cedulapadre_est'),
                "nombremadre_est"=>$this->input->post('nombremadre_est'),
                "cedulamadre_est"=>$this->input->post('cedulamadre_est'),
                "codigo_cur"=>$this->input->post("codigo_cur"),
                "codigo_usu"=>$this->input->post("codigo_usu")
            );
            
        
     
        
        if($this->estudiante->editar($id_est,$datosEstudiante)){
            $this->session->set_flashdata('confirmacion',"Estudiante editado exitosamente");    
        }

        $codigo_per=$this->input->post("codigo_per");

        $url=site_url("/cursos/estudiantes")."/".$codigo_per."/".$datosEstudiante['codigo_cur'];
        redirect($url);
            
            
        
    }
    
    
    
    
         //Nuevo
     public function validarCedulaEstudianteNuevo(){

            $cedula_est = $this->input->post("cedula_est");
            $codigo_cur = $this->input->post("codigo_cur");
            echo json_encode(!$this->estudiante->existeCedulaNuevo($cedula_est,$codigo_cur));             
           //echo $nombre_mat.' CURSO:'.$codigo_cur;
    }
    
       //Editar
      public function validarCedulaEstudiante(){
          
            $codigo_est = $this->input->post("codigo_est");
            $cedula_est = $this->input->post("cedula_est");                                      
            $codigo_cur=  $this->input->post("codigo_cur");              
            echo json_encode(!$this->estudiante->existeCedula($codigo_cur,$codigo_est,$cedula_est));   
            
           
    }
    
 
}


?>