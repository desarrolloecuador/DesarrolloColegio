<script>    
    $("#menu_periodos").addClass("active");    
</script>

  <div class="row">
    <div class="col-lg-12">
        <h3 class="page-header"><i class="fa fa-list-ol"></i> Tipos de Aporte</h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?php echo site_url('/welcome/index'); ?>">Inicio</a></li>
            <li><i class="fa fa-list-ol"></i><a href="<?php echo site_url('/tipos/index'); ?>">Tipos de Aporte</a></li>
            <li><i class="fa fa-pencil"></i>Editar Periodo</li>
        </ol>
    </div>
</div>
			
<div class="row">
    <div class="col-md-12">
      
      
        <section class="panel miPanel">
              <header class="panel-heading">
                   <b>Editar Tipo de Aporte</b>
              </header>
              <div class="panel-body">
               <form class="form-horizontal" id="frm_editar_tipo" method="post" action="<?php echo site_url("/tipos/editarTipo"); ?>">
                <fieldset>
                
                <input type="hidden" name="codigo_tip" id="codigo_tip" value="<?php echo $tipo->codigo_tip; ?>">

                <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="nombre_tip"><b> Nombre: </b> </label>  
                  <div class="col-md-5">
                  <input id="nombre_tip" name="nombre_tip" value="<?php echo $tipo->nombre_tip; ?>" type="text" required placeholder="Ingrese el nombre del tipo de aporte" class="form-control input-md">
                  <span class="help-block">Ej. Deberes</span>  
                  </div>
                </div>
                
                
                 <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="nombre_tip"><b> Porcentaje: </b> </label>  
                  <div class="col-md-2">
                  <input id="porcentaje_tip" name="porcentaje_tip" value="<?php echo $tipo->porcentaje_tip; ?>" type="text" required placeholder="Ingrese el porcentaje del tipo de aporte" class="form-control input-md">
                  <span class="help-block">Ej. 20</span>  
                  </div>
                </div>
                
           

                <!-- Button (Double) -->
                <div class="form-group">
                  <label class="col-md-4 control-label" for=""></label>
                  <div class="col-md-8">
                    <button id="" name="" class="btn btn-success" type="submit"> <i class="fa fa-save"> </i> &nbsp; Guardar</button>
                    &nbsp;
                    <a id="" name="" class="btn btn-default" href="<?php echo site_url('/tipos/index'); ?>" > <i class="fa fa-times"> </i> &nbsp; Cancelar</a>
                  </div>
                </div>

                </fieldset>
                </form>
            </div>
        </section>
    </div>    
</div>




<script>
 
        

    $('#frm_editar_tipo').validate({
        
        rules:{
            nombre_tip:{
                required:true,
                remote: {
                    url:"<?php echo site_url("/tipos/validarNombreTipo")?>",
                    type:"post",
                    data:{
                         codigo_tip:function(){
                            return $('#codigo_tip').val();
                        },
                        nombre_tip:function(){
                            return $('#nombre_tip').val()
                        }
                    }
                }
            },
            porcentaje_tip:{
                required:true
            }
        },
        messages:{
            nombre_tip:{
                required:"Por favor ingrese el nombre del tipo de aporte.",
                remote:"El nombre ingresado ya esta registrado en otro tipo de aporte."
            },
            porcentaje_per:{
                required:"Por favor indique el porcentaje.",
                 
            }
        }
        
        
    });
        
</script>

<br>
<br>
<br>