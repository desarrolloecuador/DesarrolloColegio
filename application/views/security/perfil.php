 
  <div class="row">
    <div class="col-lg-12">
        <h3 class="page-header"><i class="fa fa-user"></i>  Perfil de Usuario</h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?php echo site_url('/welcome/index'); ?>">Inicio</a></li>          
            <li><i class="fa fa-user"></i>Mi Cuenta</li>
        </ol>
    </div>
</div>
			
<div class="row">
    <div class="col-md-12">
      
      
        <section class="panel miPanel">
              <header class="panel-heading">
                   <b>Datos Registrados</b>
              </header>
              <div class="panel-body">
              
              
              
               <ul class="nav nav-tabs">
                  <li class="active"><a data-toggle="tab" href="#home">Datos Generales</a></li>
                  <li><a data-toggle="tab" href="#menu1">Cambiar Contraseña</a></li>
                </ul>

                <div class="tab-content">
                  <div id="home" class="tab-pane fade in active">
                           
                           <br>
                        <form  class="form-horizontal">
                              
                               <!-- Text input
                                <div class="form-group">
                                  <label class="col-md-4 control-label" for="nombre_tip"><b> </b> </label>  
                                  <div class="col-md-5">
                                          <b>Estimado usuario/a para cambiar esta información contactese con el administrador del sistema.</b>                        
                                  </div>
                                </div>
                                -->
                               
                                <!-- Text input-->
                                <div class="form-group">
                                  <label class="col-md-4 control-label" for="nombre_tip"><b> Nombre: </b> </label>  
                                  <div class="col-md-5">
                                  <input id="nombre_usu" name="nombre_usu" type="text" required placeholder="Ingrese el nombre del tipo de aporte" class="form-control input-md" value="<?php echo $this->session->userdata('comil_nombre_usu'); ?>" disabled>                            
                                  </div>
                                </div>


                                 <!-- Text input-->
                                <div class="form-group">
                                  <label class="col-md-4 control-label" for="nombre_tip"><b> Teléfono: </b> </label>  
                                  <div class="col-md-5">
                                  <input id="nombre_usu" name="nombre_usu" type="text" required placeholder="Ingrese el nombre del tipo de aporte" class="form-control input-md" value="<?php echo $this->session->userdata('comil_telefono_usu'); ?>" disabled>                            
                                  </div>
                                </div>



                                 <!-- Text input-->
                                <div class="form-group">
                                  <label class="col-md-4 control-label" for="nombre_tip"><b> Email: </b> </label>  
                                  <div class="col-md-5">
                                  <input id="nombre_usu" name="nombre_usu" type="text" required placeholder="Ingrese el nombre del tipo de aporte" class="form-control input-md" value="<?php echo $this->session->userdata('comil_email_usu'); ?>" disabled>                            
                                  </div>
                                </div>
                        </form>

                  </div>
                  <div id="menu1" class="tab-pane fade">
                     
                     
                     <br>
                      
                       <form class="form-horizontal" id="frm_password" method="post" action="<?php echo site_url("/security/cambiarPassword"); ?>">
                

                        <!-- Text input-->
                        <div class="form-group">
                          <label class="col-md-4 control-label" for="nombre_tip"><b> Contraseña Actual: </b> </label>  
                          <div class="col-md-5">
                          <input id="password_actual" name="password_actual" type="password" required placeholder="Ingrese su contraseña actual" class="form-control input-md">                            
                          </div>
                        </div>
                        
                        
                         <!-- Text input-->
                        <div class="form-group">
                          <label class="col-md-4 control-label" for="nombre_tip"><b> Contraseña Nueva: </b> </label>  
                          <div class="col-md-5">
                          <input id="password_nueva" name="password_nueva" type="password" required placeholder="Ingrese su nueva contraseña" class="form-control input-md">                            
                          </div>
                        </div>
                        
                        
                          <!-- Text input-->
                        <div class="form-group">
                          <label class="col-md-4 control-label" for="nombre_tip"><b> Confirme la Contraseña: </b> </label>  
                          <div class="col-md-5">
                          <input id="password_confirmada" name="password_confirmada" type="password" required placeholder="Confirme su nueva contraseña" class="form-control input-md">                            
                          </div>
                        </div>
                        
                        
                        
                           <!-- Text input-->
                        <div class="form-group">
                          <label class="col-md-4 control-label" for="nombre_tip"> </label>  
                          <div class="col-md-5">
                         
                                    <button type="submit" class="btn btn-primary"> <i class="fa fa-refresh"> </i> Actualizar Contraseña  </button>
                                                                               
                          </div>
                        </div>
                        
                        
                  </form>
                  
                  
                  </div>
                </div>
              
              
              <script>
                
                  $("#frm_password").validate({
                      
                      rules:{
                          password_actual:{
                              required:true,
                              minlength:6
                          },
                          password_nueva:{
                              required:true,
                              minlength:6
                          },
                          password_confirmada:{
                              required:true,
                              equalTo:"#password_nueva"
                          }
                      },
                      messages:{
                            password_actual:{
                              required:"Ingrese su contraseña actual",
                              minlength:"La contraseña debe tener almenos 6 caracteres"
                           },
                           password_nueva:{
                             required:"Ingrese su nueva contraseña",
                              minlength:"La contraseña debe tener almenos 6 caracteres"
                           },
                           password_confirmada:{
                              required:"Confirme su nueva contraseña",
                              equalTo:"La nueva contraseña no coincide"
                           }
                      }
                      
                  });
                  
              </script>
              
               
                  
                  
                  
                  
               
               
               
               
               
               
               
            </div>
        </section>
    </div>    
</div>




<script>
 
        

    $('#frm_editar_tipo').validate({
        
        rules:{
            nombre_tip:{
                required:true,
                remote: {
                    url:"<?php echo site_url("/tipos/validarNombreTipo")?>",
                    type:"post",
                    data:{
                         codigo_tip:function(){
                            return $('#codigo_tip').val();
                        },
                        nombre_tip:function(){
                            return $('#nombre_tip').val()
                        }
                    }
                }
            },
            porcentaje_tip:{
                required:true
            }
        },
        messages:{
            nombre_tip:{
                required:"Por favor ingrese el nombre del tipo de aporte.",
                remote:"El nombre ingresado ya esta registrado en otro tipo de aporte."
            },
            porcentaje_per:{
                required:"Por favor indique el porcentaje.",
                 
            }
        }
        
        
    });
        
</script>

<br>
<br>
<br>