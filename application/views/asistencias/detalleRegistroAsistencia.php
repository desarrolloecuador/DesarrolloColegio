 <script>    
    $("#menu_curso_<?php echo $curso->codigo_cur; ?>").addClass("active");    
</script>
  
<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header"><i class="fa fa-calendar"></i> Asistencias </h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?php echo site_url('/welcome/index'); ?>">Inicio</a></li>            
             <li><i class="fa fa-book"></i><a href="<?php echo site_url('/materias/materiasDocenteCurso').'/'.$curso->codigo_cur; ?>"> Materias | <?php echo $curso->nombre_cur.' "'.$curso->paralelo_cur.'" | '.$curso->seccion_cur; ?> </a></li>                              
            <li><i class="fa fa-book"></i><a href="<?php echo site_url('/estudiantes/listado').'/'.$curso->codigo_per.'/'.$curso->codigo_cur.'/'.$materia->codigo_mat; ?>"><?php echo $materia->nombre_mat; ?></a></li> 
            <li><i class="fa fa-calendar"></i><a href="<?php echo site_url('asistencias/listado').'/'.$curso->codigo_cur.'/'.$curso->codigo_per.'/'.$materia->codigo_mat; ?>">Asistencias</a></li>
            <li><i class="fa fa-list"> </i> <?php echo $asistencia->fecha_asi.' | '.$asistencia->hora_asi; ?> </li> 
        </ol>
    </div>
</div>


<div class="panel miPanel">
    
    <header class="panel-heading">        
            <b>Registro de Asistencia de Estudiantes</b>        
    </header>
    
    <div class="panel panel-body">
    
                <?php if($estudiantes){ ?>  
                   
                                                                      
                    <form id="frm_registro_asistencias" action="<?php echo site_url('/asistencias/actualizarRegistroAsistencias'); ?>" method="post">                                              
                         <table class="table-responsive table table-striped table-hover table-bordered tblBuscadorSinPaginador" style="font-size:12px;">
                             <thead>
                                 <tr>
                                     <th style="height:10px;">No.                                        
                                         <input type="hidden" name="codigo_cur" id="codigo_cur" value="<?php echo $curso->codigo_cur; ?>">
                                         <input type="hidden" name="codigo_asi" id="codigo_asi" value="<?php echo $asistencia->codigo_asi; ?>">
                                         <input type="hidden" name="codigo_mat" id="codigo_mat" value="<?php echo $materia->codigo_mat; ?>">
                                         <input type="hidden" name="codigo_per" id="codigo_per" value="<?php echo $periodo->codigo_per; ?>"> 
                                     </th>
                                     <th>CÉDULA</th>
                                     <th>ESTUDIANTE</th>   
                                     <th class="text-center">ESTADO</th>               
                                     <th>OPCIONES</th>                                                                                     
                                 </tr>
                             </thead>
                            <tfoot>                                                         
                                 <tr>
                                     <th>No.</th>
                                     <th>CÉDULA</th>
                                     <th>ESTUDIANTE</th>  
                                     <th class="text-center">ESTADO</th>                
                                     <td></td>                                             
                                 </tr>
                             </tfoot>
                             <tbody>
                                <?php $i=1; ?>
                                <?php foreach($estudiantes->result() as $estudiante){ ?>
                                 <tr>
                                     <td style="height:28px; padding-bottom:0px; padding-top: 5px;"><?php echo $i; ?></td>
                                     <td style="height:28px; padding-bottom:0px; padding-top: 5px;"><?php echo $estudiante->cedula_est; ?></td>
                                     <td style="height:28px; padding-bottom:0px; padding-top: 5px;"><?php echo $estudiante->nombre_est; ?></td> 
                                     <td style="height:28px; padding-bottom:0px; padding-top: 5px;" class="text-center">

                                         <?php if($estudiante->estado_ra==0){ ?>
                                             <label for="" class="label label-primary col-sm-12" style="font-size:12px;">No Asignado</label>
                                         <?php } ?>
                                         
                                         <?php if($estudiante->estado_ra==1){ ?>
                                             <label for="" class="label label-success" style="font-size:12px;">A. Normal</label>
                                         <?php } ?>
                                         
                                         <?php if($estudiante->estado_ra==2){ ?>
                                             <label for="" class="label label-info" style="font-size:12px;">Atraso</label>
                                         <?php } ?>
                                         
                                         <?php if($estudiante->estado_ra==3){ ?>
                                             <label for="" class="label label-warning" style="font-size:12px;">Falta</label>
                                         <?php } ?>
                                         
                                         <?php if($estudiante->estado_ra==4){ ?>
                                             <label for="" class="label label-danger" style="font-size:12px;">Fuga</label>
                                         <?php } ?>

                                     </td>                                                         
                                     <td style="height:28px; padding-bottom:0px; padding-top: 5px;" >
                                        <input type="hidden" name="codigo_ra[]" value="<?php echo $estudiante->codigo_ra; ?>">
                                         <select name="estado_ra[]" id="estado_ra_<?php echo $estudiante->codigo_ra; ?>" class="form-control" style="padding:0px; font-size:13px; height:25px;">                                     
                                             <option value="1">Asistencia Normal</option>
                                             <option value="2">Atraso</option>
                                             <option value="3">Falta</option>
                                             <option value="4">Fuga</option>
                                         </select>

                                     </td>   
                                 </tr>
                                 <?php $i++; ?>
                                 

                                 <?php } ?>  

                                <tr>
                                     <td><span style="display:none;">100000</span></td>
                                     <td></td>
                                     <td></td>
                                     <td><b>CONFIRMACIÓN:</b></td>
                                     <td> <button class="btn btn-primary btn-block" type="submit"> <i class="fa fa-save"> </i> Guardar Registro </button> </td>
                                 </tr>                           
                             </tbody>
                         </table>
                    </form>
                    
                    
                    <script>
                          <?php foreach($estudiantes->result() as $estudiante){ ?>
                                if('<?php echo $estudiante->estado_ra; ?>' != '0'){
                                    $('#estado_ra_<?php echo $estudiante->codigo_ra; ?>').val('<?php echo $estudiante->estado_ra; ?>');
                                }
                            
                          <?php } ?>
        
                    </script>
                    
                 

          <?php }else{ ?>
              <div class="alert alert-danger">
                  <i class="fa fa-exclamation-triangle"> </i> &nbsp; No se encontraron estudiantes registrados en este curso.
              </div>

          <?php } ?>

    </div>
</div>






