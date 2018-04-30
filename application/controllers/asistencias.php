<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Asistencias extends CI_Controller {
    
    function __construct(){
        parent :: __construct();
        $this->load->model("periodo");
        $this->load->model("curso");
        $this->load->model("usuario");
        $this->load->model("materia");
        $this->load->model("estudiante");
        $this->load->model("asistencia");
        $this->load->model("comunicado");
    }

       
    public function listado($id_curso,$id_periodo,$id_materia)
	{        
        if($this->session->userdata('comil_codigo_usu') && $this->session->userdata('comil_perfil_usu')=="DOCENTE"){        
            
            $data['curso']=$this->curso->obtenerCursoPorId($id_curso); 
            $data['periodo']=$this->periodo->obtenerPeriodo($id_periodo); 
            $data['materia']=$this->materia->obtenerMateriaPorId($id_materia);
            $data['estudiantes']=$this->estudiante->obtenerListadoPorCurso($id_curso);     
            $data['asistencias']=$this->asistencia->consultarPorMateria($id_materia);
            $this->load->view('header');
            $this->load->view('asistencias/index',$data);
            $this->load->view('footer');           
        }else{
            $this -> session -> sess_destroy();
            $this->session->sess_create();
            $this -> session ->set_flashdata("errorLogin","No tiene permisos para acceder a la página solicitada.");   
            redirect ("/security/login");   
        }
	}    
    
    
    public function guardarAsistencia(){
        
        $id_periodo=$this->input->post('codigo_per');
        $id_materia=$this->input->post('codigo_mat');
        $id_curso=$this->input->post('codigo_cur');
           
        $data=array(
            'fecha_asi'=>$this->input->post('fecha_asi'),
            'hora_asi'=>$this->input->post('hora_asi'),
            'observacion_asi'=>$this->input->post('observacion_asi'),
            'codigo_mat'=>$this->input->post('codigo_mat')            
        );
        
         $estudiantes=$this->estudiante->obtenerListadoPorCurso($id_curso);
        
        if($estudiantes){ 
            $codigo_asistencia=$this->asistencia->insertar($data);            
            if($codigo_asistencia>0){
                 
                 foreach($estudiantes->result() as $estudiante){
                     
                     $datosAsistencia=array(
                        "estado_ra"=>0,
                        "codigo_asi"=>$codigo_asistencia,
                        "codigo_est"=>$estudiante->codigo_est
                     );
                     
                     $this->asistencia->registrarAsistenciaEstudiante($datosAsistencia);
                 }
                
                 $this -> session ->set_flashdata("confirmacion","Asistencia Creada Exitosamente."); 
                
                 $url=site_url('asistencias/detalleRegistroAsistencia').'/'.$id_curso.'/'.$id_periodo.'/'.$id_materia.'/'.$codigo_asistencia;
                 redirect ($url);
                
            }else{
                 $this -> session ->set_flashdata("error","Error al insertar. Intente Nuevamente.");   
            }  
        }else{
            $this -> session ->set_flashdata("error","No se puede registrar la asistencia, debido a que la materia y curso indicados no registran estudiantes.");   
        }

        $url=site_url('asistencias/listado').'/'.$id_curso.'/'.$id_periodo.'/'.$id_materia;
        redirect ($url);
    }
    
    
    public function detalleRegistroAsistencia($id_curso,$id_periodo,$id_materia,$id_asistencia){
        $data['curso']=$this->curso->obtenerCursoPorId($id_curso); 
        $data['periodo']=$this->periodo->obtenerPeriodo($id_periodo); 
        $data['materia']=$this->materia->obtenerMateriaPorId($id_materia);
        $data['asistencia']=$this->asistencia->consultarAsistenciaPorId($id_asistencia);
        $data['estudiantes']=$this->asistencia->consultarRegistroPorCodigoAsistencia($id_asistencia);
        
        $this->load->view('header');
        $this->load->view('asistencias/detalleRegistroAsistencia',$data);
        $this->load->view('footer');     
    }
  
    public function eliminarAsistencia(){
        $id_periodo=$this->input->post('codigo_per');
        $id_materia=$this->input->post('codigo_mat');
        $id_curso=$this->input->post('codigo_cur');
        $codigo_asi=$this->input->post('codigo_asi');

        if($this->asistencia->eliminar($codigo_asi)){
             $this -> session ->set_flashdata("confirmacion","Asistencia Eliminada Exitosamente.");   
        }else{
             $this -> session ->set_flashdata("error","Error al Eliminar. Intente Nuevamente.");   
        }  
        
        $url=site_url('asistencias/listado').'/'.$id_curso.'/'.$id_periodo.'/'.$id_materia;
        redirect ($url);           
    }
    
    public function actualizarRegistroAsistencias(){

        $id_periodo=$this->input->post('codigo_per');
        $id_materia=$this->input->post('codigo_mat');
        $id_curso=$this->input->post('codigo_cur');
        $id_asistencia=$this->input->post('codigo_asi');               
        
        $curso=$this->curso->obtenerCursoPorId($id_curso); 
        $periodo=$this->periodo->obtenerPeriodo($id_periodo); 
        $materia=$this->materia->obtenerMateriaPorId($id_materia);
        $asistencia=$this->asistencia->consultarAsistenciaPorId($id_asistencia);
        $estudiantes=$this->asistencia->consultarRegistroPorCodigoAsistencia($id_asistencia);
        
     
        $arregloEstados=$this->input->post('estado_ra');
        $arregloCodigos=$this->input->post('codigo_ra');
        
        for($i=0;$i<sizeof($arregloEstados);$i++){            
            $data=array(
                "estado_ra"=>$arregloEstados[$i]
            );

            
            //INICIO -> COMUNICADO
            $estado_asi="";
            if($arregloEstados[$i]==0){
                $estado_asi="No Asignado";
            }
            if($arregloEstados[$i]==1){
                $estado_asi="Asistencia Normal";
            }
            if($arregloEstados[$i]==2){
                $estado_asi="Atraso";
            }
            if($arregloEstados[$i]==3){
                $estado_asi="Falta";
            }
            if($arregloEstados[$i]==4){
                $estado_asi="Fuga";
            }
      
            
            $ra=$this->asistencia->consultarRegistroAsistenciaPorCodigo($arregloCodigos[$i]);             
            $this->enviarNotificacion("",$id_materia,$ra->codigo_est,$estado_asi);
            //FIN -> COMUNICADO
           
            $this->asistencia->actualizarEstadoRegistroAsistencia($arregloCodigos[$i],$data);
        }
        
        $this -> session ->set_flashdata("confirmacion","Registro guardado exitosamente.");   
        $url=site_url('asistencias/detalleRegistroAsistencia').'/'.$id_curso.'/'.$id_periodo.'/'.$id_materia.'/'.$id_asistencia;
        redirect ($url);
        
        
    }
    
    
    
    function enviarNotificacion($mensaje_com,$codigo_mat,$codigo_est,$estado_asi){
        
        
        
        $estudiante=$this->estudiante->obtenerEstudiantePorId($codigo_est); 

        $mensaje_com=$estado_asi." | ".$estudiante->nombre_est;
   
        $date = new DateTime("now", new DateTimeZone('America/Guayaquil') );
        
        $fecha_com=$date->format('Y-m-d H:i:s');            
        
        $data=array(
            'fecha_com'=>$fecha_com,
            'mensaje_com'=>$mensaje_com,            
            'codigo_mat'=>$codigo_mat,
            'tipo_com'=>"AUTOMATICO"
        );
        
        
        $codigo_comunicado=$this->comunicado->insertar($data);
        
                
            if($codigo_comunicado>0){
     
                                                
                   
                     $datosComunicado=array(                        
                        "codigo_com"=>$codigo_comunicado,
                        "codigo_est"=>$estudiante->codigo_est,
                        "alarma_ec"=>0,
                        "representante_usu"=>$estudiante->codigo_usu
                     );
                     
                     $this->comunicado->registrarComunicadoEstudiante($datosComunicado);
                 }
   
        
    }
 
}


?>