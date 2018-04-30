 <script>    
    $("#menu_curso_<?php echo $curso->codigo_cur; ?>").addClass("active");    
</script>
  

  <div class="row">
    <div class="col-lg-12">
        <h3 class="page-header"><i class="fa fa-list-ol"></i> Nómina </h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?php echo site_url('/welcome/index'); ?>">Inicio</a></li>            
             <li><i class="fa fa-book"></i><a href="<?php echo site_url('/materias/materiasDocenteCurso').'/'.$curso->codigo_cur; ?>"> Materias | <?php echo $curso->nombre_cur.' "'.$curso->paralelo_cur.'" | '.$curso->seccion_cur; ?> </a></li>                              
            <li><i class="fa fa-book"></i><?php echo $materia->nombre_mat; ?></li>   		  	
        </ol>
    </div>
</div>


<div class="row">
    <div class="col-md-12">
      
         <div class="table-responsive">
            <section class="panel miPanel" >

                  <header class="panel-heading">
                       <b>Nómina de Estudiantes | <?php echo $materia->nombre_mat; ?> | <?php echo $curso->nombre_cur; ?> "<?php echo $curso->paralelo_cur; ?>" </b>                                   
                  </header>

                  <div class="panel-body" >
                          <?php if($estudiantes){ ?>
                                    
                                     <div class="btn-group btn-group-justified">                                                                                 
                                             <a href="<?php echo site_url('/asistencias/listado').'/'.$curso->codigo_cur.'/'.$periodo->codigo_per.'/'.$materia->codigo_mat; ?>" class="btn  btn-default"><i class="fa fa-calendar"></i> &nbsp; Asistencia</a>                       
                                             <a href="<?php echo site_url('/aportes/listado').'/'.$curso->codigo_cur.'/'.$periodo->codigo_per.'/'.$materia->codigo_mat; ?>" class="btn  btn-default"><i class="fa fa-edit"></i> &nbsp; Aportes</a>                             
                                             <a href="<?php echo site_url('/disciplinas/listado').'/'.$curso->codigo_cur.'/'.$periodo->codigo_per.'/'.$materia->codigo_mat; ?>" class="btn  btn-default"><i class="fa fa-users"></i> &nbsp; Disciplina</a>                       
                                             <a href="<?php echo site_url('/comunicados/listado').'/'.$curso->codigo_cur.'/'.$periodo->codigo_per.'/'.$materia->codigo_mat; ?>" class="btn  btn-default"><i class="fa fa-envelope"></i> &nbsp; Comunicados</a>               
                                      </div>

                                     <table class="table-responsive table table-striped table-hover table-bordered tblBuscador" style="font-size:12px;">
                                         <thead>
                                             <tr>
                                                 <th>No.</th>
                                                 <th>CÉDULA</th>
                                                 <th>ESTUDIANTE</th>                  
                                                 <th>REPRESENTANTE</th>                                             
                                                 <th>TÉLEFONO</th>                                                                                              
                                             </tr>
                                         </thead>
                                        <tfoot>
                                             <tr>
                                                 <th>No.</th>
                                                 <th>CÉDULA</th>
                                                 <th>ESTUDIANTE</th>                  
                                                 <th>REPRESENTANTE</th>                                             
                                                 <th>TÉLEFONO</th>                                                                                             
                                             </tr>
                                         </tfoot>
                                         <tbody>
                                            <?php $i=1; ?>
                                            <?php foreach($estudiantes->result() as $estudiante){ ?>
                                             <tr>
                                                 <td><?php echo $i; ?></td>
                                                 <td><?php echo $estudiante->cedula_est; ?></td>
                                                 <td><?php echo $estudiante->nombre_est; ?></td>                                                         
                                                 <td><?php echo $estudiante->nombre_usu." ".$estudiante->apellido_usu; ?></td>
                                                 <td><?php echo $estudiante->telefono_usu; ?></td>                                               
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







