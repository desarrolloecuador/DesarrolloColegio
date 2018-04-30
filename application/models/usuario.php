<?php 

    class Usuario extends CI_Model{
        
        function __construct(){
            parent :: __construct();
        }
        


    function buscarPorUsernamePassword($data){                        
            $query = $this->db->get_where('usuario',$data);            
            if($query -> num_rows > 0){                
                return $query->row();                
            }else{                
                return false;
            }
    }
        
     function buscarPorCodigo($codigo_usu){                        
            $this->db->where("codigo_usu",$codigo_usu);
            $query = $this->db->get('usuario');            
            if($query -> num_rows > 0){                
                return $query->row();                
            }else{                
                return false;
            }
    }
        
        
     function actualizarPassword($codigo_usu,$password){                        
            $this->db->where("codigo_usu",$codigo_usu);
            $data=array(
                "password_usu"=>$password
            );
            $this->db->update("usuario",$data);
    }
        
        
    function  obtenerDocentes(){ 
                $this->db->order_by("apellido_usu","asc");
                $query = $this->db->get_where('usuario',array("perfil_usu"=>"DOCENTE"));            
                if($query -> num_rows > 0){                
                    return $query;                
                }else{                
                    return false;
                }
     }
        
        
        function buscarPorCedula($cedula){
            $query=$this->db->get_where('usuario',array('cedula_usu'=>$cedula));
             if($query -> num_rows > 0){                
                return $query->row();                
            }else{                
                return false;
            }

        }
        
        
        function insertarRepresentante($data){
            $data['username_usu']=$data['cedula_usu'];
            $data['password_usu']=md5($data['cedula_usu']);
            $data['perfil_usu']="REPRESENTANTE";
            $data['estado_usu']=1;
            $this->db->insert('usuario',$data);            
            return $this->db->insert_id();
        }
        
        
        
         //nuevo usuario -> validacion username
    function existeUsernameNuevo($username_usu){

            $query=$this->db->get_where('usuario',array('username_usu'=>$username_usu));

            if($query -> num_rows > 0){
                return true;
            }else{
                return false;
            }        
    }
        
  
        
    function editar($id_usu,$data){    
        $this->db->where('codigo_usu', $id_usu);
        $this->db->update('usuario', $data); 
        return $this->db->affected_rows() > 0;        
    }
        
        
        
    //Editar  
    function existeUsername($codigo_usu,$username_usu){
                
        $query=$this->db->get_where('usuario',array('username_usu'=>$username_usu));
        
        if($query -> num_rows > 0){
            if($query->row()->codigo_usu==$codigo_usu){
                return false;
            }
            return true;
        }else{
            return false;
        }        
    }
        
        
          
    //Nuevo
    function existeEmailNuevo($email_usu){

            $query=$this->db->get_where('usuario',array('email_usu'=>$email_usu));

            if($query -> num_rows > 0){
                return true;
            }else{
                return false;
            }        
    }
        
         //Editar  
    function existeEmail($codigo_usu,$email_usu){
                
        $query=$this->db->get_where('usuario',array('email_usu'=>$email_usu));
        
        if($query -> num_rows > 0){
            if($query->row()->codigo_usu==$codigo_usu){
                return false;
            }
            return true;
        }else{
            return false;
        }        
    }
    
        
    function cambiarPassword($id_usu,$password){
        $data=array(
            "password_usu"=>md5($password)
        );
        $this->db->where('codigo_usu', $id_usu);
        $this->db->update('usuario', $data); 
        return $this->db->affected_rows() > 0;          
    }
        
        
        
        
        
        
        
        
         //Nuevo
    function existeCedulaNuevo($cedula_usu){

            $query=$this->db->get_where('usuario',array('cedula_usu'=>$cedula_usu));

            if($query -> num_rows > 0){
                return true;
            }else{
                return false;
            }        
    }
        
        
         //Editar  
    function existeCedula($codigo_usu,$cedula_usu){
                
        $query=$this->db->get_where('usuario',array('cedula_usu'=>$cedula_usu));
        
        if($query -> num_rows > 0){
            if($query->row()->codigo_usu==$codigo_usu){
                return false;
            }
            return true;
        }else{
            return false;
        }
        
    }
       
    
        
        
    }

   
    
?>