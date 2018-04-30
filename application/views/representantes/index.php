<script>    
    $("#menu_representantes").addClass("active");    
</script>

  <div class="row">
    <div class="col-lg-12">
        <h3 class="page-header"><i class="fa fa-th-list"></i> Representantes</h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?php echo site_url('/welcome/index'); ?>">Inicio</a></li>
            <li><i class="fa fa-th-list"></i>Representantes</li>            
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
      
      
        <section class="panel miPanelCerrado">
              <header class="panel-heading">
                   <b>Nuevo Representante</b>
          
              </header>
              <div class="panel-body collapse in" id="nuevoCurso">
               <form id="frm_representantes" class="form-horizontal" method="post" action="<?php echo site_url("/representantes/guardarRepresentante"); ?>">
                <fieldset>
                
                
                    <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="cedula_usu"><b> No. Cédula: </b> </label>  
                  <div class="col-md-5">
                  <input id="cedula_usu" name="cedula_usu" type="text" required placeholder="Ingrese el número de cédula del representante" class="form-control input-md">
                  <span class="help-block">Ej. 1887741521 </span>  
                  </div>
                </div>

                <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="nombre_usu"><b> Apellidos y Nombres: </b> </label>  
                  <div class="col-md-5">
                  <input id="nombre_usu" name="nombre_usu" type="text" required placeholder="Ingrese los nombres del representante" class="form-control input-md">
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
                     <input id="telefono_usu" name="telefono_usu" type="text" required placeholder="Ingrese el teléfono del representante" class="form-control input-md">
                       <span class="help-block">Ej. 0998445214 </span>  
                  </div>
                </div>
                
                 <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="email_usu"><b> Email: </b> </label>  
                  <div class="col-md-5">
                     <input id="email_usu" name="email_usu" type="text" required placeholder="Ingrese el email del representante" class="form-control input-md">       
                     <span class="help-block">Ej. carlosdiaz@correo.com </span>  
                  </div>
                </div>
                
                  <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="username_usu"><b> Nombre de Usuario: </b> </label>  
                  <div class="col-md-5">
                     <input id="username_usu" name="username_usu" type="text" required placeholder="Ingrese un nombre de usuario" class="form-control input-md">       
                  </div>
                </div>
                
                  <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="password_usu"><b> Contraseña: </b> </label>  
                  <div class="col-md-5">
                     <input id="password_usu" name="password_usu" type="password" required placeholder="Ingrese una contraseña" class="form-control input-md">       
                  </div>
                </div>
                
          

                <!-- Button (Double) -->
                <div class="form-group">
                  <label class="col-md-4 control-label" for=""></label>
                  <div class="col-md-8">
                    <button id="" name="" class="btn btn-success" type="submit"> <i class="fa fa-save"> </i> &nbsp; Guardar</button>
                    &nbsp;
                    <button id="" name="" class="btn btn-default" type="button" onclick="resetear();"> <i class="fa fa-times"> </i> &nbsp; Cancelar</button>
                  </div>
                </div>

                </fieldset>
                </form>
            </div>
        </section>
    </div>    
</div>
 

<div class="row">
    <div class="col-md-12">            
        <section class="panel miPanel">
              <header class="panel-heading">
                   <b>Listado de Representantes</b>
              </header>
              <div class="panel-body">
                  
                  <?php if($representantes) { ?>
                      
                      <table class="table table-striped tblBuscador">
                         <thead>
                              <tr>
                                  <th>No.</th>
                                  <th>CÉDULA</th>                                  
                                  <th>NOMBRES</th>
                                  <th>TELÉFONO</th>
                                  <th>EMAIL</th>
                                  <th>PARENTESCO</th>
                                  <th>USUARIO</th>                                                                
                                  <th>OPCIONES</th>
                              </tr>    
                         </thead>
                         <tfoot>
                              <tr>
                                  <th>No.</th>
                                  <th>CÉDULA</th>                                  
                                  <th>NOMBRE</th>
                                  <th>TELÉFONO</th>
                                  <th>EMAIL</th>
                                  <th>PARENTESCO</th>
                                  <th>USUARIO</th>                                                                
                                  <td></td>
                              </tr>    
                         </tfoot>
                          <tbody>
                           <?php $i=1; ?>
                           <?php foreach($representantes->result() as $representante) { ?>
                               
                               <tr>
                                   <td><?php echo $i; ?></td>
                                   <td><?php echo $representante->cedula_usu; ?></td>                                
                                   <td><?php echo $representante->nombre_usu; ?></td>
                                   <td><?php echo $representante->telefono_usu; ?></td>
                                   <td><?php echo $representante->email_usu; ?></td>
                                   <td><?php echo $representante->parentesco_usu; ?></td>
                                   <td><?php echo $representante->username_usu; ?></td>                              
                                   <td>
                                      <a href="<?php echo site_url('representantes/editar/').'/'.$representante->codigo_usu; ?>" class="btn btn-default"><i class="fa fa-pencil"></i></a>
                                      <button  onclick="abrirEliminacion(<?php echo $representante->codigo_usu; ?>);" class="btn btn-default"><i class="fa fa-trash-o"></i></button>                                   
                                   </td>
                                   
                               </tr>
                               <?php $i++; ?>
                           <?php } ?>
                          </tbody>
                      </table>
                  
                  <?php }else{ ?>
                      <div class="alert alert-danger">
                              <i class="fa fa-exclamation-triangle"> </i> No se encontraron cursos registrados en este periodo lectivo
                      </div>                  
                  <?php } ?>
              
            </div>
        </section>
    </div>
</div>



<br>
<br>
<br>


<!-- Modal -->
<form action="<?php echo site_url('representantes/eliminarRepresentante'); ?>" method="post">
    <div id="modalEliminacion" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title" style="color:#FF2D55;"><b> <i class="fa fa-info-circle"> </i> CONFIRMACIÓN</b></h4>
          </div>
          <div class="modal-body">
            <input type="hidden" name="codigo_usu" id="codigo_usu" >
            ¿Está seguro que desea eliminar el representante indicado?
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success" > <i class="fa fa-check"> </i> Si, Eliminar</button>
            <a href="#" class="btn btn-default" data-dismiss="modal"> <i class="fa fa-times"> </i> No, Cancelar</a>
          </div>
        </div>
      </div>
    </div>
</form>


<br>
<br>
<br>



<script>
    
    function abrirEliminacion(id){
        $('#modalEliminacion').modal('show');
        $('#codigo_usu').val(id);        
    }
 
    
    
   
    
   var miValidador=$('#frm_representantes').validate({
        rules:{
            
            cedula_usu:{
              digits: true,
              required:true,
              remote:{
                    url:"<?php echo site_url('/representantes/validarCedulaNuevo'); ?>",
                    data:{
                            email_usu:function(){      
                                //alert($('#username_usu').val());
                                return $('#email_usu').val();
                             }                        
                    },
                    type:'post'  
                }
            },
            nombre_usu:{
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
                        url:"<?php echo site_url('/representantes/validarUsernameNuevo'); ?>",
                        data:{
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
                        url:"<?php echo site_url('/representantes/validarEmailNuevo'); ?>",
                        data:{
                                email_usu:function(){                                          
                                    return $('#email_usu').val();
                                 }                        
                        },
                        type:'post'
                                          
                },
                email:true
            }
            
        },
        messages:{            
            cedula_usu:{
              digits: "Este campo solo acepta números",
              required:"Ingrese el número de cédula del usuario",
              remote:"Esta cédula ya está registrada"
            },
            nombre_usu:{                
                required:"Ingrese los nombres del representante"
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
    
    
    
    function resetear(){
        miValidador.resetForm();   
        $('form')[0].reset();
    }

</script>