 <script>    
    $("#menu_curso_<?php echo $curso->codigo_cur; ?>").addClass("active");    
</script>
  
<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header"><i class="fa fa-envelope"></i> Comunicados </h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?php echo site_url('/welcome/index'); ?>">Inicio</a></li>            
             <li><i class="fa fa-book"></i><a href="<?php echo site_url('/materias/materiasDocenteCurso').'/'.$curso->codigo_cur; ?>"> Materias | <?php echo $curso->nombre_cur.' "'.$curso->paralelo_cur.'" | '.$curso->seccion_cur; ?> </a></li>                              
            <li><i class="fa fa-book"></i><a href="<?php echo site_url('/estudiantes/listado').'/'.$curso->codigo_per.'/'.$curso->codigo_cur.'/'.$materia->codigo_mat; ?>"><?php echo $materia->nombre_mat; ?></a></li> 
            <li><i class="fa fa-envelope"></i>Comunicados</li> 

        </ol>
    </div>
</div>

<div class="panel miPanelCerrado">
    
    <header class="panel-heading">        
            <b>Nuevo Comunicado</b>        
    </header>
    
    <div class="panel panel-body">
        <form id="frm_comunicados" class="form-horizontal" action="<?php echo site_url('/comunicados/guardarComunicado'); ?>" method="post">
            <fieldset>
           
                <input type="hidden" name="codigo_cur" id="codigo_cur" value="<?php echo $curso->codigo_cur; ?>">
                <input type="hidden" name="codigo_mat" id="codigo_mat" value="<?php echo $materia->codigo_mat; ?>">
                <input type="hidden" name="codigo_per" id="codigo_per" value="<?php echo $periodo->codigo_per; ?>">
                
                <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-3 control-label" for="fecha_com"><b>Fecha:</b></label>  
                  <div class="col-md-8">
                  <input id="fecha_com" name="fecha_com" type="text" placeholder="Seleccione la fecha" class="form-control input-md">
                  <span class="help-block">Ej. 2016-04-28</span>  
                  </div>
                </div>
                
               
 
                <!-- Textarea -->
                <div class="form-group">
                  <label class="col-md-3 control-label" for="mensaje_com"><b>Mensaje:</b></label>
                  <div class="col-md-8">                     
                    <textarea class="form-control" id="mensaje_com" name="mensaje_com" rows="10"></textarea>
                  </div>
                </div>
                
                
                 <!-- Textarea -->
                <div class="form-group">
                  <label class="col-md-3 control-label" for="mensaje_com"><b>Estudiantes Destinatarios:</b></label>
                  <div class="col-md-8">                     
                    <select title="--Seleccione los estudiantes--" required name="codigo_est[]" id="codigo_est" class="form-control  selectpicker" data-live-search="true"  multiple>                        
                        <?php if($estudiantes){ ?>
                            <?php foreach($estudiantes->result() as $estudiante){ ?>    
                                <option value="<?php echo $estudiante->codigo_est; ?>"><?php echo $estudiante->nombre_est; ?> </option>
                            <?php }?>
                        <?php }?>
                        
                    </select>
                    <br> <br>
                    <button onclick="seleccionarTodos()" type="button" class="btn btn-default btn-xs"> <i class="fa fa-check"> </i> Seleccionar Todos</button>
                    
                    <button onclick="quitarTodos()" type="button" class="btn btn-default btn-xs"> <i class="fa fa-times"> </i> Quitar Todos</button>
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
                          <div class="loader" id="cargarComunicados" style="display:none;"></div>
                      </div>
                </div>
                                                  
                <br><br>
                                                   

            </fieldset>
        </form>     
    </div>    
</div>


<div class="panel miPanel">    
    <header class="panel-heading">        
            <b>Listado de Comunicados</b>        
    </header>    
    <div class="panel panel-body">     
           
            <?php if($comunicados){ ?>       
                    <table class="table table-striped table-hover tblBuscador">
                           <thead>
                                <tr>
                                    <th class="text-center">No.</th>
                                    <th class="text-center">FECHA</th>                                    
                                    <th class="text-center">MENSAJE</th>
                                    <th class="text-center">OPCIONES</th>
                                </tr>                
                           </thead>
                           <tbody>
                                    <?php $i=1; ?>
                                    <?php foreach($comunicados->result() as $comunicado){ ?>                                  
                                       <tr>
                                           <td class="text-center"><?php echo $i++; ?></td>
                                           <td class="text-center"><?php echo $comunicado->fecha_com; ?></td>                                           
                                           <td class="text-center"><?php echo $comunicado->mensaje_com; ?></td>
                                           <td class="text-center">                                               
                                               <a href="<?php echo site_url('comunicados/detalleRegistroComunicados').'/'.$curso->codigo_cur.'/'.$periodo->codigo_per.'/'.$materia->codigo_mat.'/'.$comunicado->codigo_com; ?>" class="btn btn-default"> <i class="fa fa-mail-forward"></i> </a>
                                               <button onclick="abrirEliminacion('<?php echo $comunicado->codigo_com; ?>')"  class="btn btn-default"> <i class="fa fa-trash-o"></i> </button>
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
                    
                    <i class="fa fa-exclamation-triangle"> </i> No se han encontrado comunicados para la materia y curso seleccionados.
                    
                </div>
                
            <?php } ?>
    
    
    </div>
</div>

<br>
<br>
<br>

<!-- Modal -->
<form action="<?php echo site_url('comunicados/eliminarComunicado'); ?>" method="post">
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
            <input type="hidden" name="codigo_com" id="codigo_com" >
            ¿Está seguro que desea eliminar el comunicado indicado?
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
     
    function seleccionarTodos(){
        $('#codigo_est option').prop('selected', true);
        $('#codigo_est').selectpicker('refresh');
    }
    
    function quitarTodos(){
        $('#codigo_est option').prop('selected', false);
        $('#codigo_est').selectpicker('refresh');
    }
       
    function abrirEliminacion(id){
        $('#modalEliminacion').modal('show');
        $('#codigo_com').val(id);        
    }
 
    
    $().ready(function(){
        $('#fecha_com').datepicker({
            changeYear: true,
            changeMonth: true,
            yearRange: '2017:2020'
        });
    });    
    
   
    
    
    var miValidador=$('#frm_comunicados').validate({
        
        rules:{
            fecha_com:{
                required:true
            },
            mensaje_com:{
                required:true
            },
            "codigo_est[]":{
                required:true
            }
        },
        messages:{
            fecha_com:{
                required:"Seleccione la fecha"
            },
            mensaje_com:{
                required:"Indique el mensaje del comunicado",                
            },
            "codigo_est[]":{
                required:"Seleccione al menos un destinatario",                
            }     
        },
        submitHandler: function(form) {
            $('#cargarComunicados').fadeIn();
            form.submit();
        }
        
    });
    
    function resetear(){
        miValidador.resetForm();   
        $('form')[0].reset();
    }

    
     $(document).ready(function(){        
        $('.selectpicker').selectpicker({});      
    });  
    
    
    

</script>