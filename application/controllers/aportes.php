<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Aportes extends CI_Controller {
    
    function __construct(){
        parent :: __construct();
        $this->load->model("periodo");
        $this->load->model("curso");
        $this->load->model("usuario");
        $this->load->model("materia");
        $this->load->model("estudiante");
        $this->load->model("asistencia");
        $this->load->model("aporte");
        $this->load->model("tipo");
        $this->load->model("comunicado");
    }

       
    public function listado($id_curso,$id_periodo,$id_materia)
	{        
        if($this->session->userdata('comil_codigo_usu') && $this->session->userdata('comil_perfil_usu')=="DOCENTE"){        
            
            $data['curso']=$this->curso->obtenerCursoPorId($id_curso); 
            $data['periodo']=$this->periodo->obtenerPeriodo($id_periodo); 
            $data['materia']=$this->materia->obtenerMateriaPorId($id_materia);
            $data['estudiantes']=$this->estudiante->obtenerListadoPorCurso($id_curso);     
            $data['aportes']=$this->aporte->consultarPorMateria($id_materia);
            $data['tipos']=$this->tipo->obtenerTodos();
            $this->load->view('header');
            $this->load->view('aportes/index',$data);
            $this->load->view('footer');           
        }else{
            $this -> session -> sess_destroy();
            $this->session->sess_create();
            $this -> session ->set_flashdata("errorLogin","No tiene permisos para acceder a la página solicitada.");   
            redirect ("/security/login");   
        }
	}    
    
    
    public function guardarAporte(){
        
        $id_periodo=$this->input->post('codigo_per');
        $id_materia=$this->input->post('codigo_mat');
        $id_curso=$this->input->post('codigo_cur');        
           
        $data=array(
            'fechaenvio_apo'=>$this->input->post('fechaenvio_apo'),
            'fechaentrega_apo'=>$this->input->post('fechaentrega_apo'),
            'observacion_apo'=>$this->input->post('observacion_apo'),
            'codigo_mat'=>$this->input->post('codigo_mat'),
            'codigo_tip'=>$this->input->post('codigo_tip'),
            'quimestre_apo'=>$this->input->post('quimestre_apo')
        );
        
         $estudiantes=$this->estudiante->obtenerListadoPorCurso($id_curso);
        
        if($estudiantes){ 
            $codigo_aporte=$this->aporte->insertar($data);            
            if($codigo_aporte>0){
                 
                 foreach($estudiantes->result() as $estudiante){
                     
                     $datosCalificaciones=array(
                        "calificacion_ca"=>-1,
                        "codigo_apo"=>$codigo_aporte,
                        "codigo_est"=>$estudiante->codigo_est
                     );
                     
                     $this->aporte->registrarCalificacionEstudiante($datosCalificaciones);
                 }
                
                 $this -> session ->set_flashdata("confirmacion","Aporte Creado Exitosamente."); 
                 $url=site_url('aportes/detalleRegistroAporte').'/'.$id_curso.'/'.$id_periodo.'/'.$id_materia.'/'.$codigo_aporte;
                 redirect ($url);
            }else{
                 $this -> session ->set_flashdata("error","Error al insertar. Intente Nuevamente.");   
            }  
        }else{
            $this -> session ->set_flashdata("error","No se puede registrar el aporte, debido a que la materia y curso indicados no registran estudiantes.");   
        }

        $url=site_url('aportes/listado').'/'.$id_curso.'/'.$id_periodo.'/'.$id_materia;
        redirect ($url);
    }
    
    
    public function detalleRegistroAporte($id_curso,$id_periodo,$id_materia,$id_aporte){
        $data['curso']=$this->curso->obtenerCursoPorId($id_curso); 
        $data['periodo']=$this->periodo->obtenerPeriodo($id_periodo); 
        $data['materia']=$this->materia->obtenerMateriaPorId($id_materia);
        $data['aporte']=$this->aporte->consultarAportePorId($id_aporte);
        $data['estudiantes']=$this->aporte->consultarNotaPorCodigoAporte($id_aporte);
        
        $this->load->view('header');
        $this->load->view('aportes/detalleRegistroAporte',$data);
        $this->load->view('footer');     
    }
  
    public function eliminarAporte(){
        $id_periodo=$this->input->post('codigo_per');
        $id_materia=$this->input->post('codigo_mat');
        $id_curso=$this->input->post('codigo_cur');
        $codigo_apo=$this->input->post('codigo_apo');

        if($this->aporte->eliminar($codigo_apo)){
             $this -> session ->set_flashdata("confirmacion","Aporte Eliminado Exitosamente.");   
        }else{
             $this -> session ->set_flashdata("error","Error al Eliminar. Intente Nuevamente.");   
        }  
        
        $url=site_url('aportes/listado').'/'.$id_curso.'/'.$id_periodo.'/'.$id_materia;
        redirect ($url);           
    }
    
    public function actualizarCalificacionAporte(){

        $id_periodo=$this->input->post('codigo_per');
        $id_materia=$this->input->post('codigo_mat');
        $id_curso=$this->input->post('codigo_cur');
        $id_aporte=$this->input->post('codigo_apo');               
        
        $curso=$this->curso->obtenerCursoPorId($id_curso); 
        $periodo=$this->periodo->obtenerPeriodo($id_periodo); 
        $materia=$this->materia->obtenerMateriaPorId($id_materia);
        $aporte=$this->aporte->consultarAportePorId($id_aporte);
        $estudiantes=$this->aporte->consultarNotaPorCodigoAporte($id_aporte);
        
     
        $arregloObservaciones=$this->input->post('observacion_ca');        
        $arregloCodigos=$this->input->post('codigo_ca');
        
        for($i=0;$i<sizeof($arregloObservaciones);$i++){ 
            
            $notaEstudianteAux=$this->input->post('calificacion_ca_'.$arregloCodigos[$i]);
            $data=array(
                "observacion_ca"=>$arregloObservaciones[$i],
                "calificacion_ca"=>$notaEstudianteAux
            );
            
            if($notaEstudianteAux<7){
                //INICIO -> COMUNICADO
                $ca=$this->aporte->consultarCalificacionAportePorCodigo($arregloCodigos[$i]); 

                $this->enviarNotificacion("APORTE: ".$aporte->observacion_apo,$id_materia,$ca->codigo_est,$notaEstudianteAux);
                //FIN -> COMUNICADO
            }
            
            
            $this->aporte->actualizarNotaCalificacionAporte($arregloCodigos[$i],$data);
        }
        
        $this -> session ->set_flashdata("confirmacion","Calificaciones guardadas exitosamente.");   
        $url=site_url('aportes/detalleRegistroAporte').'/'.$id_curso.'/'.$id_periodo.'/'.$id_materia.'/'.$id_aporte;
        redirect ($url);
        
        
    }
    
    
    public function detalleMovilPorEstudiante($id_materia,$cedula_estudiante,$quimestre_apo){
        
        $data['aportes']=$this->aporte->consultarAportesPorMateriaEstudiante($id_materia,$cedula_estudiante,$quimestre_apo);  
        $data['tipos']=$this->tipo->obtenerTodos();
        $this->load->view("aportes/detalleMovilPorEstudiante",$data);
        
    }
    
    
     public function detalleGeneral(){
         
        $data['curso']=$this->curso->obtenerCursoPorId($this->input->post('codigo_cur')); 
        $data['periodo']=$this->periodo->obtenerPeriodo($this->input->post('codigo_per')); 
        $data['materia']=$this->materia->obtenerMateriaPorId($this->input->post('codigo_mat'));
         
        $data['estudiantes']=$this->estudiante->obtenerListadoPorCurso($this->input->post('codigo_cur'));     
        $data['codigo_per']=$this->input->post('codigo_per');
        $data['codigo_mat']=$this->input->post('codigo_mat');
        $data['codigo_cur']=$this->input->post('codigo_cur');
        $data['quimestre_apo']=$this->input->post('quimestre_apo');
        
        
        $data['aportes']=$this->aporte->consultarAportesPorMateria($data['codigo_mat'],$data['quimestre_apo']);  
        $data['tipos']=$this->tipo->obtenerTodos();
         
        $this->load->view('header');
        $this->load->view("aportes/detalleGeneralMateria",$data);
        $this->load->view('footer');
        
    }
    
    
    function enviarNotificacion($mensaje_com,$codigo_mat,$codigo_est,$calificacion_ca){
        

        $estudiante=$this->estudiante->obtenerEstudiantePorId($codigo_est); 

        $mensaje_com.=" | NOTA: ".$calificacion_ca." | ".$estudiante->nombre_est;
   
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