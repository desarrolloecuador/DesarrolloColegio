 <script>    
    $("#menu_curso_<?php echo $curso->codigo_cur; ?>").addClass("active");    
</script>
  
<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header"><i class="fa fa-users"></i> Disciplinas </h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?php echo site_url('/welcome/index'); ?>">Inicio</a></li>            
             <li><i class="fa fa-book"></i><a href="<?php echo site_url('/materias/materiasDocenteCurso').'/'.$curso->codigo_cur; ?>"> Materias | <?php echo $curso->nombre_cur.' "'.$curso->paralelo_cur.'" | '.$curso->seccion_cur; ?> </a></li>                              
            <li><i class="fa fa-book"></i><a href="<?php echo site_url('/estudiantes/listado').'/'.$curso->codigo_per.'/'.$curso->codigo_cur.'/'.$materia->codigo_mat; ?>"><?php echo $materia->nombre_mat; ?></a></li> 
            <li><i class="fa fa-users"></i><a href="<?php echo site_url('disciplinas/listado').'/'.$curso->codigo_cur.'/'.$curso->codigo_per.'/'.$materia->codigo_mat; ?>">Disciplina</a></li>
            <li><i class="fa fa-list"> </i> <?php 
                                                if(strlen($disciplina->observacion_dis)<=20){
                                                    echo $disciplina->observacion_dis;         
                                                }else{
                                                    echo substr($disciplina->observacion_dis,0,20);         
                                                }
                                            

                                            ?> 
            </li> 
        </ol>
    </div>
</div>

  
 
<div class="panel miPanel">    
    <header class="panel-heading">        
            <b>Datos del Registro de Disciplina</b>        
    </header>
    
    <div class="panel panel-body">
        
            <table class="table table-bordered table-striped">
                <tr>
                    <th>FECHA:</th>
                    <td><?php echo $disciplina->fecha_dis; ?></td>              
                </tr>
                <tr>
                    <th>OBSERVACIÓN:</th>
                    <td>
                        <?php echo $disciplina->observacion_dis; ?>
                    </td>
                </tr>
            </table>
                        
    </div>
</div>

<div class="panel miPanel">
    
    <header class="panel-heading">        
            <b>Calificación de Disciplina</b>        
    </header>
    
    <div class="panel panel-body">
    

                <?php if($disciplina){ ?>  

                    <form id="frm_disciplinas" action="<?php echo site_url('/disciplinas/actualizarCalificacionDisciplina'); ?>" method="post">                       
                         <table class="table-responsive table table-striped table-hover table-bordered tblBuscadorSinPaginador" style="font-size:12px;">
                             <thead>
                                 <tr>
                                     <th style="height:10px;">No.                                        
                                         <input type="hidden" name="codigo_cur" id="codigo_cur" value="<?php echo $curso->codigo_cur; ?>">
                                         <input type="hidden" name="codigo_dis" id="codigo_dis" value="<?php echo $disciplina->codigo_dis; ?>">
                                         <input type="hidden" name="codigo_mat" id="codigo_mat" value="<?php echo $materia->codigo_mat; ?>">
                                         <input type="hidden" name="codigo_per" id="codigo_per" value="<?php echo $periodo->codigo_per; ?>"> 
                                     </th>
                                     <th>CÉDULA</th>
                                     <th>ESTUDIANTE</th>   
                                     <th class="text-center">NOTA</th>               
                                     <th>OPCIONES</th>                                                                                     
                                 </tr>
                             </thead>
                            <tfoot>                                                         
                                 <tr>
                                     <th>No.</th>
                                     <th>CÉDULA</th>
                                     <th>ESTUDIANTE</th>  
                                     <th class="text-center">NOTA</th>                
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
                                         <td style="height:28px; padding-bottom:0px; padding-top: 5px; width:80px;" class="text-center">       
                                            <center>
                                               
                                               <select name="calificacion_cd_<?php echo $estudiante->codigo_cd; ?>" id="calificacion_cd_<?php echo $estudiante->codigo_cd; ?>" class="form-control" required>
                                                   <option value="">--Seleccione--</option>
                                                   
                                                   <?php if($estudiante->calificacion_cd!='A'){ ?>
                                                       <option value="A">A</option>
                                                   <?php }else{ ?>
                                                       <option value="A" selected>A</option>
                                                   <?php } ?>
                                                   
                                                   <?php if($estudiante->calificacion_cd!='B'){ ?>
                                                       <option value="B">B</option>
                                                   <?php }else{ ?>
                                                       <option value="B" selected>B</option>
                                                   <?php } ?>
                                                   
                                                   
                                                   <?php if($estudiante->calificacion_cd!='C'){ ?>
                                                       <option value="C">C</option>
                                                   <?php }else{ ?>
                                                       <option value="C" selected>C</option>
                                                   <?php } ?>
                                                   
                                                   
                                                   <?php if($estudiante->calificacion_cd!='D'){ ?>
                                                       <option value="D">D</option>
                                                   <?php }else{ ?>
                                                       <option value="D" selected>D</option>
                                                   <?php } ?>
                                                   
                                                   
                                                   <?php if($estudiante->calificacion_cd!='E'){ ?>
                                                       <option value="E">E</option>
                                                   <?php }else{ ?>
                                                       <option value="E" selected>E</option>
                                                   <?php } ?>
                                           
                                               </select>
                                               
                                               <!--
                                                <input type="text" name="calificacion_cd_<?php echo $estudiante->codigo_cd; ?>" value="<?php echo $estudiante->calificacion_cd; ?>" class="form-control notas" style="padding:0px; font-size:13px; height:25px; width:80px;" required />
                                                -->
                                                
                                            </center>
                                         </td>                                                         
                                         <td style="height:28px; padding-bottom:0px; padding-top: 5px;" >
                                            <input type="hidden" name="codigo_cd[]" value="<?php echo $estudiante->codigo_cd; ?>" >
                                             <input name="observacion_cd[]" id="observacion_cd_<?php echo $estudiante->codigo_cd; ?>" class="form-control" style="padding:0px; font-size:13px; height:25px;"  placeholder="Ingrese la observación" value="<?php echo $estudiante->observacion_cd; ?>"/>
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
                        
                        jQuery.validator.addMethod("nota", function(value, element) {
                          return value<=10 && value>=0 ;
                        }, "La nota ingresada es incorrecta.");

                        
                        $("#frm_disciplinas").validate({
                            
                          rules:{
                                <?php foreach($estudiantes->result() as $estudiante){ ?>
                                    calificacion_cd_<?php echo $estudiante->codigo_cd; ?>:{
                                            required:true                                            
                                            
                                        },
                                <?php } ?>  
                          },
                            
                         messages:{
                                <?php foreach($estudiantes->result() as $estudiante){ ?>
                                    calificacion_cd_<?php echo $estudiante->codigo_cd; ?>:{
                                            required:"Seleccione la calificación"
                                        },
                                <?php } ?>  
                          }
                            
                        });
                        
                    </script>
            
                    
            
                    
                 

          <?php }else{ ?>
              <div class="alert alert-danger">
                  <i class="fa fa-exclamation-triangle"> </i> &nbsp; No se encontraron estudiantes registrados en este curso.
              </div>

          <?php } ?>

    </div>
</div>






