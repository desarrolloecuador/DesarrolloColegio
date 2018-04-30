<script>    
    $("#menu_docentes").addClass("active");    
</script>

  <div class="row">
    <div class="col-lg-12">
        <h3 class="page-header"><i class="fa fa-users"></i> Docentes</h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?php echo site_url('/welcome/index'); ?>">Inicio</a></li>
            <li><i class="fa fa-users"></i>Docentes</li>            
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
      
      
        <section class="panel miPanelCerrado">
              <header class="panel-heading">
                   <b>Nuevo Docente</b>
          
              </header>
              <div class="panel-body collapse in" id="nuevoCurso">
               <form id="frm_docentes" class="form-horizontal" method="post" action="<?php echo site_url("/docentes/guardarDocente"); ?>">
                <fieldset>

                <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="nombre_usu"><b> Nombres: </b> </label>  
                  <div class="col-md-5">
                  <input id="nombre_usu" name="nombre_usu" type="text" required placeholder="Ingrese los nombres del docente" class="form-control input-md">
                  <span class="help-block">Ej. Juan Carlos</span>  
                  </div>
                </div>
                
                 <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="apellido_usu"><b> Apellidos: </b> </label>  
                  <div class="col-md-5">
                       <input id="apellido_usu" name="apellido_usu" type="text" required placeholder="Ingrese los apellidos del docente" class="form-control input-md">
                       <span class="help-block">Ej. Diaz Villalva</span>  
                  </div>
                </div>
                
                 <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="telefono_usu"><b> Teléfono: </b> </label>  
                  <div class="col-md-5">
                     <input id="telefono_usu" name="telefono_usu" type="text" required placeholder="Ingrese el teléfono del docente" class="form-control input-md">
                       <span class="help-block">Ej. 0998445214 </span>  
                  </div>
                </div>
                
                 <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="email_usu"><b> Email: </b> </label>  
                  <div class="col-md-5">
                     <input id="email_usu" name="email_usu" type="text" required placeholder="Ingrese el email del docente" class="form-control input-md">       
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
                   <b>Listado de Docentes</b>
              </header>
              <div class="panel-body">
                  
                  <?php if($docentes) { ?>
                      
                      <table class="table table-striped tblBuscador">
                         <thead>
                              <tr>
                                  <th>No.</th>
                                  <th>APELLIDO</th>
                                  <th>NOMBRE</th>
                                  <th>TELÉFONO</th>
                                  <th>EMAIL</th>
                                  <th>USUARIO</th>                              
                                  <th>ESTADO</th>
                                  <th>OPCIONES</th>
                              </tr>    
                         </thead>
                         <tfoot>
                              <tr>
                                  <th>No.</th>
                                  <th>APELLIDO</th>
                                  <th>NOMBRE</th>
                                  <th>TELÉFONO</th>
                                  <th>EMAIL</th>
                                  <th>USUARIO</th>                              
                                  <th>ESTADO</th>
                                  <td></td>
                              </tr>    
                         </tfoot>
                          <tbody>
                           <?php $i=1; ?>
                           <?php foreach($docentes->result() as $docente) { ?>
                               
                               <tr>
                                   <td><?php echo $i; ?></td>
                                   <td><?php echo $docente->apellido_usu; ?></td>
                                   <td><?php echo $docente->nombre_usu; ?></td>
                                   <td><?php echo $docente->telefono_usu; ?></td>
                                   <td><?php echo $docente->email_usu; ?></td>
                                   <td><?php echo $docente->username_usu; ?></td>
                                   <td>
                                      
                                      <?php if($docente->estado_usu){ ?>                                          
                                          <label for="" class="label label-success">Activo</label>    
                                      <?php }else{ ?>
                                          <label for="" class="label label-danger">Inactivo</label>    
                                      <?php } ?>
                                       
                                   </td>
                                   <td>
                                      <a href="<?php echo site_url('docentes/editar/').'/'.$docente->codigo_usu; ?>" class="btn btn-default"><i class="fa fa-pencil"></i></a>
                                      <button  onclick="abrirEliminacion(<?php echo $docente->codigo_usu; ?>);" class="btn btn-default"><i class="fa fa-trash-o"></i></button>                                   
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
<form action="<?php echo site_url('docentes/eliminarDocente'); ?>" method="post">
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
            ¿Está seguro que desea eliminar el docente indicado?
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
 
    
    
   
    
   var miValidador=$('#frm_docentes').validate({
        rules:{
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
                        url:"<?php echo site_url('/docentes/validarUsernameNuevo'); ?>",
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
                        url:"<?php echo site_url('/docentes/validarEmailNuevo'); ?>",
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
            
            
            nombre_usu:{                
                required:"Ingrese los nombres del docente"
            },
            apellido_usu:{                
                required:"Ingrese los apellidos del docente"
            },
            telefono_usu:{
                required:"Ingrese el número de teléfono del docente",
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