<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Disciplinas extends CI_Controller {
    
    function __construct(){
        parent :: __construct();
        $this->load->model("periodo");
        $this->load->model("curso");
        $this->load->model("usuario");
        $this->load->model("materia");
        $this->load->model("estudiante");
        $this->load->model("asistencia");
        $this->load->model("aporte");
        $this->load->model("disciplina");
        $this->load->model("comunicado");
    }

       
    public function listado($id_curso,$id_periodo,$id_materia)
	{        
        if($this->session->userdata('comil_codigo_usu') && $this->session->userdata('comil_perfil_usu')=="DOCENTE"){        
            
            $data['curso']=$this->curso->obtenerCursoPorId($id_curso); 
            $data['periodo']=$this->periodo->obtenerPeriodo($id_periodo); 
            $data['materia']=$this->materia->obtenerMateriaPorId($id_materia);
            $data['estudiantes']=$this->estudiante->obtenerListadoPorCurso($id_curso);     
            $data['disciplinas']=$this->disciplina->consultarPorMateria($id_materia);
            $this->load->view('header');
            $this->load->view('disciplinas/index',$data);
            $this->load->view('footer');           
        }else{
            $this -> session -> sess_destroy();
            $this->session->sess_create();
            $this -> session ->set_flashdata("errorLogin","No tiene permisos para acceder a la página solicitada.");   
            redirect ("/security/login");   
        }
	}    
    
    
    public function guardarDisciplina(){
        
        $id_periodo=$this->input->post('codigo_per');
        $id_materia=$this->input->post('codigo_mat');
        $id_curso=$this->input->post('codigo_cur');
           
        $data=array(
            'fecha_dis'=>$this->input->post('fecha_dis'),
            'observacion_dis'=>$this->input->post('observacion_dis'),            
            'codigo_mat'=>$this->input->post('codigo_mat')
        );
        
         $estudiantes=$this->estudiante->obtenerListadoPorCurso($id_curso);
        
        if($estudiantes){ 
            $codigo_disciplina=$this->disciplina->insertar($data);            
            if($codigo_disciplina>0){
                 
                 foreach($estudiantes->result() as $estudiante){
                     
                     $datosDisciplina=array(
                        "calificacion_cd"=>-1,
                        "codigo_dis"=>$codigo_disciplina,
                        "codigo_est"=>$estudiante->codigo_est
                     );
                     
                     $this->disciplina->registrarCalificacionEstudiante($datosDisciplina);
                 }
                
                 $this -> session ->set_flashdata("confirmacion","Registro de Disciplina Creado Exitosamente."); 
                
                $url=site_url('disciplinas/detalleRegistroDisciplinas').'/'.$id_curso.'/'.$id_periodo.'/'.$id_materia."/".$codigo_disciplina;
                
                redirect ($url);
                                
            }else{
                 $this -> session ->set_flashdata("error","Error al insertar. Intente Nuevamente.");   
            }  
        }else{
            $this -> session ->set_flashdata("error","No se puede registrar la disciplina, debido a que la materia y curso indicados no registran estudiantes.");   
        }

        $url=site_url('disciplinas/listado').'/'.$id_curso.'/'.$id_periodo.'/'.$id_materia;
        redirect ($url);
    }
    
    
    public function detalleRegistroDisciplinas($id_curso,$id_periodo,$id_materia,$id_disciplina){
        $data['curso']=$this->curso->obtenerCursoPorId($id_curso); 
        $data['periodo']=$this->periodo->obtenerPeriodo($id_periodo); 
        $data['materia']=$this->materia->obtenerMateriaPorId($id_materia);
        $data['disciplina']=$this->disciplina->consultarDisciplinaPorId($id_disciplina);
        $data['estudiantes']=$this->disciplina->consultarNotaPorCodigoDisciplina($id_disciplina);
        
        $this->load->view('header');
        $this->load->view('disciplinas/detalleRegistroDisciplina',$data);
        $this->load->view('footer');     
    }
  
    
    public function eliminarDisciplina(){
        $id_periodo=$this->input->post('codigo_per');
        $id_materia=$this->input->post('codigo_mat');
        $id_curso=$this->input->post('codigo_cur');
        $codigo_dis=$this->input->post('codigo_dis');

        if($this->disciplina->eliminar($codigo_dis)){
             $this -> session ->set_flashdata("confirmacion","Registro de Disciplina Eliminado Exitosamente.");   
        }else{
             $this -> session ->set_flashdata("error","Error al Eliminar. Intente Nuevamente.");   
        }  
        
        $url=site_url('disciplinas/listado').'/'.$id_curso.'/'.$id_periodo.'/'.$id_materia;
        redirect ($url);           
    }
    
    public function actualizarCalificacionDisciplina(){

        $id_periodo=$this->input->post('codigo_per');
        $id_materia=$this->input->post('codigo_mat');
        $id_curso=$this->input->post('codigo_cur');
        $id_disciplina=$this->input->post('codigo_dis');               
        
        $curso=$this->curso->obtenerCursoPorId($id_curso); 
        $periodo=$this->periodo->obtenerPeriodo($id_periodo); 
        $materia=$this->materia->obtenerMateriaPorId($id_materia);
        $disciplina=$this->disciplina->consultarDisciplinaPorId($id_disciplina);
        $estudiantes=$this->disciplina->consultarNotaPorCodigoDisciplina($id_disciplina);
        
     
        $arregloObservaciones=$this->input->post('observacion_cd');        
        $arregloCodigos=$this->input->post('codigo_cd');
        
        for($i=0;$i<sizeof($arregloObservaciones);$i++){ 
            
            $notaEstudianteAux=$this->input->post('calificacion_cd_'.$arregloCodigos[$i]);
            $data=array(
                "observacion_cd"=>$arregloObservaciones[$i],
                "calificacion_cd"=>$notaEstudianteAux
            );
            
            
            //INICIO -> COMUNICADO
            $cd=$this->disciplina->consultarCalificacionDisciplina($arregloCodigos[$i]); 
          
            if($notaEstudianteAux=='D' || $notaEstudianteAux=='E'){
                $this->enviarNotificacion("DISCIPLINA: ".$disciplina->observacion_dis,$id_materia,$cd->codigo_est,$notaEstudianteAux);
            }
            //FIN -> COMUNICADO
            
            
            $this->disciplina->actualizarNotaCalificacionDisciplina($arregloCodigos[$i],$data);
        }
        
        $this -> session ->set_flashdata("confirmacion","Calificaciones de Disciplina guardadas exitosamente.");   
        $url=site_url('disciplinas/detalleRegistroDisciplinas').'/'.$id_curso.'/'.$id_periodo.'/'.$id_materia.'/'.$id_disciplina;
        redirect ($url);
        
        
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