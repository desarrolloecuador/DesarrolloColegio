 <script>    
    $("#menu_curso_<?php echo $curso->codigo_cur; ?>").addClass("active");    
</script>
  
<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header"><i class="fa fa-edit"></i> Aportes </h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?php echo site_url('/welcome/index'); ?>">Inicio</a></li>            
             <li><i class="fa fa-book"></i><a href="<?php echo site_url('/materias/materiasDocenteCurso').'/'.$curso->codigo_cur; ?>"> Materias | <?php echo $curso->nombre_cur.' "'.$curso->paralelo_cur.'" | '.$curso->seccion_cur; ?> </a></li>                              
            <li><i class="fa fa-book"></i><a href="<?php echo site_url('/estudiantes/listado').'/'.$curso->codigo_per.'/'.$curso->codigo_cur.'/'.$materia->codigo_mat; ?>"><?php echo $materia->nombre_mat; ?></a></li> 
            <li><i class="fa fa-edit"></i>Aportes</li> 

        </ol>
    </div>
</div>

<div class="panel miPanelCerrado">
    
    <header class="panel-heading">        
            <b>Nuevo Aporte</b>        
    </header>
    
    <div class="panel panel-body">
        <form id="frm_aportes" class="form-horizontal" action="<?php echo site_url('/aportes/guardarAporte'); ?>" method="post">
            <fieldset>
           
                <input type="hidden" name="codigo_cur" id="codigo_cur" value="<?php echo $curso->codigo_cur; ?>">
                <input type="hidden" name="codigo_mat" id="codigo_mat" value="<?php echo $materia->codigo_mat; ?>">
                <input type="hidden" name="codigo_per" id="codigo_per" value="<?php echo $periodo->codigo_per; ?>">
                
                <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="fechaenvio_apo"><b>Fecha de Envio:</b></label>  
                  <div class="col-md-4">
                  <input id="fechaenvio_apo" name="fechaenvio_apo" type="text" placeholder="Seleccione la fecha de envio" class="form-control input-md">
                  <span class="help-block">Ej. 2016-04-28</span>  
                  </div>
                </div>
                
                
                <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="fechaentrega_apo"><b>Fecha de Entrega:</b></label>  
                  <div class="col-md-4">
                  <input id="fechaentrega_apo" name="fechaentrega_apo" type="text" placeholder="Seleccione la fecha de entrega" class="form-control input-md">
                  <span class="help-block">Ej. 2016-04-28</span>  
                  </div>
                </div>
                
                
                
                   <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="quimestre_apo"><b>Quimestre:</b></label>  
                  <div class="col-md-4">
                      
                      <select name="quimestre_apo" id="quimestre_apo" class="form-control" required title="Seleccione el quimestre del aporte">
                          <option value="">--Seleccione el quimestre--</option>
                          <option value="PRIMERO">PRIMERO</option>
                          <option value="SEGUNDO">SEGUNDO</option>
                      </select>
                  
                  </div>
                </div>
                
                
                <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="fechaentrega_apo"><b>Tipo de Aporte:</b></label>  
                  <div class="col-md-4">
                      
                      <select name="codigo_tip" id="codigo_tip" class="form-control" required title="Seleccione el tipo de aporte">
                          <option value="">--Seleccione el tipo--</option>
                          <?php if($tipos){ ?>
                              
                              <?php foreach($tipos->result() as $tipo ){ ?>
                                  <option value="<?php echo $tipo->codigo_tip; ?>"><?php echo $tipo->nombre_tip; ?> | <?php echo $tipo->porcentaje_tip; ?>%</option>
                              <?php } ?>
                          <?php  } ?>                                                  
                      </select>
                  
                  </div>
                </div>
 
                <!-- Textarea -->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="observacion_apo"><b>Descripción:</b></label>
                  <div class="col-md-4">                     
                    <textarea class="form-control" id="observacion_apo" name="observacion_apo"></textarea>
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
                          <div class="loader" id="cargarAportes" style="display:none;"></div>
                      </div>
                </div>
                                                   

            </fieldset>
        </form>     
    </div>    
</div>





<div class="panel miPanelCerrado">
    
    <header class="panel-heading">        
            <b>Promedios</b>        
    </header>
    
    <div class="panel panel-body">
        <form id="frm_promedios" class="form-horizontal" action="<?php echo site_url('/aportes/detalleGeneral'); ?>" method="post">
            <fieldset>
           
           
              <input type="hidden" name="codigo_cur" id="codigo_cur" value="<?php echo $curso->codigo_cur; ?>">
                <input type="hidden" name="codigo_mat" id="codigo_mat" value="<?php echo $materia->codigo_mat; ?>">
                <input type="hidden" name="codigo_per" id="codigo_per" value="<?php echo $periodo->codigo_per; ?>">
                
                <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="quimestre_apo"><b>Quimestre:</b></label>  
                  <div class="col-md-4">
                     <select name="quimestre_apo" id="quimestre_apo" class="form-control" required title="Seleccione el quimestre para la búsqueda de promedios">
                              <option value="">--Seleccione el quimestre--</option>
                              <option value="PRIMERO">PRIMERO</option>
                              <option value="SEGUNDO">SEGUNDO</option>
                      </select> 
                  </div>
                </div>
                
                
                 <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="quimestre_apo"></label>  
                  <div class="col-md-4">
                    <button class="btn btn-primary"> <i class="fa fa-search"> </i> Buscar Promedios </button>
                  </div>
                </div>
                
           
           
            </fieldset>
            
        </form>
    </div>
</div>



<div class="panel miPanel">    
    <header class="panel-heading">        
            <b>Listado de Aportes</b>        
    </header>    
    <div class="panel panel-body">     
           
            <?php if($aportes){ ?>       
                   
                    <table class="table table-striped table-hover tblBuscador">
                           <thead>
                                <tr>
                                    <th class="text-center">No.</th>
                                    <th class="text-center">FECHA ENVIO</th>
                                    <th class="text-center">FECHA ENTREGA</th>
                                    <th class="text-center">QUIMESTRE</th>
                                    <th class="text-center">TIPO</th>                                    
                                    <th class="text-center">DESCRIPCIÓN</th>
                                    <th class="text-center">OPCIONES</th>
                                </tr>                
                           </thead>
                           <tbody>
                                    <?php $i=1; ?>
                                    <?php foreach($aportes->result() as $aporte){ ?>                                  
                                       <tr>
                                           <td class="text-center"><?php echo $i++; ?></td>
                                           <td class="text-center"><?php echo $aporte->fechaenvio_apo; ?></td> 
                                           <td class="text-center"><?php echo $aporte->fechaentrega_apo; ?></td> 
                                           <td class="text-center"><?php echo $aporte->quimestre_apo; ?></td> 
                                           <td class="text-center"><?php echo $aporte->nombre_tip.' | '.$aporte->porcentaje_tip.'%'; ?></td>                 
                                           <td class="text-center"><?php echo $aporte->observacion_apo; ?></td>
                                           <td class="text-center">                                               
                                               <a href="<?php echo site_url('aportes/detalleRegistroAporte').'/'.$curso->codigo_cur.'/'.$periodo->codigo_per.'/'.$materia->codigo_mat.'/'.$aporte->codigo_apo; ?>" class="btn btn-default"> <i class="fa fa-mail-forward"></i> </a>
                                               <button onclick="abrirEliminacion('<?php echo $aporte->codigo_apo; ?>')"  class="btn btn-default"> <i class="fa fa-trash-o"></i> </button>
                                           </td>
                                       </tr>
                                    <?php } ?>                            
                           </tbody>
                           <tfoot>
                                <tr>
                                    <th class="text-center">No.</th>
                                    <th class="text-center">FECHA ENVIO</th>
                                    <th class="text-center">FECHA ENTREGA</th>
                                    <th class="text-center">QUIMESTRE</th>
                                    <th class="text-center">TIPO</th>                                    
                                    <th class="text-center">DESCRIPCIÓN</th>
                                    <td></td>
                                </tr>                       
                           </tfoot>
                    </table>
            <?php }else{ ?>
                
                <div class="alert alert-danger">
                    
                    <i class="fa fa-exclamation-triangle"> </i> No se han encontrado registros de aportes para la materia y curso seleccionados.
                    
                </div>
                
            <?php } ?>
    
    
    </div>
</div>

<br>
<br>
<br>

<!-- Modal -->
<form action="<?php echo site_url('aportes/eliminarAporte'); ?>" method="post">
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
            <input type="hidden" name="codigo_apo" id="codigo_apo" >
            ¿Está seguro que desea eliminar el aporte indicado?
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
        $('#codigo_apo').val(id);        
    }
 
    
    $().ready(function(){
        $('#fechaenvio_apo').datepicker({
            changeYear: true,
            changeMonth: true,
            yearRange: '2017:2020', 
            maxDate: new Date
        });
        
        $('#fechaentrega_apo').datepicker({
            changeYear: true,
            changeMonth: true,
            yearRange: '2017:2020', 
            minDate: new Date
        });
    });    
    
   
    
    
    var miValidador=$('#frm_aportes').validate({
        
        rules:{
            fechaenvio_apo:{
                required:true
            },
            fechaentrega_apo:{
                required:true,            
            },
            observacion_apo:{
                required:true
            }
            
        },
        messages:{
            fechaenvio_apo:{
                required:"Seleccione la fecha de envio"
            },
            fechaentrega_apo:{
                required:"Seleccione la fecha de entrega",                
            },
            observacion_apo:{
                required: "Ingrese la descripción del aporte"
            }
        },
        submitHandler: function(form) {
            $('#cargarAportes').fadeIn();
            form.submit();
        }
        
    });
    
    function resetear(){
        miValidador.resetForm();   
        $('form')[0].reset();
    }

    $("#frm_promedios").validate();
    
    

</script>