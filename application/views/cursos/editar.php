<script>    
    $("#menu_cursos").addClass("active");    
</script>

  <div class="row">
    <div class="col-lg-12">
        <h3 class="page-header"><i class="fa fa-building"></i> Cursos</h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?php echo site_url('/welcome/index'); ?>">Inicio</a></li>
            <li><i class="fa fa-building"></i><a href="<?php echo site_url('/cursos/index'); ?>">Cursos/Materias</a></li>
            <li><i class="fa fa-list"></i><a href="<?php echo site_url('/cursos/listado').'/'.$periodo->codigo_per; ?>">Listado de Cursos - Periodo <?php echo $periodo->nombre_per; ?> </a></li>						  	
            <li><i class="fa fa-pencil"></i>Editar Curso</li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
      
      
        <section class="panel miPanel">
              <header class="panel-heading">
                   <b>Datos del Curso </b>
          
              </header>
              <div class="panel-body collapse in" id="nuevoCurso">
               <form class="form-horizontal" method="post" action="<?php echo site_url("/cursos/editarCurso"); ?>" id="frm_curso">
                <fieldset>
                
                <input type="hidden" name="codigo_cur" id="codigo_cur" value="<?php echo $curso->codigo_cur; ?>">
                
                <input type="hidden" name="codigo_per" id="codigo_per" value="<?php echo $curso->codigo_per; ?>">
                
                <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="seccion_cur"><b> Sección del curso: </b> </label>  
                  <div class="col-md-5">
                        <select name="seccion_cur" id="seccion_cur" class="form-control">
                            <option value="">--Seleccione una opción--</option>
                            <option value="Escuela">Escuela</option>
                            <option value="Colegio">Colegio</option>
                        </select>
                  </div>
                </div>
                

                <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="nombre_cur"><b> Nombre del curso: </b> </label>  
                  <div class="col-md-5">
                  <input id="nombre_cur" name="nombre_cur" type="text" required placeholder="Ingrese el nombre del curso" class="form-control input-md">
                  <span class="help-block">Ej. Primero</span>  
                  </div>
                </div>
                
                 <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="nombre_per"><b> Paralelo del curso: </b> </label>  
                  <div class="col-md-5">
                      <select name="paralelo_cur" id="paralelo_cur" class="form-control" required>
                          <option value="">--Seleccione una opción--</option>
                          <option value="A">A</option>
                          <option value="B">B</option>
                          <option value="C">C</option>
                          <option value="D">D</option>
                          <option value="E">E</option>
                          <option value="F">F</option>
                          <option value="UNICO">UNICO</option>
                        <!--<option value="G">G</option>
                          <option value="H">H</option>
                          <option value="I">I</option>
                          <option value="J">J</option>
                          <option value="K">K</option>
                          <option value="L">L</option>
                          <option value="M">M</option>
                          <option value="N">N</option>
                          <option value="O">O</option>
                          <option value="P">P</option>
                          <option value="Q">P</option>
                          <option value="R">R</option>
                          <option value="S">S</option>
                          <option value="T">T</option>
                          <option value="U">U</option>
                          <option value="V">V</option>
                          <option value="W">W</option>
                          <option value="X">X</option>
                          <option value="Y">Y</option>
                          <option value="Z">Z</option>-->
                      </select>
                  </div>
                </div>
                
                 <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="codigo_usu"><b> Tutor del curso: </b> </label>  
                  <div class="col-md-5">
                      <select  name="codigo_usu" id="codigo_usu" class="form-control selectpicker" data-live-search="true" >               <option data-hidden="true" value="">--Seleccione un docente--</option> 
                         
                         <?php if($docentes){ ?>         
                              <?php foreach($docentes->result() as $docente){ ?>
                                  <option value="<?php echo $docente->codigo_usu; ?>"><?php echo $docente->apellido_usu.' '.$docente->nombre_usu; ?></option>
                              <?php } ?>
                        <?php } ?>
                        
                      </select>
                      <br>                 
                  </div>
                </div>
                
                <input type="hidden" name="codigo_per" value="<?php echo $periodo->codigo_per; ?>">

                <!-- Button (Double) -->
                <div class="form-group">
                  <label class="col-md-4 control-label" for=""></label>
                  <div class="col-md-8">
                    <button id="" name="" class="btn btn-success" type="submit"> <i class="fa fa-save"> </i> &nbsp; Guardar</button>
                    &nbsp;
                    <a id="" name="" class="btn btn-default" href="<?php echo site_url('/cursos/listado').'/'.$periodo->codigo_per; ?>" > <i class="fa fa-times"> </i> &nbsp; Cancelar</a>
                  </div>
                </div>
                
                <br><br>

                </fieldset>
                </form>
            </div>
        </section>
    </div>    
</div>





<script>
    
    $(document).ready(function(){    
        $("#seccion_cur").val('<?php echo $curso->seccion_cur; ?>');
        $("#nombre_cur").val('<?php echo $curso->nombre_cur; ?>');
        $("#paralelo_cur").val('<?php echo $curso->paralelo_cur; ?>');
        $("#codigo_usu").val('<?php echo $curso->codigo_usu; ?>');
        $('.selectpicker').selectpicker();
    });  
    
    $('#frm_curso').validate({
        
        rules:{
            seccion_cur:{
                required:true
            },
            nombre_cur:{
                required:true
            },
            paralelo_cur:{
                required:true
            },
            codigo_usu:{
                required:true
            }
        },
        messages:{
            seccion_cur:{
                required:"Seleccione la sección del curso"
            },
            nombre_cur:{
                required:"Ingrese el nombre del curso"
            },
            paralelo_cur:{
                required:"Seleccione el paralelo del curso"
            },
            codigo_usu:{
                required:"Seleccione el tutor del curso"
            }
            
        }
        
    });
    
    

</script>