<script>    
    $("#menu_tipos").addClass("active");    
</script>

  <div class="row">
    <div class="col-lg-12">
        <h3 class="page-header"><i class="fa fa-list-ol"></i> Tipos</h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?php echo site_url('/welcome/index'); ?>">Inicio</a></li>
            <li><i class="fa fa-list-ol"></i>Tipos</li>						  	
        </ol>
    </div>
</div>
			
<div class="row">
    <div class="col-md-12">
      
      
        <section class="panel miPanel">
              <header class="panel-heading">
                   <b>Nuevo Tipo de Aporte</b>
              </header>
              <div class="panel-body">
               <form class="form-horizontal" id="frm_nuevo_tipo" method="post" action="<?php echo site_url("/tipos/guardarTipo"); ?>">
                <fieldset>

                <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="nombre_tip"><b> Nombre: </b> </label>  
                  <div class="col-md-5">
                  <input id="nombre_tip" name="nombre_tip" type="text" required placeholder="Ingrese el nombre del tipo de aporte" class="form-control input-md">
                  <span class="help-block">Ej. Deberes</span>  
                  </div>
                </div>

               <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="porcentaje_tip"><b> Porcentaje: </b> </label>  
                  <div class="col-md-2">
                  <input id="porcentaje_tip" name="porcentaje_tip" type="text" required placeholder="Ingrese el porcentaje del tipo de aporte" class="form-control input-md">
                  <span class="help-block">Ej. 10</span>  
                  </div>
                </div>
                
                <!-- Button (Double) -->
                <div class="form-group">
                  <label class="col-md-4 control-label" for=""></label>
                  <div class="col-md-8">
                    <button id="" name="" class="btn btn-success" type="submit"> <i class="fa fa-save"> </i> &nbsp; Guardar</button>
                    &nbsp;
                    <button id="" name="" class="btn btn-default" type="reset"> <i class="fa fa-times"> </i> &nbsp; Cancelar</button>
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
                   <b>Listado de Tipos de Aportes</b>
              </header>
              <div class="panel-body">
                  
                  <?php if($tipos) { ?>
                      
                      <table class="table table-striped tblBuscador">
                         <thead>
                              <tr>
                                  <th>No.</th>
                                  <th>NOMBRE</th>                              
                                  <th>PORCENTAJE</th>
                                  <th>OPCIONES</th>                              
                              </tr> 
                         </thead>  
                         <tfoot>
                              <tr>
                                  <th>No.</th>
                                  <th>NOMBRE</th>                              
                                  <th>PORCENTAJE</th>
                                  <td></td>                              
                              </tr> 
                         </tfoot>  
                          <tbody>
                           <?php $i=1; ?>
                           <?php foreach($tipos->result() as $tipo) { ?>
                               
                               <tr>
                                   <td><?php echo $i; ?></td>
                                   <td><?php echo $tipo->nombre_tip; ?></td>                                
                                   <td><?php echo $tipo->porcentaje_tip; ?>%</td>   
                                   <td>
                                       <a href="<?php echo site_url('tipos/editar').'/'.$tipo->codigo_tip; ?>" class="btn btn-default"> <i class="fa fa-pencil"> </i> </a>
                                       <button class="btn btn-default" onclick="abrirEliminacion(<?php echo $tipo->codigo_tip; ?>);"> <i class="fa fa-trash-o"> </i> </button>
                                   </td>
                                   
                               </tr>
                               <?php $i++; ?>
                           <?php } ?>
                          </tbody>
                      </table>
                  
                  <?php }else{ ?>
                      <div class="alert alert-danger">
                              <i class="fa fa-exclamation-triangle"> </i> No se encontraron tipos de aportes registrados.
                      </div>                  
                  <?php } ?>
              
            </div>
        </section>
    </div>
</div>

 
<!-- Modal -->
<form action="<?php echo site_url('tipos/eliminarTipo'); ?>" method="post">
    <div id="modalEliminacion" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title" style="color:#FF2D55;"><b> <i class="fa fa-info-circle"> </i> CONFIRMACIÓN</b></h4>
          </div>
          <div class="modal-body">
            <input type="hidden" name="codigo_tip" id="codigo_tip" >
            ¿Está seguro que desea eliminar el tipo de aporte indicado?
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
        $('#codigo_tip').val(id);        
    }
    
    $('#frm_nuevo_tipo').validate({
        rules:{
            nombre_tip:{
                required:true,
                remote:{
                    url:"<?php echo site_url('tipos/validarNombreTipoNuevo'); ?>",
                    data:{
                        nombre_tip:function(){
                            return $('#nombre_tip').val();
                        }                        
                    },
                    type:'post'
                }
            },
            porcentaje_tip:{
                required:true
            }
        },
        messages:{
            nombre_tip:{
                required:"Por favor ingrese el nombre del tipo",
                remote:"El nombre ingresado ya ha sido registrado en otro tipo de aporte"
            },
            porcentaje_tip:{
                required:"Por favor ingrese el porcentaje de calificación"
            }
        }
        
    });
    

    
</script>