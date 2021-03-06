<script>    
    $("#menu_representantes").addClass("active");    
</script>

  <div class="row">
    <div class="col-lg-12">
        <h3 class="page-header"><i class="fa fa-users"></i> Representantes</h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?php echo site_url('/welcome/index'); ?>">Inicio</a></li>
            <li><i class="fa fa-th-list"></i><a href="<?php echo site_url('/representantes/index'); ?>">Representantes</a></li> 
            <li><i class="fa fa-pencil"></i>Editar Representante</li>            
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
      
      
        <section class="panel miPanel">
              <header class="panel-heading">
                   <b>Datos del Representante</b> &nbsp; &nbsp; <button class="btn btn-xs btn-default" onclick="abrirPassword('<?php echo $representante->codigo_usu; ?>');"><span class="fa fa-refresh"> </span>&nbsp; Reestablecer Contraseña</button>
          
              </header>
              <div class="panel-body collapse in" >
               <form id="frm_representantes" class="form-horizontal" method="post" action="<?php echo site_url("/representantes/editarRepresentante"); ?>">
                <fieldset>
                
                <input type="hidden" name="codigo_usu" id="codigo_usu" value="<?php echo $representante->codigo_usu; ?>">
                
                
                 <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="cedula_usu"><b> No. Cédula: </b> </label>  
                  <div class="col-md-5">
                  <input value="<?php echo $representante->cedula_usu; ?>" id="cedula_usu" name="cedula_usu" type="text" required placeholder="Ingrese la cédula del representante" class="form-control input-md">
                  <span class="help-block">Ej. 0558874125</span>  
                  </div>
                </div>
     
                

                <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="nombre_usu"><b>Apellidos y Nombres: </b> </label>  
                  <div class="col-md-5">
                  <input value="<?php echo $representante->nombre_usu; ?>" id="nombre_usu" name="nombre_usu" type="text" required placeholder="Ingrese los apellidos y nombres del representante" class="form-control input-md">
                  <span class="help-block">Ej. Diaz Villalva Juan Carlos</span>  
                  </div>
                </div>
     
               
                      <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="parentesco_usu"><b> Parentesco: </b> </label>  
                  <div class="col-md-5">
                      <select name="parentesco_usu" id="parentesco_usu" class="form-control">
                          <option value="">--Seleccione una opción--</option>
                          <option value="Abuelo">Abuelo</option>
                          <option value="Padre">Padre</option>
                          <option value="Madre">Madre</option>
                          <option value="Hermano">Hermano</option>
                          <option value="Tio">Tio</option>
                          <option value="Otro">Otro</option>                          
                      </select>  
                  </div>
                </div>
                
                
                 <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="telefono_usu"><b> Teléfono: </b> </label>  
                  <div class="col-md-5">
                     <input value="<?php echo $representante->telefono_usu; ?>"  id="telefono_usu" name="telefono_usu" type="text" required placeholder="Ingrese el teléfono del representante" class="form-control input-md">
                       <span class="help-block">Ej. 0998445214 </span>  
                  </div>
                </div>
                
                 <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="email_usu"><b> Email: </b> </label>  
                  <div class="col-md-5">
                     <input value="<?php echo $representante->email_usu; ?>" id="email_usu" name="email_usu" type="text" required placeholder="Ingrese el email del representante" class="form-control input-md">       
                  </div>
                </div>
                
                  <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="username_usu"><b> Nombre de Usuario: </b> </label>  
                  <div class="col-md-5">
                     <input value="<?php echo $representante->username_usu; ?>" id="username_usu" name="username_usu" type="text" required placeholder="Ingrese un nombre de usuario" class="form-control input-md">       
                  </div>
                </div>
                
    
                <!-- Button (Double) -->
                <div class="form-group">
                  <label class="col-md-4 control-label" for=""></label>
                  <div class="col-md-8">
                    <button id="" name="" class="btn btn-success" type="submit"> <i class="fa fa-save"> </i> &nbsp; Guardar</button>
                    &nbsp;
                    <A id="" name="" class="btn btn-default" href="<?php echo site_url('representantes/index'); ?>"> <i class="fa fa-times"> </i> &nbsp; Cancelar</A>
                  </div>
                </div>

                </fieldset>
                </form>
            </div>
        </section>
    </div>    
</div>
 


<br>
<br>
<br>


<!-- Modal -->
<form action="<?php echo site_url('representantes/cambiarPassword'); ?>" method="post" >
    <div id="modalPassword" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title" ><b> <i class="fa fa-refresh"> </i> Reestablecer Contraseña</b></h4>
          </div>
          <div class="modal-body">
                <input type="hidden" name="codigo_usu" id="codigo_usu1" >
                <div class="row">
                    <div class="col-md-5">
                       <span class="pull-right">
                           <b>Ingrese la nueva contraseña:</b>                           
                       </span>                        
                    </div>
                    <div class="col-md-7">                
                        <input type="password" class="form-control  pull-left" id="password_usu1" name="password_usu" required placeholder="Ingrese la nueva contraseña" minlength="6">
                    </div>     
                </div>       
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success" > <i class="fa fa-check"> </i> Si, Actualizar</button>
            <a href="#" class="btn btn-default" data-dismiss="modal"> <i class="fa fa-times"> </i> No, Cancelar</a>
          </div>
        </div>
      </div>
    </div>
</form>



 


<script>
    
    
    $("#estado_usu").val('<?php echo $representante->estado_usu; ?>');
    $("#parentesco_usu").val('<?php echo $representante->parentesco_usu; ?>');
    
    function abrirPassword(id){        
        $('#modalPassword').modal('show');
        $('#codigo_usu1').val(id);             
    }
 
    
    
   
    
    $('#frm_representantes').validate({
        rules:{
            cedula_usu:{
                digits:true,
                required:true,
                remote:{
                        url:"<?php echo site_url('/representantes/validarCedula'); ?>",
                        data:{
                                codigo_usu:function(){      
                                    //alert($('#username_usu').val());
                                    return $('#codigo_usu').val();
                                 } , 
                                cedula_usu:function(){      
                                    //alert($('#username_usu').val());
                                    return $('#cedula_usu').val();
                                 }                        
                        },
                        type:'post',
                       /* complete:function(data){
                                alert(data.responseText);
                        }   */                
                }                
            },
            nombre_usu:{
                letras:true,
                required:true
            },
            apellido_usu:{
                letras:true,
                required:true
            },
            telefono_usu:{
                required:true,
                digits:true,
                minlength: 9
            },
            username_usu:{
                required:true,
                minlength:6,
                remote:{
                        url:"<?php echo site_url('/representantes/validarUsername'); ?>",
                        data:{
                                codigo_usu:function(){      
                                    //alert($('#username_usu').val());
                                    return $('#codigo_usu').val();
                                 } , 
                                username_usu:function(){      
                                    //alert($('#username_usu').val());
                                    return $('#username_usu').val();
                                 }                        
                        },
                        type:'post',
                        /*complete:function(data){
                                alert(data.responseText);
                        }*/                    
                }
            },
            password_usu:{
                required:true,
                minlength:6
            },
            email_usu:{
                required:true,                
                remote:{
                        url:"<?php echo site_url('/representantes/validarEmail'); ?>",
                        data:{
                                codigo_usu:function(){      
                                    //alert($('#username_usu').val());
                                    return $('#codigo_usu').val();
                                 } , 
                                email_usu:function(){                                          
                                    return $('#email_usu').val();
                                 }
                            

                        },
                        type:'post',
                        
                                          
                },
                email:true
            }
            
        },
        messages:{
            
            cedula_usu:{
                digits:"Este campo solo acepta números",
                required:"Ingrese la cédula del representante",
                remote:"Esta cédula ya está en uso"
            },            
            nombre_usu:{                
                required:"Ingrese los nombres del representante"
            },
            apellido_usu:{                
                required:"Ingrese los apellidos del representante"
            },
            telefono_usu:{
                required:"Ingrese el número de teléfono del representante",
                digits:"Este campo solo acepta números",
                minlength: "Número de teléfono incorrecto"
            },
            username_usu:{
                required:"Ingrese un nombre de usuario",
                minlength:"El nombre de usuario debe tener al menos 6 caracteres",
                remote:"Este nombre de usuario ya está siendo usado"
                       
            },
            password_usu:{
                required:"Ingrese una contraseña",
                minlength:"La contraseña debe tener al menos 6 caracteres"
            },
             
            email_usu:{
                required:"Ingrese un email",                
                remote:"Este email ya está en uso",
                email:"Dirección de email incorrecta"
            }
                    
        }
        
        
    });

</script>