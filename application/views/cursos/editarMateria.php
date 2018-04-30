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
            <li><i class="fa fa-file"></i><a href="<?php echo site_url('/cursos/materias').'/'.$periodo->codigo_per.'/'.$curso->codigo_cur; ?>">Materias | <?php echo $curso->nombre_cur; ?> "<?php echo $curso->paralelo_cur; ?>" | Periodo <?php echo $periodo->nombre_per; ?></a></li>	
            <li><i class="fa fa-pencil"> </i> Editar Materia</li>					  	
        </ol>
    </div>
</div>
 
<div class="row">
    <div class="col-md-12">

        <section class="panel miPanel">
              <header class="panel-heading">
                   <b>Datos de la Materia | <?php echo $curso->nombre_cur; ?> "<?php echo $curso->paralelo_cur; ?>" | Periodo <?php echo $periodo->nombre_per; ?> </b>
          
                    
              </header>
              <div class="panel-body collapse in" >
               <form class="form-horizontal" method="post" action="<?php echo site_url("/cursos/actualizarMateria"); ?>" id="frm_materias">
                <fieldset>
                
                <input type="hidden" name="codigo_mat" id="codigo_mat" value="<?php echo $materia->codigo_mat; ?>">
                
                <input type="hidden" name="codigo_cur" id="codigo_cur" value="<?php echo $curso->codigo_cur; ?>">
                
                <input type="hidden" name="codigo_per" id="codigo_per" value="<?php echo $periodo->codigo_per; ?>">

                <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="nombre_mat"><b> Nombre de la Materia: </b> </label>  
                  <div class="col-md-5">
                  <input id="nombre_mat" value="<?php echo $materia->nombre_mat; ?>" name="nombre_mat" type="text" required placeholder="Ingrese el nombre de la materia" class="form-control input-md">
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
                
                
                <br>
                <!-- Button (Double) -->
                <div class="form-group">
                  <label class="col-md-4 control-label" for=""></label>
                  <div class="col-md-8">
                    <button id="" name="" class="btn btn-success" type="submit"> <i class="fa fa-save"> </i> &nbsp; Guardar</button>
                    &nbsp;
                    <a id="" name="" class="btn btn-default" href="<?php echo site_url('/cursos/materias').'/'.$periodo->codigo_per.'/'.$curso->codigo_cur; ?>"> <i class="fa fa-times"> </i> &nbsp; Cancelar</a>
                  </div>
                </div>

                <br>
               
                </fieldset>
                </form>
            </div>
        </section>
    </div>    
</div>
 




<br>
<br>
<br>




<script>
    
    
    $('#codigo_usu').val('<?php echo $materia->codigo_usu; ?>');

    var miValidador=$('#frm_materias').validate({
        rules:{
            nombre_mat:{
                required:true,
                remote:{
                    url:"<?php echo site_url('cursos/validarNombreMateria'); ?>",
                    type:'post',
                    data:{
                        nombre_mat:function(){                            
                            return $('#nombre_mat').val();
                        },
                        codigo_cur:function(){
                            return $('#codigo_cur').val();
                        },
                        codigo_mat:function(){
                            return $('#codigo_mat').val();
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

</script>