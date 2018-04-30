<script>    
    $("#menu_cursos").addClass("active");    
</script>

  <div class="row">
    <div class="col-lg-12">
        <h3 class="page-header"><i class="fa fa-users"></i> Estudiantes </h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?php echo site_url('/welcome/index'); ?>">Inicio</a></li>
            <li><i class="fa fa-building"></i><a href="<?php echo site_url('/cursos/index'); ?>">Cursos/Materias</a></li>            
            <li><i class="fa fa-list"></i><a href="<?php echo site_url('/cursos/listado').'/'.$periodo->codigo_per; ?>">Listado de Cursos - Periodo <?php echo $periodo->nombre_per; ?></a></li>						  	
            <li><a href="<?php echo site_url('cursos/estudiantes').'/'.$periodo->codigo_per.'/'.$curso->codigo_cur; ?>"><i class="fa fa-users"></i>Estudiantes | <?php echo $curso->nombre_cur; ?> "<?php echo $curso->paralelo_cur; ?>" | Periodo <?php echo $periodo->nombre_per; ?></a></li>	
            <li><i class="fa fa-pencil"></i>Editar Estudiante</li>					  	
        </ol>
    </div>
</div>








<div class="row">
    <div class="col-md-12">
      
      
        <section class="panel miPanel">
              <header class="panel-heading">
                   <b>Nuevo Estudiante</b>
          
              </header>
              <div class="panel-body collapse in" id="nuevoEstudiante">
               <form id="frm_estudiantes" class="form-horizontal" method="post" action="<?php echo site_url("cursos/actualizarEstudiante"); ?>">
                <fieldset>
                
                
                     <!-- Text input-->
                    <div class="form-group">
                      <label class="col-md-12 text-center" for="cedula_est"><b style="font-size: 20px;"> <br> 1. Representante<br></b>  </label>      
                                
                    </div>
                    
                    <input type="hidden" name="codigo_est" id="codigo_est" value="<?php echo $estudiante->codigo_est; ?>">

              

                     <!-- Text input-->
                    <div class="form-group">
                      <label class="col-md-2 control-label" for="cedula_usu"><b> Representante: </b> </label>  
                      <div class="col-md-9">
                              <select name="codigo_usu" id="codigo_usu" class="form-control selectpicker" data-live-search="true" title="--Seleccione un representante--">
                                  <?php if($representantes){ ?>
                                      
                                         <?php foreach($representantes->result() as $representante){ ?>
                                             
                                                 <option value="<?php echo $representante->codigo_usu; ?>" data-subtext="| <?php echo $representante->cedula_usu; ?>"><?php echo $representante->nombre_usu; ?></option>
                                         
                                          <?php }  ?>        
                                  
                                  <?php }  ?>
                                  
                                  
                                  
                              </select>  
                      </div>                      
                    </div>
                
                <input type="hidden" name="codigo_cur" value="<?php echo $curso->codigo_cur; ?>" id="codigo_cur">
                <input type="hidden" name="codigo_per" value="<?php echo $periodo->codigo_per; ?>">
                
                <div class="row">
                   <div class="col-md-12">
                           <!-- Text input-->
                        <div class="form-group">
                          <label class="col-md-12 text-center" for="cedula_est"><b style="font-size: 20px;"> 2. Datos del Estudiante </b> </label>                   
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                          <label class="col-md-2 control-label" for="cedula_est"><b> No. Cédula: </b> </label>  
                          <div class="col-md-3">
                                  <input value="<?php echo $estudiante->cedula_est; ?>" id="cedula_est" name="cedula_est" type="text" placeholder="Ingrese el número de cédula del estudiante" class="form-control input-md">
                                  <span class="help-block">Ej. 1725663254</span>  
                          </div>
                          <label class="col-md-3 control-label" for="fechanacimiento_est"><b> Fecha de Nacimiento: </b> </label>  
                          <div class="col-md-3">
                              <input value="<?php echo $estudiante->fechanacimiento_est; ?>" id="fechanacimiento_est" name="fechanacimiento_est" type="text" required placeholder="Seleccione la fecha de nacimiento" class="form-control input-md">
                              <span class="help-block">Ej.1999-08-26</span>  
                          </div>
                                                  
                        </div>

 

                          <!-- Text input-->
                        <div class="form-group">                          
                              <label class="col-md-2 control-label" for="nombre_est"><b> Apellidos y Nombres: </b> </label>  
                              <div class="col-md-9">
                                      <input value="<?php echo $estudiante->nombre_est; ?>" id="nombre_est" name="nombre_est" type="text" required placeholder="Ingrese los apellidos y nombres completos del estudiante" class="form-control input-md">
                                      <span class="help-block">Ej. Juan Carlos</span>  
                              </div>                          
                        </div>



                           <!-- Text input-->
                        <div class="form-group">
                          <label class="col-md-2 control-label" for="direccion_est"><b> Dirección: </b> </label>  
                          <div class="col-md-3">
                              <textarea id="direccion_est" name="direccion_est" type="text" required placeholder="Ingrese la dirección domiciliaria del estudiante" class="form-control input-md"><?php echo $estudiante->direccion_est; ?></textarea>
                              <span class="help-block">Ej. Latacunga, Av. Antonia Vela #123</span>  
                          </div>
                          <label class="col-md-3 control-label" for="lugarnacimiento_est"><b> Lugar de Nacimiento: </b> </label>  
                          <div class="col-md-3">
                                  <textarea id="lugarnacimiento_est" name="lugarnacimiento_est" type="text" required placeholder="Ingrese el lugar de nacimiento del estudiante" class="form-control input-md"><?php echo $estudiante->lugarnacimiento_est; ?></textarea>
                                 <span class="help-block">Ej. Quito </span>  
                          </div>
                        </div>


                    
                </div> <!-- col-md-12 -->
                
                </div><!-- div.row -->
                
                
                
                <div class="col-md-12">
                
                    <hr style="border: 1px dotted #C7C7CC;">
                        <!-- Text input-->
                    <div class="form-group">
                      <label class="col-md-12 text-center" for="cedula_est"><b style="font-size: 20px;"> 3. Datos del Padre </b> </label>                   
                    </div>



                     <!-- Text input-->
                    <div class="form-group">
                      <label class="col-md-2 control-label" for="cedulapadre_est"><b> No. Cédula: </b> </label>  
                      <div class="col-md-3">
                          <input value="<?php echo $estudiante->cedulapadre_est; ?>" id="cedulapadre_est" name="cedulapadre_est" type="text"  placeholder="Ingrese el número de cédula del padre" class="form-control input-md">
                         <span class="help-block">Ej. 0558874415 </span>  
                      </div>
                      <label class="col-md-3 control-label" for="nombrepadre_est"><b> Apellidos y Nombres: </b> </label>  
                      <div class="col-md-3">
                          <input id="nombrepadre_est" value="<?php echo $estudiante->nombrepadre_est; ?>" name="nombrepadre_est" type="text"  placeholder="Ingrese los apellidos y nombres del padre" class="form-control input-md">
                         <span class="help-block">Ej. Diaz Villalva Juan Carlos
                          </span>  
                      </div>
                    </div>


                   <hr style="border: 1px dotted #C7C7CC;">

                         <!-- Text input-->
                    <div class="form-group">
                      <label class="col-md-12 text-center" for="cedula_est"><b style="font-size: 20px;"> <br> 4. Datos de la Madre <br></b>  </label>      
                                
                    </div>


                     <!-- Text input-->
                    <div class="form-group">
                      <label class="col-md-2 control-label" for="cedulamadre_est"><b> No. Cédula: </b> </label>  
                      <div class="col-md-3">
                          <input value="<?php echo $estudiante->cedulamadre_est; ?>" id="cedulamadre_est" name="cedulamadre_est" type="text"  placeholder="Ingrese el número de cédula de la madre" class="form-control input-md">
                         <span class="help-block">Ej. 0558874415 </span>  
                      </div>
                      <label class="col-md-3 control-label" for="nombremadre_est"><b> Apellidos y Nombres: </b> </label>  
                      <div class="col-md-3">
                          <input value="<?php echo $estudiante->nombremadre_est; ?>" id="nombremadre_est" name="nombremadre_est" type="text"  placeholder="Ingrese los apellidos y nombres de la madre" class="form-control input-md">
                         <span class="help-block">Ej. Ortiz Bejarano Maria José 
                          </span>  
                      </div>
                    </div>
                    
                    
                    
                    
                    

 
                
                </div> <!-- col-md-6 -->
                
                
                
                <br><br>
                
                <div class="row">                   
                   <div class="col-md-12">
                        <!-- Button (Double) -->
                        <div class="form-group">                          
                          <div class="text-center">
                            <button id="" name="" class="btn btn-success" type="submit"> <i class="fa fa-save"> </i> &nbsp; Guardar</button>
                            &nbsp;
                            <a id="" name="" class="btn btn-default" href="<?php echo site_url('cursos/estudiantes').'/'.$periodo->codigo_per.'/'.$curso->codigo_cur; ?>"> <i class="fa fa-times"> </i> &nbsp; Cancelar</a>
                          </div>
                        </div>
                    </div>
                </div>
                     
                </fieldset>
                </form>
            </div>
        </section>
    </div>    
</div>






<script>
  
     $('#codigo_usu').val('<?php echo $estudiante->codigo_usu; ?>');
    
    
       
    $().ready(function(){
        $('#fechanacimiento_est').datepicker({
            changeYear: true,
            changeMonth: true,
            yearRange: '1990:2017', 
            maxDate: new Date
        });
    });
    
    
    
      var miValidador=$('#frm_estudiantes').validate({
        rules:{
            codigo_usu:{
                required:true
            },        
            cedula_est:{
                digits:true,
                required:true,
                remote:{
                    url:"<?php echo site_url('cursos/validarCedulaEstudiante'); ?>",
                    type:'post',
                    data:{
                        cedula_est:function(){                            
                            return $('#cedula_est').val();
                        },
                        codigo_cur:function(){
                            return $('#codigo_cur').val();
                        },
                        codigo_est:function(){
                             return $('#codigo_est').val();
                        }
                    },
                    /*complete:function(data)
                    {
                        alert(data.responseText);
                    }*/

                }
            },
            fechanacimiento_est:{
                required:true
            },
            nombre_est:{
                required:true,
                letras:true
            },
            direccion_est:{
                required:true
            },
            lugarnacimiento_est:{
                required:true
            },
            cedulapadre_est:{                
                digits:true
            },
            nombrepadre_est:{
                letras:true
            },
            cedulamadre_est:{                
                digits:true
            },
            nombremadre_est:{
                letras:true
            }                                
        },
        messages:{
            
            codigo_usu:{
                required:"Seleccione el representante"
            },    
             cedula_est:{
                digits:"Este campo solo acepta números",
                required:"Ingrese el númeo de cédula del estudiante",
                remote:"Esta cédula ya esta en uso"
            },
            fechanacimiento_est:{
                required:"Seleccione la fecha de nacimiento del estudiante"
            },
            nombre_est:{
                required:"Ingrese los apellidos y nombres del estudiante",
                letras:"Este campo solo acepta letras"
            },
            direccion_est:{
                required:"Ingrese la dirección del estudiante."
            },
            lugarnacimiento_est:{
                required:"Ingrese el lugar de nacimiento del estudiante"
            },
            cedulapadre_est:{                
                digits:"Este campo solo acepta números"
            },
            nombrepadre_est:{
                letras:"Este campo solo acepta letras"
            },
            cedulamadre_est:{                
                digits:"Este campo solo acepta números"
            },
            nombremadre_est:{
                letras:"Este campo solo acepta letras"
            }
            
        }
    });
  
</script>