 <script>    
    $("#menu_curso_<?php echo $curso->codigo_cur; ?>").addClass("active");    
</script>
  
<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header"><i class="fa fa-edit"></i> Aportes </h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?php echo site_url('/welcome/index'); ?>">Inicio</a></li>            
             <li><i class="fa fa-book"></i><a href="<?php echo site_url('/materias/materiasDocenteCurso').'/'.$curso->codigo_cur; ?>"> Materias | <?php echo $curso->nombre_cur.' "'.$curso->paralelo_cur.'" | '.$curso->seccion_cur; ?> </a></li>                              
            <li><i class="fa fa-book"></i><a href="<?php echo site_url('/estudiantes/listado').'/'.$curso->codigo_per.'/'.$curso->codigo_cur.'/'.$materia->codigo_mat; ?>"><?php echo $materia->nombre_mat; ?></a></li> 
            <li><i class="fa fa-calendar"></i><a href="<?php echo site_url('aportes/listado').'/'.$curso->codigo_cur.'/'.$curso->codigo_per.'/'.$materia->codigo_mat; ?>">Aportes</a></li>
            <li><i class="fa fa-list"> </i> <?php 
                                                if(strlen($aporte->observacion_apo)<=20){
                                                    echo $aporte->observacion_apo;         
                                                }else{
                                                    echo substr($aporte->observacion_apo,0,20);         
                                                }
                                            

                                            ?> 
            </li> 
        </ol>
    </div>
</div>

  
 
<div class="panel miPanel">    
    <header class="panel-heading">        
            <b>Datos del Aporte</b>        
    </header>
    
    <div class="panel panel-body">
        
            <table class="table table-bordered table-striped">
                <tr>
                    <th>FECHA DE ENVIO:</th>
                    <td><?php echo $aporte->fechaenvio_apo; ?></td>
                    <th>FECHA DE ENTREGA:</th>
                    <td><?php echo $aporte->fechaentrega_apo; ?></td>
                </tr>
                <tr>
                    <th>DESCRIPCIÓN:</th>
                    <td>
                        <?php echo $aporte->observacion_apo; ?>
                    </td>
                    <th>TIPO:</th>
                    <td><?php echo $aporte->nombre_tip; ?> | <?php echo $aporte->porcentaje_tip; ?>%</td>
                </tr>
            </table>
                        
    </div>
</div>

<div class="panel miPanel">
    
    <header class="panel-heading">        
            <b>Calificación del Aporte</b>        
    </header>
    
    <div class="panel panel-body">
    
    
    
                <?php if($estudiantes){ ?>  
                  
                   
            
                    <form id="frm_aportes" action="<?php echo site_url('/aportes/actualizarCalificacionAporte'); ?>" method="post">                                              
                         <table class="table-responsive table table-striped table-hover table-bordered tblBuscadorSinPaginador" style="font-size:12px;">
                             <thead>
                                 <tr>
                                     <th style="height:10px;">No.                                        
                                         <input type="hidden" name="codigo_cur" id="codigo_cur" value="<?php echo $curso->codigo_cur; ?>">
                                         <input type="hidden" name="codigo_apo" id="codigo_apo" value="<?php echo $aporte->codigo_apo; ?>">
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
                                        <center><input type="text" name="calificacion_ca_<?php echo $estudiante->codigo_ca; ?>" value="<?php echo $estudiante->calificacion_ca; ?>" class="form-control notas" style="padding:0px; font-size:13px; height:25px; width:80px;" required /></center>
                                     </td>                                                         
                                     <td style="height:28px; padding-bottom:0px; padding-top: 5px;" >
                                        <input type="hidden" name="codigo_ca[]" value="<?php echo $estudiante->codigo_ca; ?>" >
                                         <input name="observacion_ca[]" id="observacion_ca_<?php echo $estudiante->codigo_ca; ?>" class="form-control" style="padding:0px; font-size:13px; height:25px;"  placeholder="Ingrese la observación" value="<?php echo $estudiante->observacion_ca; ?>"/>
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
                        
        
                        $("#frm_aportes").validate({
                            
                          rules:{
                                <?php foreach($estudiantes->result() as $estudiante){ ?>
                                    calificacion_ca_<?php echo $estudiante->codigo_ca; ?>:{
                                            required:true,
                                            nota:true
                                            
                                        },
                                <?php } ?>  
                          },
                            
                         messages:{
                                <?php foreach($estudiantes->result() as $estudiante){ ?>
                                    calificacion_ca_<?php echo $estudiante->codigo_ca; ?>:{
                                            required:"Ingrese la calificación"
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






