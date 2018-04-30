<script>    
    $("#menu_periodos").addClass("active");    
</script>

  <div class="row">
    <div class="col-lg-12">
        <h3 class="page-header"><i class="fa fa-calendar"></i> Periodos</h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?php echo site_url('/welcome/index'); ?>">Inicio</a></li>
            <li><i class="fa fa-calendar"></i><a href="<?php echo site_url('/periodos/index'); ?>">Periodos</a></li>
            <li><i class="fa fa-pencil"></i>Editar Periodo</li>
        </ol>
    </div>
</div>
			
<div class="row">
    <div class="col-md-12">
      
      
        <section class="panel miPanel">
              <header class="panel-heading">
                   <b>Editar Periodo Lectivo</b>
              </header>
              <div class="panel-body">
               <form class="form-horizontal" id="frm_editar_periodo" method="post" action="<?php echo site_url("/periodos/editarPeriodo"); ?>">
                <fieldset>
                
                <input type="hidden" name="codigo_per" id="codigo_per" value="<?php echo $periodo->codigo_per; ?>">

                <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="nombre_per"><b> Nombre del Periodo: </b> </label>  
                  <div class="col-md-5">
                  <input id="nombre_per" name="nombre_per" value="<?php echo $periodo->nombre_per; ?>" type="text" required placeholder="Ingrese el nombre del período lectivo" class="form-control input-md">
                  <span class="help-block">Ej. 2015-2016</span>  
                  </div>
                </div>
                
                  <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="nombre_per"><b> Estado del Periodo: </b> </label>  
                  <div class="col-md-5">
                      <select name="estado_per" id="estado_per" required class="form-control">
                          <option value="">--Seleccione una opción--</option>
                          <option value="1">Activo</option>
                          <option value="0">Inactivo</option>
                      </select>
                  </div>
                </div>

                <!-- Button (Double) -->
                <div class="form-group">
                  <label class="col-md-4 control-label" for=""></label>
                  <div class="col-md-8">
                    <button id="" name="" class="btn btn-success" type="submit"> <i class="fa fa-save"> </i> &nbsp; Guardar</button>
                    &nbsp;
                    <a id="" name="" class="btn btn-default" href="<?php echo site_url('/periodos/index'); ?>" > <i class="fa fa-times"> </i> &nbsp; Cancelar</a>
                  </div>
                </div>

                </fieldset>
                </form>
            </div>
        </section>
    </div>    
</div>




<script>
    <?php if($periodo->estado_per){ ?>
        $("#estado_per").val("1");
    <?php }else{ ?>
        $("#estado_per").val("0");
    <?php } ?>
        

    $('#frm_editar_periodo').validate({
        
        rules:{
            nombre_per:{
                required:true,
                remote: {
                    url:"<?php echo site_url("/periodos/validarNombrePeriodo")?>",
                    type:"post",
                    data:{
                         codigo_per:function(){
                            return $('#codigo_per').val();
                        },
                        nombre_per:function(){
                            return $('#nombre_per').val()
                        }
                    }
                }
            },
            estado_per:{
                required:true,
                remote:{
                    url: "<?php echo site_url("/periodos/validarEstadoPeriodo")?>",
                    type: "POST",
                    data:{
                        codigo_per:function(){
                            return $('#codigo_per').val();
                        },
                        estado_per:function(){
                            return $('#estado_per').val()
                        }
                    },
                   /* complete:function(data){
                        alert(data.responseText);
                    }*/
                }
            }
        },
        messages:{
            nombre_per:{
                required:"Por favor ingrese el nombre del periodo.",
                remote:"El nombre ingresado ya esta registrado en otro periodo."
            },
            estado_per:{
                required:"Por favor seleccione el estado del periodo.",
                remote:"Ya existe un periodo con el estado activo."
            }
        }
        
        
    });
        
</script>

<br>
<br>
<br>