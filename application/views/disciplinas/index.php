 <script>    
    $("#menu_curso_<?php echo $curso->codigo_cur; ?>").addClass("active");    
</script>
  
<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header"><i class="fa fa-users"></i> Registro de Disciplina </h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?php echo site_url('/welcome/index'); ?>">Inicio</a></li>            
             <li><i class="fa fa-book"></i><a href="<?php echo site_url('/materias/materiasDocenteCurso').'/'.$curso->codigo_cur; ?>"> Materias | <?php echo $curso->nombre_cur.' "'.$curso->paralelo_cur.'" | '.$curso->seccion_cur; ?> </a></li>                              
            <li><i class="fa fa-book"></i><a href="<?php echo site_url('/estudiantes/listado').'/'.$curso->codigo_per.'/'.$curso->codigo_cur.'/'.$materia->codigo_mat; ?>"><?php echo $materia->nombre_mat; ?></a></li> 
            <li><i class="fa fa-users"></i>Disciplina</li> 

        </ol>
    </div>
</div>

<div class="panel miPanelCerrado">
    
    <header class="panel-heading">        
            <b>Nuevo Registro de Disciplina</b>        
    </header>
    
    <div class="panel panel-body">
        <form id="frm_disciplina" class="form-horizontal" action="<?php echo site_url('/disciplinas/guardarDisciplina'); ?>" method="post">
            <fieldset>
           
                <input type="hidden" name="codigo_cur" id="codigo_cur" value="<?php echo $curso->codigo_cur; ?>">
                <input type="hidden" name="codigo_mat" id="codigo_mat" value="<?php echo $materia->codigo_mat; ?>">
                <input type="hidden" name="codigo_per" id="codigo_per" value="<?php echo $periodo->codigo_per; ?>">
                
                <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="fecha_dis"><b>Fecha:</b></label>  
                  <div class="col-md-4">
                  <input id="fecha_dis" name="fecha_dis" type="text" placeholder="Seleccione la fecha" class="form-control input-md">
                  <span class="help-block">Ej. 2016-04-28</span>  
                  </div>
                </div>
                
               
 
                <!-- Textarea -->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="observacion_dis"><b>Observación:</b></label>
                  <div class="col-md-4">                     
                    <textarea class="form-control" id="observacion_dis" name="observacion_dis"></textarea>
                  </div>
                </div>

                <!-- Button (Double) -->
                <div class="form-group">
                  <label class="col-md-4 control-label" for=""></label>
                  <div class="col-md-8">
                    <button id="" name="" class="btn btn-success" type="submit"> <i class="fa fa-save"> </i> Guardar</button>
                    <button onclick="resetear();" type="reset" id="button2id" name="button2id" class="btn btn-default"> <i class="fa fa-times"> </i> Cancelar</button>
                  </div>
                </div>
                
                
                <!-- Button (Double) -->
                <div class="form-group">
                      <div class="col-md-4"></div>
                      <div class="col-md-4">
                          <div class="loader" id="cargarDisciplinas" style="display:none;"></div>
                      </div>
                </div>
                                                   

            </fieldset>
        </form>     
    </div>    
</div>


<div class="panel miPanel">    
    <header class="panel-heading">        
            <b>Listado de Registros de Disciplina</b>        
    </header>    
    <div class="panel panel-body">     
           
            <?php if($disciplinas){ ?>       
                    <table class="table table-striped table-hover tblBuscador">
                           <thead>
                                <tr>
                                    <th class="text-center">No.</th>
                                    <th class="text-center">FECHA</th>                                    
                                    <th class="text-center">OBSERVACIÓN</th>
                                    <th class="text-center">OPCIONES</th>
                                </tr>                
                           </thead>
                           <tbody>
                                    <?php $i=1; ?>
                                    <?php foreach($disciplinas->result() as $disciplina){ ?>                                  
                                       <tr>
                                           <td class="text-center"><?php echo $i++; ?></td>
                                           <td class="text-center"><?php echo $disciplina->fecha_dis; ?></td>                                           
                                           <td class="text-center"><?php echo $disciplina->observacion_dis; ?></td>
                                           <td class="text-center">                                               
                                               <a href="<?php echo site_url('disciplinas/detalleRegistroDisciplinas').'/'.$curso->codigo_cur.'/'.$periodo->codigo_per.'/'.$materia->codigo_mat.'/'.$disciplina->codigo_dis; ?>" class="btn btn-default"> <i class="fa fa-mail-forward"></i> </a>
                                               <button onclick="abrirEliminacion('<?php echo $disciplina->codigo_dis; ?>')"  class="btn btn-default"> <i class="fa fa-trash-o"></i> </button>
                                           </td>
                                       </tr>
                                    <?php } ?>                            
                           </tbody>
                           <tfoot>
                                <tr>
                                    <th class="text-center">No.</th>
                                    <th class="text-center">FECHA</th>                                    
                                    <th class="text-center">OBSERVACIÓN</th>
                                    <td></td>
                                </tr>                       
                           </tfoot>
                    </table>
            <?php }else{ ?>
                
                <div class="alert alert-danger">
                    
                    <i class="fa fa-exclamation-triangle"> </i> No se han encontrado registros de disciplina para la materia y curso seleccionados.
                    
                </div>
                
            <?php } ?>
    
    
    </div>
</div>

<br>
<br>
<br>

<!-- Modal -->
<form action="<?php echo site_url('disciplinas/eliminarDisciplina'); ?>" method="post">
    <div id="modalEliminacion" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title" style="color:#FF2D55;"><b> <i class="fa fa-info-circle"> </i> CONFIRMACIÓN</b></h4>
          </div>
          <div class="modal-body">
            <input type="hidden" name="codigo_cur" value="<?php echo $curso->codigo_cur; ?>">
            <input type="hidden" name="codigo_mat" value="<?php echo $materia->codigo_mat; ?>">
            <input type="hidden" name="codigo_per" value="<?php echo $periodo->codigo_per; ?>">
            <input type="hidden" name="codigo_dis" id="codigo_dis" >
            ¿Está seguro que desea eliminar el registro de disciplina indicado?
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
        $('#codigo_dis').val(id);        
    }
 
    
    $().ready(function(){
        $('#fecha_dis').datepicker({
            changeYear: true,
            changeMonth: true,
            yearRange: '2017:2020', 
            maxDate: new Date
        });
    });    
    
   
    
    
    var miValidador=$('#frm_disciplina').validate({
        
        rules:{
            fecha_dis:{
                required:true
            },
            observacion_dis:{
                required:true
            }
        },
        messages:{
            fecha_dis:{
                required:"Seleccione la fecha"
            },
            observacion_dis:{
                required:"Indique la razón de la calificación de disciplina",                
            }     
        },
        submitHandler: function(form) {
            $('#cargarDisciplinas').fadeIn();
            form.submit();
        }
        
    });
    
    function resetear(){
        miValidador.resetForm();   
        $('form')[0].reset();
    }

    
    

</script>