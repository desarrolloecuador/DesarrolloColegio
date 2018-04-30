<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Comunicados extends CI_Controller {
    
    function __construct(){
        parent :: __construct();
        $this->load->model("periodo");
        $this->load->model("curso");
        $this->load->model("usuario");
        $this->load->model("materia");
        $this->load->model("estudiante");
        $this->load->model("asistencia");
        $this->load->model("aporte");        
        $this->load->model("comunicado");
    }

       
    public function listado($id_curso,$id_periodo,$id_materia)
	{        
        if($this->session->userdata('comil_codigo_usu') && $this->session->userdata('comil_perfil_usu')=="DOCENTE"){        
            
            $data['curso']=$this->curso->obtenerCursoPorId($id_curso); 
            $data['periodo']=$this->periodo->obtenerPeriodo($id_periodo); 
            $data['materia']=$this->materia->obtenerMateriaPorId($id_materia);
            $data['estudiantes']=$this->estudiante->obtenerListadoPorCurso($id_curso);     
            $data['comunicados']=$this->comunicado->consultarPorMateria($id_materia);
            $this->load->view('header');
            $this->load->view('comunicados/index',$data);
            $this->load->view('footer');           
        }else{
            $this -> session -> sess_destroy();
            $this->session->sess_create();
            $this -> session ->set_flashdata("errorLogin","No tiene permisos para acceder a la página solicitada.");   
            redirect ("/security/login");   
        }
	}    
    
    
    public function guardarComunicado(){
        
        $id_periodo=$this->input->post('codigo_per');
        $id_materia=$this->input->post('codigo_mat');
        $id_curso=$this->input->post('codigo_cur');        
        $arrayCodigoEstudiantes=$this->input->post('codigo_est');
      
         
        $data=array(
            'fecha_com'=>$this->input->post('fecha_com'),
            'mensaje_com'=>$this->input->post('mensaje_com'),            
            'codigo_mat'=>$this->input->post('codigo_mat'),
            'tipo_com'=>'MANUAL'
        );
        
        
        $codigo_comunicado=$this->comunicado->insertar($data);
        
                
            if($codigo_comunicado>0){
                 
                
               foreach( $arrayCodigoEstudiantes as $codigo_est_aux)
                { 
                    $estudiante=$this->estudiante->obtenerEstudiantePorId($codigo_est_aux);
                     
                     $datosComunicado=array(                        
                        "codigo_com"=>$codigo_comunicado,
                        "codigo_est"=>$estudiante->codigo_est,
                        "alarma_ec"=>0,
                        "representante_usu"=>$estudiante->codigo_usu
                     );
                     
                     $this->comunicado->registrarComunicadoEstudiante($datosComunicado);
                 }
                
                 $this -> session ->set_flashdata("confirmacion","Comunicado Creado Exitosamente.");   
                
            }else{
                $this -> session ->set_flashdata("error","No se puede registrar el comunicado, debido a que la materia y curso indicados no registran estudiantes.");   
            }
       
        
        

            $url=site_url('comunicados/listado').'/'.$id_curso.'/'.$id_periodo.'/'.$id_materia;
            redirect ($url);
        
    }
    
    
    public function detalleRegistroComunicados($id_curso,$id_periodo,$id_materia,$id_comunicado){
        $data['curso']=$this->curso->obtenerCursoPorId($id_curso); 
        $data['periodo']=$this->periodo->obtenerPeriodo($id_periodo); 
        $data['materia']=$this->materia->obtenerMateriaPorId($id_materia);
        $data['comunicado']=$this->comunicado->consultarComunicadoPorId($id_comunicado);
        $data['estudiantes']=$this->comunicado->consultarEstudiantePorCodigoComunicado($id_comunicado);
        
        $this->load->view('header');
        $this->load->view('comunicados/detalleRegistroComunicado',$data);
        $this->load->view('footer');     
    }
  
    
    public function eliminarComunicado(){
        $id_periodo=$this->input->post('codigo_per');
        $id_materia=$this->input->post('codigo_mat');
        $id_curso=$this->input->post('codigo_cur');
        $codigo_com=$this->input->post('codigo_com');

        if($this->comunicado->eliminar($codigo_com)){
             $this -> session ->set_flashdata("confirmacion","Comunicado Eliminado Exitosamente.");   
        }else{
             $this -> session ->set_flashdata("error","Error al Eliminar. Intente Nuevamente.");   
        }  
        
        $url=site_url('comunicados/listado').'/'.$id_curso.'/'.$id_periodo.'/'.$id_materia;
        redirect ($url);           
    }
    
    public function actualizarCalificacionComunicados(){

        $id_periodo=$this->input->post('codigo_per');
        $id_materia=$this->input->post('codigo_mat');
        $id_curso=$this->input->post('codigo_cur');
        $id_comunicado=$this->input->post('codigo_com');               
        
        $curso=$this->curso->obtenerCursoPorId($id_curso); 
        $periodo=$this->periodo->obtenerPeriodo($id_periodo); 
        $materia=$this->materia->obtenerMateriaPorId($id_materia);
        $comunicados=$this->comunicado->consultarComunicadoPorId($id_comunicado);
        $estudiantes=$this->comunicado->consultarNotaPorCodigocomunicados($id_comunicado);
        
     
        $arregloObservaciones=$this->input->post('observacion_cd');        
        $arregloCodigos=$this->input->post('codigo_cd');
        
        for($i=0;$i<sizeof($arregloObservaciones);$i++){ 
            
            $notaEstudianteAux=$this->input->post('calificacion_cd_'.$arregloCodigos[$i]);
            $data=array(
                "observacion_cd"=>$arregloObservaciones[$i],
                "calificacion_cd"=>$notaEstudianteAux
            );
            $this->comunicado->actualizarNotaCalificacioncomunicados($arregloCodigos[$i],$data);
        }
        
        $this -> session ->set_flashdata("confirmacion","Calificaciones de comunicados guardadas exitosamente.");   
        $url=site_url('comunicados/detalleRegistrocomunicados').'/'.$id_curso.'/'.$id_periodo.'/'.$id_materia.'/'.$id_comunicado;
        redirect ($url);
        
        
    }
    
    
    public function consultarComunicadosSinAlarmaMovil(){
        $representante_usu=$this->input->post("representante_usu");
        $comunicados=$this->comunicado->consultarComunicadosSinAlarmaPorRepresentante($representante_usu);
        
        if($comunicados){
            $miComunicado=$comunicados->row();
            $this->comunicado->desactivarAlarma($miComunicado->codigo_com,$representante_usu);
            echo json_encode($comunicados->row());
        }else{
            echo json_encode(false);
        }        
    }
 
}


?>