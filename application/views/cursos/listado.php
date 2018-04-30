<script>    
    $("#menu_cursos").addClass("active");    
</script>

  <div class="row">
    <div class="col-lg-12">
        <h3 class="page-header"><i class="fa fa-building"></i> Cursos</h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?php echo site_url('/welcome/index'); ?>">Inicio</a></li>
            <li><i class="fa fa-building"></i><a href="<?php echo site_url('/cursos/index'); ?>">Cursos/Materias</a></li>
            <?php if($periodo){  ?>
                <li><i class="fa fa-list"></i>Listado de Cursos - Periodo <?php echo $periodo->nombre_per; ?></li>						  	
            <?php }else{  ?>
                <li><i class="fa fa-list"></i>No Existe un Periodo Activo</li>						  	
            <?php }  ?>
        </ol>
    </div>
</div>



<?php if($periodo){  ?>

<div class="row">
    <div class="col-md-12">
      
      
        <section class="panel miPanelCerrado">
              <header class="panel-heading">
                   <b>Nuevo Curso | Periodo

               
                    <?php echo $periodo->nombre_per; ?>  </b>
                
          
              </header>
              <div class="panel-body collapse in" id="nuevoCurso">
               <form class="form-horizontal" method="post" action="<?php echo site_url("/cursos/guardarCurso"); ?>" id="frm_curso">
                <fieldset>
                
                
                <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="seccion_cur"><b> Sección del curso: </b> </label>  
                  <div class="col-md-5">
                        <select name="seccion_cur" id="seccion_cur" class="form-control">
                            <option value="">--Seleccione una opción--</option>
                            <option value="Escuela">Escuela</option>
                            <option value="Colegio">Colegio</option>
                        </select>
                  </div>
                </div>
                

                <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="nombre_cur"><b> Nombre del curso: </b> </label>  
                  <div class="col-md-5">
                  <input id="nombre_cur" name="nombre_cur" type="text" required placeholder="Ingrese el nombre del curso" class="form-control input-md">
                  <span class="help-block">Ej. Primero</span>  
                  </div>
                </div>
                
                 <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="nombre_per"><b> Paralelo del curso: </b> </label>  
                  <div class="col-md-5">
                      <select name="paralelo_cur" id="paralelo_cur" class="form-control" required>
                          <option value="">--Seleccione una opción--</option>
                          <option value="A">A</option>
                          <option value="B">B</option>
                          <option value="C">C</option>
                          <option value="D">D</option>
                          <option value="E">E</option>
                          <option value="F">F</option>
                          <option value="UNICO">UNICO</option>
                        <!--<option value="G">G</option>
                          <option value="H">H</option>
                          <option value="I">I</option>
                          <option value="J">J</option>
                          <option value="K">K</option>
                          <option value="L">L</option>
                          <option value="M">M</option>
                          <option value="N">N</option>
                          <option value="O">O</option>
                          <option value="P">P</option>
                          <option value="Q">P</option>
                          <option value="R">R</option>
                          <option value="S">S</option>
                          <option value="T">T</option>
                          <option value="U">U</option>
                          <option value="V">V</option>
                          <option value="W">W</option>
                          <option value="X">X</option>
                          <option value="Y">Y</option>
                          <option value="Z">Z</option>-->
                      </select>
                  </div>
                </div>
                
                 <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="codigo_usu"><b> Tutor del curso: </b> </label>  
                  <div class="col-md-5" style=" z-index: 1000;">
                      <select  name="codigo_usu" id="codigo_usu" class="form-control selectpicker" data-live-search="true"  >   
                        
                         <option data-hidden="true" value="">--Seleccione un docente--</option>   
                   
                      </select>
                      <br><br>
                      <a href="#" style="text-decoration:underline;" data-toggle="modal" data-target="#modalNuevoDocente"> <i class="fa fa-plus-circle"> </i> &nbsp; Agregar Docente</a>
                  </div>
                </div>
                
                <input type="hidden" name="codigo_per" value="<?php echo $periodo->codigo_per; ?>">

                <!-- Button (Double) -->
                <div class="form-group">
                  <label class="col-md-4 control-label" for=""></label>
                  <div class="col-md-8">
                    <button id="" name="" class="btn btn-success" type="submit"> <i class="fa fa-save"> </i> &nbsp; Guardar</button>
                    &nbsp;
                    <button id="" name="" class="btn btn-default" type="button" onclick="resetear();"> <i class="fa fa-times"> </i> &nbsp; Cancelar</button>
                  </div>
                </div>
                
                <br><br>

                </fieldset>
                </form>
            </div>
        </section>
    </div>    
</div>
 

<div class="row">
    <div class="col-md-12">            
        <section class="panel miPanel" >
              <header class="panel-heading">
                   <b>Listado de Cursos | Periodo <?php echo $periodo->nombre_per; ?> </b>
              </header>
              <div class="panel-body" >
                  
                  <?php if($cursos) { ?>
                      
                      <table class="table table-striped tblBuscador">
                         <thead>
                              <tr>
                                  <th>No.</th>
                                  <th>SECCIÓN</th>
                                  <th>CURSO</th>
                                  <th>PARALELO</th>
                                  <th>TUTOR</th>
                                  <th>OPCIONES</th>                              
                              </tr> 
                         </thead>   
                        <tfoot>
                              <tr>
                                  <th>No.</th>
                                  <th>SECCIÓN</th>
                                  <th>CURSO</th>
                                  <th>PARALELO</th>
                                  <th>TUTOR</th>
                                  <td></td>   
                              </tr> 
                         </tfoot>   
                          <tbody>
                           <?php $i=1; ?>
                           <?php foreach($cursos->result() as $curso) { ?>
                               
                               <tr>
                                   <td><?php echo $i; ?></td>
                                   <td><?php echo $curso->seccion_cur; ?></td>
                                   <td><?php echo $curso->nombre_cur; ?></td>
                                   <td><?php echo $curso->paralelo_cur; ?></td>
                                   <td><?php echo $curso->apellido_usu.' '.$curso->nombre_usu; ?></td>
                                   <td>
                                      <a href="<?php echo site_url('/cursos/editar').'/'.$periodo->codigo_per.'/'.$curso->codigo_cur;  ?>" class="btn btn-default"><i class="fa fa-pencil"></i></a>
                                      <button onclick="abrirEliminacion(<?php echo $curso->codigo_cur; ?>);" class="btn btn-default"><i class="fa fa-trash-o"></i></button>
                                       <a href="<?php echo site_url('/cursos/materias').'/'.$periodo->codigo_per.'/'.$curso->codigo_cur; ?>" class="btn btn-default"> <i class="fa fa-edit"> </i> Gestionar Materias </a>  
                                         
                                       <a href="<?php echo site_url('/cursos/estudiantes').'/'.$periodo->codigo_per.'/'.$curso->codigo_cur; ?>" class="btn btn-default"> <i class="fa fa-users"> </i> Gestionar Estudiantes </a>   
                                   
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
<form action="<?php echo site_url('cursos/eliminarCurso'); ?>" method="post">
    <div id="modalEliminacion" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title" style="color:#FF2D55;"><b> <i class="fa fa-info-circle"> </i> CONFIRMACIÓN</b></h4>
          </div>
          <div class="modal-body">
            <input type="hidden" name="codigo_cur" id="codigo_cur1" >
            <input type="hidden" name="codigo_per" id="codigo_per1" value="<?php echo $periodo->codigo_per; ?>">
            ¿Está seguro que desea eliminar el curso indicado?
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success" > <i class="fa fa-check"> </i> Si, Eliminar</button>
            <a href="#" class="btn btn-default" data-dismiss="modal"> <i class="fa fa-times"> </i> No, Cancelar</a>
          </div>
        </div>
      </div>
    </div>
</form>
 

<form id="frm_docentes" class="form-horizontal" method="post" >
<!-- Modal -->
<div id="modalNuevoDocente" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"> <i class="fa fa-plus-circle"> </i> Nuevo Docente </h4>
      </div>
      <div class="modal-body">
       
                               
                    <fieldset>

                    <!-- Text input-->
                    <div class="form-group">
                      <label class="col-md-3 control-label" for="nombre_usu"><b> Nombres: </b> </label>  
                      <div class="col-md-8">
                      <input id="nombre_usu" name="nombre_usu" type="text" required placeholder="Ingrese los nombres del docente" class="form-control input-md">
                      <span class="help-block">Ej. Juan Carlos</span>  
                      </div>
                    </div>

                     <!-- Text input-->
                    <div class="form-group">
                      <label class="col-md-3 control-label" for="apellido_usu"><b> Apellidos: </b> </label>  
                      <div class="col-md-8">
                           <input id="apellido_usu" name="apellido_usu" type="text" required placeholder="Ingrese los apellidos del docente" class="form-control input-md">
                           <span class="help-block">Ej. Diaz Villalva</span>  
                      </div>
                    </div>

                     <!-- Text input-->
                    <div class="form-group">
                      <label class="col-md-3 control-label" for="telefono_usu"><b> Teléfono: </b> </label>  
                      <div class="col-md-8">
                         <input id="telefono_usu" name="telefono_usu" type="text" required placeholder="Ingrese el teléfono del docente" class="form-control input-md">
                           <span class="help-block">Ej. 0998445214 </span>  
                      </div>
                    </div>

                     <!-- Text input-->
                    <div class="form-group">
                      <label class="col-md-3 control-label" for="email_usu"><b> Email: </b> </label>  
                      <div class="col-md-8">
                         <input id="email_usu" name="email_usu" type="text" required placeholder="Ingrese el email del docente" class="form-control input-md">       
                         <span class="help-block">Ej. carlosdiaz@correo.com </span>  
                      </div>
                    </div>

                      <!-- Text input-->
                    <div class="form-group">
                      <label class="col-md-3 control-label" for="username_usu"><b> Nombre de Usuario: </b> </label>  
                      <div class="col-md-8">
                         <input id="username_usu" name="username_usu" type="text" required placeholder="Ingrese un nombre de usuario" class="form-control input-md">       
                      </div>
                    </div>

                      <!-- Text input-->
                    <div class="form-group">
                      <label class="col-md-3 control-label" for="password_usu"><b> Contraseña: </b> </label>  
                      <div class="col-md-8">
                         <input id="password_usu" name="password_usu" type="password" required placeholder="Ingrese una contraseña" class="form-control input-md">       
                      </div>
                    </div>



 
                
       
       
      </div>
      <div class="modal-footer">
        <button id="" name="" class="btn btn-success" type="submit"> <i class="fa fa-save"> </i> &nbsp; Guardar</button>
        
        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="fa fa-times"> </i> Cancelar</button>
      </div>
    </div>

  </div>
</div>
</form>
       



<script>
    
    
    
    function cargarDocentes(){
        

        $.ajax({
            type:"post",
            url:"<?php echo site_url('cursos/consultarDocentes'); ?>",
            success:function(data){
              
                
                
                 if(data=="false"){
                      $.notify("No se encontraron docentes registrados","error");
                }else{
                  var resultado = jQuery.parseJSON(data);
                  
                 for(i=0;i<resultado.length;i++){
                     opcion="<option value='"+resultado[i].codigo_usu+"' data-subtext=' - "+resultado[i].telefono_usu+"' >"+resultado[i].apellido_usu+" "+resultado[i].nombre_usu+" </option>";                    
                     $('#codigo_usu').append(opcion);
                     $('#codigo_usu').selectpicker('refresh');
                 }
                                     
                    
                }
                
                
                
                
            },
            error:function(data){
                alert("error");
            },
            complete:function(data){
                //alert("completo...");
            }
        });
       
    }
    
    cargarDocentes();
    
    
     var miValidadorDocentes=$('#frm_docentes').validate({
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
                    
        },
        
        submitHandler:function(form){
            $.ajax({
                url:"<?php echo site_url("/docentes/guardarDocente"); ?>",
                type:"post",
                data:$(form).serialize(),
                success:function(){
                    cargarDocentes();
                }
            });
            $("#modalNuevoDocente").modal('hide');
            resetearDocentes(form);
            $.notify("Docente agregado exitosamente. Ya puede seleccionarlo como tutor","success");
        }
        
        
    });
    
    
    function resetearDocentes(form){
        
        miValidadorDocentes.resetForm();   
        $(form)[0].reset();
        
    }
    
 
    $('#modalNuevoDocente').on('hidden.bs.modal', function () {
       form=$('#frm_docentes');
       resetearDocentes(form);
    });
  
    
    
       
    function abrirEliminacion(id){
        $('#modalEliminacion').modal('show');
        $('#codigo_cur1').val(id);        
    }
 
    
    
    $(document).ready(function(){        
        $('.selectpicker').selectpicker({
              style: 'btn-default',
              size: 2
        });
    });  
    
    var validadorCurso=$('#frm_curso').validate({
        
        rules:{
            seccion_cur:{
                required:true
            },
            nombre_cur:{
                required:true
            },
            paralelo_cur:{
                required:true
            },
            codigo_usu:{
                required:true
            }
        },
        messages:{
            seccion_cur:{
                required:"Seleccione la sección del curso"
            },
            nombre_cur:{
                required:"Ingrese el nombre del curso"
            },
            paralelo_cur:{
                required:"Seleccione el paralelo del curso"
            },
            codigo_usu:{
                required:"Seleccione el tutor del curso"
            }
            
        }
        
    });
    
    function resetear(){
        
        validadorCurso.resetForm();   
        $('form')[0].reset();
        
    }

</script>


 <?php }else{  ?>
                  
                   
                    
    <div class="row">
        <div class="col-md-12">            
            <section class="panel miPanel" >
                  <header class="panel-heading">
                       <b>Listado de Cursos </b>
                  </header>
                  <div class="panel-body" >
                  
                  
                   
                   <div class="alert alert-danger">
                       
                       <i class="fa fa-exclamation-triangle"> </i> No se encontró ningun curso, debido a que al momento no existe un Periodo Activo
                       
                   </div>
                   
                   
                   <br>
                   <br>
                   <br>
                   <br>
                   <br>
                   <br>
                   <br>
                   <br>
                   <br>
                   <br>
                   <br>
                   <br>
                    
                </div>
                    
            </section>
        </div>
    </div>

    
<?php }  ?> 
                