<script>    
    $("#menu_periodos").addClass("active");    
</script>

  <div class="row">
    <div class="col-lg-12">
        <h3 class="page-header"><i class="fa fa-calendar"></i> Periodos</h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?php echo site_url('/welcome/index'); ?>">Inicio</a></li>
            <li><i class="fa fa-calendar"></i>Periodos</li>						  	
        </ol>
    </div>
</div>
			
<div class="row">
    <div class="col-md-12">
      
      
        <section class="panel miPanel">
              <header class="panel-heading">
                   <b>Nuevo Periodo Lectivo</b>
              </header>
              <div class="panel-body">
               <form class="form-horizontal" id="frm_nuevo_periodo" method="post" action="<?php echo site_url("/periodos/guardarPeriodo"); ?>">
                <fieldset>

                <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="nombre_per"><b> Nombre del Periodo: </b> </label>  
                  <div class="col-md-5">
                  <input id="nombre_per" name="nombre_per" type="text" required placeholder="Ingrese el nombre del período lectivo" class="form-control input-md">
                  <span class="help-block">Ej. 2015-2016</span>  
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
                   <b>Listado de Periodos Lectivos</b>
              </header>
              <div class="panel-body">
                  
                  <?php if($periodos) { ?>
                      
                      <table class="table table-striped tblBuscador">
                         <thead>
                              <tr>
                                  <th>No.</th>
                                  <th>NOMBRE</th>                              
                                  <th>ESTADO</th>
                                  <th>OPCIONES</th>                              
                              </tr> 
                         </thead>  
                         <tfoot>
                              <tr>
                                  <th>No.</th>
                                  <th>NOMBRE</th>                              
                                  <th>ESTADO</th>
                                  <td></td>                              
                              </tr> 
                         </tfoot>  
                          <tbody>
                           <?php $i=1; ?>
                           <?php foreach($periodos->result() as $periodo) { ?>
                               
                               <tr>
                                   <td><?php echo $i; ?></td>
                                   <td><?php echo $periodo->nombre_per; ?></td>                                
                                   <td>
                                   
                                       <?php if($periodo->estado_per){ ?>
                                           <label for="" class="label label-success">Activo</label>
                                       <?php }else{ ?>
                                           <label for="" class="label label-danger">Inactivo</label>                                       
                                       <?php } ?>
                                   
                                   </td>
                                   <td>
                                       <a href="<?php echo site_url('periodos/editar').'/'.$periodo->codigo_per; ?>" class="btn btn-default"> <i class="fa fa-pencil"> </i> </a>
                                       <button class="btn btn-default" onclick="abrirEliminacion(<?php echo $periodo->codigo_per; ?>);"> <i class="fa fa-trash-o"> </i> </button>
                                   </td>
                                   
                               </tr>
                               <?php $i++; ?>
                           <?php } ?>
                          </tbody>
                      </table>
                  
                  <?php }else{ ?>
                      <div class="alert alert-danger">
                              <i class="fa fa-exclamation-triangle"> </i> No se encontraron periodos lectivos registrados
                      </div>                  
                  <?php } ?>
              
            </div>
        </section>
    </div>
</div>

 
<!-- Modal -->
<form action="<?php echo site_url('periodos/eliminarPeriodo'); ?>" method="post">
    <div id="modalEliminacion" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title" style="color:#FF2D55;"><b> <i class="fa fa-info-circle"> </i> CONFIRMACIÓN</b></h4>
          </div>
          <div class="modal-body">
            <input type="hidden" name="codigo_per" id="codigo_per" >
            ¿Está seguro que desea eliminar el periodo indicado?
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
        $('#codigo_per').val(id);        
    }
    
    $('#frm_nuevo_periodo').validate({
        rules:{
            nombre_per:{
                required:true,
                remote:{
                    url:"<?php echo site_url('periodos/validarNombrePeriodoNuevo'); ?>",
                    data:{
                        nombre_per:function(){
                            return $('#nombre_per').val();
                        }                        
                    },
                    type:'post'
                }
            }
        },
        messages:{
            nombre_per:{
                required:"Por favor ingrese el nombre del periodo",
                remote:"El nombre ingresado ya ha sido registrado en otro periodo"
            }
        }
        
    });
    

    
</script>