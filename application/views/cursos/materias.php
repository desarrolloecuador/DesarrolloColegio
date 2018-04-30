<script>    
    $("#menu_cursos").addClass("active");    
</script>

  <div class="row">
    <div class="col-lg-12">
        <h3 class="page-header"><i class="fa fa-file"></i> Materias </h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?php echo site_url('/welcome/index'); ?>">Inicio</a></li>
            <li><i class="fa fa-building"></i><a href="<?php echo site_url('/cursos/index'); ?>">Cursos/Materias</a></li>            
            <li><i class="fa fa-list"></i><a href="<?php echo site_url('/cursos/listado').'/'.$periodo->codigo_per; ?>">Listado de Cursos - Periodo <?php echo $periodo->nombre_per; ?></a></li>						  	
            <li><i class="fa fa-file"></i>Materias | <?php echo $curso->nombre_cur; ?> "<?php echo $curso->paralelo_cur; ?>" | Periodo <?php echo $periodo->nombre_per; ?></li>						  	
        </ol>
    </div>
</div>
 
<div class="row">
    <div class="col-md-12">

        <section class="panel miPanelCerrado">
              <header class="panel-heading">
                   <b>Nuevo Materia | <?php echo $curso->nombre_cur; ?> "<?php echo $curso->paralelo_cur; ?>" | Periodo <?php echo $periodo->nombre_per; ?> </b>
          
                    
              </header>
              <div class="panel-body collapse in" id="nuevaMateria" >
               <form class="form-horizontal" method="post" action="<?php echo site_url("/cursos/guardarMateria"); ?>" id="frm_materias">
                <fieldset>

                <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="nombre_mat"><b> Nombre de la Materia: </b> </label>  
                  <div class="col-md-5">
                  <input id="nombre_mat" name="nombre_mat" type="text" required placeholder="Ingrese el nombre de la materia" class="form-control input-md">
                  <span class="help-block">Ej. Matemáticas</span>  
                  </div>
                </div>
                
                 <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="codigo_usu"><b> Docente de la Materia: </b> </label>  
                  <div class="col-md-5">
                      <select name="codigo_usu" id="codigo_usu" class="form-control selectpicker" required data-live-search="true">
                          <option value="">--Seleccione una opción--</option>
                          <?php foreach($docentes->result() as $docente){ ?>
                              <option value="<?php echo $docente->codigo_usu; ?>"><?php echo $docente->apellido_usu.' '.$docente->nombre_usu; ?></option>
                          <?php } ?>
                      </select>
                  </div>
                </div>
                
                <input type="hidden" name="codigo_cur" value="<?php echo $curso->codigo_cur; ?>"  id="codigo_cur">
                 <input type="hidden" name="codigo_per" value="<?php echo $periodo->codigo_per; ?>">

               <br>
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
        <section class="panel miPanel">
              <header class="panel-heading">
                   <b>Listado de Materias | Periodo <?php echo $periodo->nombre_per; ?> </b>
              </header>
              <div class="panel-body">
                  
                  <?php if($materias) { ?>
                      
                      <table class="table table-striped tblBuscador">
                         <thead>
                              <tr>
                                  <th>No.</th>
                                  <th>MATERIA</th>
                                  <th>DOCENTE</th>
                                  <th>OPCIONES</th>                              
                              </tr>    
                        </thead>
                        
                        <tfoot>
                              <tr>
                                  <th>No.</th>
                                  <th>MATERIA</th>
                                  <th>DOCENTE</th>
                                  <td></td>                              
                              </tr>    
                        </tfoot>
                        
                        <tbody>                        
                           <?php $i=1; ?>
                           <?php foreach($materias->result() as $materia) { ?>
                               
                               <tr>
                                   <td><?php echo $i; ?></td>
                                   <td><?php echo $materia->nombre_mat; ?></td>
                                   <td><?php echo $materia->apellido_usu.' '.$materia->nombre_usu; ?></td>
                                   <td>
                                       <a href="<?php echo site_url('cursos/editarMateria').'/'.$periodo->codigo_per.'/'.$curso->codigo_cur.'/'.$materia->codigo_mat; ?>" class="btn btn-default"><i class="fa fa-pencil"></i></a>
                                       <button onclick="abrirEliminacion('<?php echo $materia->codigo_mat; ?>');" class="btn btn-default"><i class="fa fa-trash-o"></i></button>
                                   
                                   </td>
                                   
                               </tr>
                               <?php $i++; ?>
                           <?php } ?>
                        </tbody>
                        
                      </table>
                  
                  <?php }else{ ?>
                      <div class="alert alert-danger">
                              <i class="fa fa-exclamation-triangle"> </i> No se encontraron materias registradas para este curso.
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
<form action="<?php echo site_url('cursos/eliminarMateria'); ?>" method="post">
    <div id="modalEliminacion" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title" style="color:#FF2D55;"><b> <i class="fa fa-info-circle"> </i> CONFIRMACIÓN</b></h4>
          </div>
          <div class="modal-body">
            <input type="hidden" name="codigo_cur" id="codigo_cur1" value="<?php echo $curso->codigo_cur; ?>">
            <input type="hidden" name="codigo_per" id="codigo_per1" value="<?php echo $periodo->codigo_per; ?>">
            <input type="hidden" name="codigo_mat" id="codigo_mat1">
            ¿Está seguro que desea eliminar la materia indicada?
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success" > <i class="fa fa-check"> </i> Si, Eliminar</button>
            <a href="#" class="btn btn-default" data-dismiss="modal"> <i class="fa fa-times"> </i> No, Cancelar</a>
          </div>
        </div>
      </div>
    </div>
</form>





<script>
    
    
    function abrirEliminacion(id){
        $('#modalEliminacion').modal('show');
        $('#codigo_mat1').val(id);        
    }
 

    var miValidador=$('#frm_materias').validate({
        rules:{
            nombre_mat:{
                required:true,
                remote:{
                    url:"<?php echo site_url('cursos/validarNombreMateriaNuevo'); ?>",
                    type:'post',
                    data:{
                        nombre_mat:function(){                            
                            return $('#nombre_mat').val();
                        },
                        codigo_cur:function(){
                            return $('#codigo_cur').val();
                        }
                    }                    
                }
            },
            codigo_usu:{
                required:true
            }            
        },
        messages:{
            nombre_mat:{
                required:"Ingrese el nombre de la materia",
                remote:"Este nombre ya está registrado"
                
            },
            codigo_usu:{
                required:"Seleccione el docente de la materia"
            }
            
        }         
    });
    
    
    function resetear(){
        miValidador.resetForm();   
        $('form')[0].reset();
    }
        


</script>