 <script>    
    $("#menu_curso_<?php echo $curso->codigo_cur; ?>").addClass("active");    
</script>
  
<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header"><i class="fa fa-calendar"></i> Asistencias </h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?php echo site_url('/welcome/index'); ?>">Inicio</a></li>            
             <li><i class="fa fa-book"></i><a href="<?php echo site_url('/materias/materiasDocenteCurso').'/'.$curso->codigo_cur; ?>"> Materias | <?php echo $curso->nombre_cur.' "'.$curso->paralelo_cur.'" | '.$curso->seccion_cur; ?> </a></li>                              
            <li><i class="fa fa-book"></i><a href="<?php echo site_url('/estudiantes/listado').'/'.$curso->codigo_per.'/'.$curso->codigo_cur.'/'.$materia->codigo_mat; ?>"><?php echo $materia->nombre_mat; ?></a></li> 
            <li><i class="fa fa-calendar"></i>Asistencias</li> 

        </ol>
    </div>
</div>

<div class="panel miPanelCerrado">
    
    <header class="panel-heading">        
            <b>Nueva Asistencia</b>        
    </header>
    
    <div class="panel panel-body">
        <form id="frm_asistencias" class="form-horizontal" action="<?php echo site_url('/asistencias/guardarAsistencia'); ?>" method="post">
            <fieldset>
           
                <input type="hidden" name="codigo_cur" id="codigo_cur" value="<?php echo $curso->codigo_cur; ?>">
                <input type="hidden" name="codigo_mat" id="codigo_mat" value="<?php echo $materia->codigo_mat; ?>">
                <input type="hidden" name="codigo_per" id="codigo_per" value="<?php echo $periodo->codigo_per; ?>">
                
                <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="fecha_asi"><b>Fecha:</b></label>  
                  <div class="col-md-4">
                  <input id="fecha_asi" name="fecha_asi" type="text" placeholder="Seleccione la fecha" class="form-control input-md">
                  <span class="help-block">Ej. 2016-04-28</span>  
                  </div>
                </div>
                
                

                <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="hora_asi"><b>Hora:</b></label>  
                  <div class="col-md-2">
                      <input id="hora_asi" name="hora_asi" type="text" placeholder="Seleccione la hora" class="form-control input-md">
                      <span class="help-block">Ej. 08:00:00</span>  
                  </div>
                  <div class="col-md-2">
                          <button type="button" class="btn btn-default" id="ponerHoraActual"> <i class="fa fa-time"> </i> Hora Actual</button>
                  </div>
                </div>

                <!-- Textarea -->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="observacion_asi"><b>Observación:</b></label>
                  <div class="col-md-4">                     
                    <textarea class="form-control" id="observacion_asi" name="observacion_asi"></textarea>
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
                          <div class="loader" id="cargaAsistencias" style="display:none;"></div>
                      </div>
                </div>
                                                   

            </fieldset>
        </form>     
    </div>    
</div>


<div class="panel miPanel">    
    <header class="panel-heading">        
            <b>Listado de Asistencia</b>        
    </header>    
    <div class="panel panel-body">     
           
            <?php if($asistencias){ ?>       
                    <table class="table table-striped table-hover tblBuscador">
                           <thead>
                                <tr>
                                    <th class="text-center">No.</th>
                                    <th class="text-center">FECHA</th>
                                    <th class="text-center">HORA</th>
                                    <th class="text-center">OBSERVACIÓN</th>
                                    <th class="text-center">OPCIONES</th>
                                </tr>                
                           </thead>
                           <tbody>
                                    <?php $i=1; ?>
                                    <?php foreach($asistencias->result() as $asistencia){ ?>                                  
                                       <tr>
                                           <td class="text-center"><?php echo $i++; ?></td>
                                           <td class="text-center"><?php echo $asistencia->fecha_asi; ?></td>
                                           <td class="text-center"><?php echo $asistencia->hora_asi; ?></td>
                                           <td class="text-center"><?php echo $asistencia->observacion_asi; ?></td>
                                           <td class="text-center">                                               
                                               <a href="<?php echo site_url('asistencias/detalleRegistroAsistencia').'/'.$curso->codigo_cur.'/'.$periodo->codigo_per.'/'.$materia->codigo_mat.'/'.$asistencia->codigo_asi; ?>" class="btn btn-default"> <i class="fa fa-mail-forward"></i> </a>
                                               <button onclick="abrirEliminacion('<?php echo $asistencia->codigo_asi; ?>')"  class="btn btn-default"> <i class="fa fa-trash-o"></i> </button>
                                           </td>
                                       </tr>
                                    <?php } ?>                            
                           </tbody>
                           <tfoot>
                                <tr>
                                    <th class="text-center">No.</th>
                                    <th class="text-center">FECHA</th>
                                    <th class="text-center">HORA</th>
                                    <th class="text-center">OBSERVACIÓN</th>
                                    <td></td>
                                </tr>                       
                           </tfoot>
                    </table>
            <?php }else{ ?>
                
                <div class="alert alert-danger">
                    
                    <i class="fa fa-exclamation-triangle"> </i> No se han encontrado registro de asistencias para la materia y curso seleccionados.
                    
                </div>
                
            <?php } ?>
    
    
    </div>
</div>

<br>
<br>
<br>

<!-- Modal -->
<form action="<?php echo site_url('asistencias/eliminarAsistencia'); ?>" method="post">
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
            <input type="hidden" name="codigo_asi" id="codigo_asi" >
            ¿Está seguro que desea eliminar la asistencia indicada?
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
        $('#codigo_asi').val(id);        
    }
 
    
    $().ready(function(){
        $('#fecha_asi').datepicker({
            changeYear: true,
            changeMonth: true,
            yearRange: '2017:2020', 
            maxDate: new Date
        });
    });    
    
    $('#hora_asi').timepicker({ 'timeFormat': 'H:i:s' });
    
    $('#ponerHoraActual').on('click', function (){
        $('#hora_asi').timepicker('setTime', new Date());
    });
    
    
    var miValidador=$('#frm_asistencias').validate({
        
        rules:{
            fecha_asi:{
                required:true
            },
            hora_asi:{
                required:true
            }
        },
        messages:{
            fecha_asi:{
                required:"Seleccione la fecha"
            },
            hora_asi:{
                required:"Seleccione la hora"
            }            
        },
        submitHandler: function(form) {
            $('#cargaAsistencias').fadeIn();
            form.submit();
        }
        
    });
    
    function resetear(){
        miValidador.resetForm();   
        $('form')[0].reset();
    }

    
    

</script>