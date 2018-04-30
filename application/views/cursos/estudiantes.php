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
            <li><i class="fa fa-users"></i>Estudiantes | <?php echo $curso->nombre_cur; ?> "<?php echo $curso->paralelo_cur; ?>" | Periodo <?php echo $periodo->nombre_per; ?></li>						  	
        </ol>
    </div>
</div>


<div class="row">
    <div class="col-md-12">
      
      
        <section class="panel miPanelCerrado" >
              <header class="panel-heading">
                   <b>Cargar Estudiantes | <?php echo $curso->nombre_cur; ?> "<?php echo $curso->paralelo_cur; ?>" - Periodo <?php echo $periodo->nombre_per; ?> </b>
                  
                  
                   
                    
              </header>
              <div class="panel-body collapse in" id="cargaEstudiantes" >
               <form class="form-horizontal" method="post" action="<?php echo site_url("/cursos/leerArchivo"); ?>" enctype="multipart/form-data">
                <fieldset>

                <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="nombre_mat"><b> Seleccione el Archivo: </b> </label>  
                  <div class="col-md-5">
                  <input id="archivo" name="archivo" type="file" required  class="form-control input-md" accept=".csv">
                  <span class="help-block">Nota: El archivo debe estar en formato CSV. &nbsp; <a href="<?php echo base_url("/uploads/archivos/plantilla_estudiantes.csv");?>" download="plantilla_estudiantes.csv" style="text-decoration: underline;"> Descargar Plantilla</a></span>  
                  </div>
                </div>
                
                
                
        
                
                <input type="hidden" name="codigo_cur" value="<?php echo $curso->codigo_cur; ?>" id="codigo_cur">
                 <input type="hidden" name="codigo_per" value="<?php echo $periodo->codigo_per; ?>">

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
      
      
        <section class="panel miPanelCerrado">
              <header class="panel-heading">
                   <b>Nuevo Estudiante</b>
          
              </header>
              <div class="panel-body collapse in" id="nuevoEstudiante">
               <form id="frm_estudiantes" class="form-horizontal" method="post" action="<?php echo site_url("cursos/guardarEstudiante"); ?>">
                <fieldset>
                
                
                     <!-- Text input-->
                    <div class="form-group">
                      <label class="col-md-12 text-center" for="cedula_est"><b style="font-size: 20px;"> <br> 1. Representante<br></b>  </label>      
                                
                    </div>

              

                     <!-- Text input-->
                    <div class="form-group">
                      <label class="col-md-2 control-label" for="cedula_usu"><b> Representante: </b> </label>  
                      <div class="col-md-9">
                              <select name="codigo_usu" id="codigo_usu" class="form-control selectpicker input-xs" data-live-search="true" title="--Seleccione un representante--">
                                  <?php if($representantes){ ?>
                                      
                                         <?php foreach($representantes->result() as $representante){ ?>
                                             
                                                 <option value="<?php echo $representante->codigo_usu; ?>" data-subtext="| <?php echo $representante->cedula_usu; ?>"><?php echo $representante->nombre_usu; ?></option>
                                         
                                          <?php }  ?>        
                                  
                                  <?php }  ?>
                                  
                                  
                                  
                              </select>
                              <br> <br>
                              
                              <a href="<?php echo site_url('representantes/index'); ?>" style="text-decoration:underline;"> <i class="fa fa-plus-circle"> </i> Registrar Representante</a>
                              
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
                                  <input id="cedula_est" name="cedula_est" type="text" placeholder="Ingrese el número de cédula del estudiante" class="form-control input-xs">
                                  <span class="help-block">Ej. 1725663254</span>  
                          </div>
                          <label class="col-md-3 control-label" for="fechanacimiento_est"><b> Fecha de Nacimiento: </b> </label>  
                          <div class="col-md-3">
                              <input id="fechanacimiento_est" name="fechanacimiento_est" type="text" required placeholder="Seleccione la fecha de nacimiento" class="form-control input-md">
                              <span class="help-block">Ej.1999-08-26</span>  
                          </div>
                                                  
                        </div>

 

                          <!-- Text input-->
                        <div class="form-group">                          
                              <label class="col-md-2 control-label" for="nombre_est"><b> Apellidos y Nombres: </b> </label>  
                              <div class="col-md-9">
                                      <input id="nombre_est" name="nombre_est" type="text" required placeholder="Ingrese los apellidos y nombres completos del estudiante" class="form-control input-md">
                                      <span class="help-block">Ej. Juan Carlos</span>  
                              </div>                          
                        </div>



                           <!-- Text input-->
                        <div class="form-group">
                          <label class="col-md-2 control-label" for="direccion_est"><b> Dirección: </b> </label>  
                          <div class="col-md-3">
                              <textarea id="direccion_est" name="direccion_est" type="text" required placeholder="Ingrese la dirección domiciliaria del estudiante" class="form-control input-md"></textarea>
                              <span class="help-block">Ej. Latacunga, Av. Antonia Vela #123</span>  
                          </div>
                          <label class="col-md-3 control-label" for="lugarnacimiento_est"><b> Lugar de Nacimiento: </b> </label>  
                          <div class="col-md-3">
                                  <textarea id="lugarnacimiento_est" name="lugarnacimiento_est" type="text" required placeholder="Ingrese el lugar de nacimiento del estudiante" class="form-control input-md"></textarea>
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
                          <input id="cedulapadre_est" name="cedulapadre_est" type="text"  placeholder="Ingrese el número de cédula del padre" class="form-control input-md">
                         <span class="help-block">Ej. 0558874415 </span>  
                      </div>
                      <label class="col-md-3 control-label" for="nombrepadre_est"><b> Apellidos y Nombres: </b> </label>  
                      <div class="col-md-3">
                          <input id="nombrepadre_est" name="nombrepadre_est" type="text"  placeholder="Ingrese los apellidos y nombres del padre" class="form-control input-md">
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
                          <input id="cedulamadre_est" name="cedulamadre_est" type="text"  placeholder="Ingrese el número de cédula de la madre" class="form-control input-md">
                         <span class="help-block">Ej. 0558874415 </span>  
                      </div>
                      <label class="col-md-3 control-label" for="nombremadre_est"><b> Apellidos y Nombres: </b> </label>  
                      <div class="col-md-3">
                          <input id="nombremadre_est" name="nombremadre_est" type="text"  placeholder="Ingrese los apellidos y nombres de la madre" class="form-control input-md">
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
                            <button id="" name="" class="btn btn-default" type="button" onclick="resetear();"> <i class="fa fa-times"> </i> &nbsp; Cancelar</button>
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


<div class="row">
    <div class="col-md-12">
      
         <div class="table-responsive">
        <section class="panel miPanel" >
              <header class="panel-heading">
                   <b>Nómina de Estudiantes | <?php echo $curso->nombre_cur; ?> "<?php echo $curso->paralelo_cur; ?>" | Periodo <?php echo $periodo->nombre_per; ?> </b>                                   
              </header>
              
              <div class="panel-body" >
                      <?php if($estudiantes){ ?>
                          
                                 <table class="table-responsive table table-striped table-hover table-bordered tblBuscador" style="font-size:12px;">
                                     <thead>
                                         <tr>
                                             <th>No.</th>
                                             <th>CÉDULA</th>
                                             <th>ESTUDIANTE</th>                                                                                     
                                             <th>PADRE</th>
                                             <th>C.I</th>
                                             <th>MADRE</th>
                                             <th>C.I</th>
                                             <th>REPRESENTANTE</th>
                                             <th>C.I</th>
                                             <th>TÉLEFONO</th>                                             
                                             <th>OPCIONES</th>
                                         </tr>
                                     </thead>
                                     <tfoot>
                                         <tr>
                                             <td></td>
                                             <th>CÉDULA</th>
                                             <th>ESTUDIANTE</th>                                                                                     
                                             <th>PADRE</th>
                                             <th>C.I</th>
                                             <th>MADRE</th>
                                             <th>C.I</th>
                                             <th>REPRESENTANTE</th>
                                             <th>C.I</th>
                                             <th>TÉLEFONO</th>                                             
                                             <td></td>
                                         </tr>
                                     </tfoot>
                                     <tbody>
                                        <?php $i=1; ?>
                                        <?php foreach($estudiantes->result() as $estudiante){ ?>
                                         <tr>
                                             <td><?php echo $i; ?></td>
                                             <td><?php echo $estudiante->cedula_est; ?></td>
                                             <td><?php echo $estudiante->nombre_est; ?></td>            
                                             <td><?php echo $estudiante->nombrepadre_est; ?></td>
                                             <td><?php echo $estudiante->cedulapadre_est; ?></td>
                                             <td><?php echo $estudiante->nombremadre_est; ?></td>
                                             <td><?php echo $estudiante->cedulamadre_est ?></td>
                                             <td><?php echo $estudiante->nombre_usu." ".$estudiante->apellido_usu; ?></td>
                                             <td><?php echo $estudiante->cedula_usu; ?></td>
                                             <td><?php echo $estudiante->telefono_usu; ?></td>
                                             <td>                                                 
                                                 <a href="<?php echo site_url('cursos/editarEstudiante').'/'.$periodo->codigo_per.'/'.$curso->codigo_cur.'/'.$estudiante->codigo_est; ?>" class="btn btn-default"><i class="fa fa-pencil"></i></a>
                                                 <a href="#" class="btn btn-default"><i class="fa fa-trash-o"></i></a>
                                             </td>
                                         </tr>
                                         <?php $i++; ?>
                                         <?php } ?>
                                     </tbody>
                                     
                                 </table>
                                 
                                                
                      <?php }else{ ?>
                          <div class="alert alert-danger">
                              <i class="fa fa-exclamation-triangle"> </i> &nbsp; No se encontraron estudiantes registrados en este curso.
                          </div>
                      
                      <?php } ?>
            </div>
        </section>
        </div>  
    </div>    
</div>











<script>
    
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
                    url:"<?php echo site_url('cursos/validarCedulaEstudianteNuevo'); ?>",
                    type:'post',
                    data:{
                        cedula_est:function(){                            
                            return $('#cedula_est').val();
                        },
                        codigo_cur:function(){
                            return $('#codigo_cur').val();
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