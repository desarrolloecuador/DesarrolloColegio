 <script>    
    $("#menu_curso_<?php echo $curso->codigo_cur; ?>").addClass("active");    
</script>
  
<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header"><i class="fa fa-envelope"></i> Comunicados </h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?php echo site_url('/welcome/index'); ?>">Inicio</a></li>            
             <li><i class="fa fa-book"></i><a href="<?php echo site_url('/materias/materiasDocenteCurso').'/'.$curso->codigo_cur; ?>"> Materias | <?php echo $curso->nombre_cur.' "'.$curso->paralelo_cur.'" | '.$curso->seccion_cur; ?> </a></li>                              
            <li><i class="fa fa-book"></i><a href="<?php echo site_url('/estudiantes/listado').'/'.$curso->codigo_per.'/'.$curso->codigo_cur.'/'.$materia->codigo_mat; ?>"><?php echo $materia->nombre_mat; ?></a></li> 
            <li><i class="fa fa-envelope"></i><a href="<?php echo site_url('comunicados/listado').'/'.$curso->codigo_cur.'/'.$curso->codigo_per.'/'.$materia->codigo_mat; ?>">Comunicados</a></li>
            <li><i class="fa fa-list"> </i> <?php 
                                                if(strlen($comunicado->mensaje_com)<=20){
                                                    echo $comunicado->mensaje_com;         
                                                }else{
                                                    echo substr($comunicado->mensaje_com,0,20);         
                                                }
                                            

                                            ?> 
            </li> 
        </ol>
    </div>
</div>

  
 
<div class="panel miPanel">    
    <header class="panel-heading">        
            <b>Datos del Comunicado</b>        
    </header>
    
    <div class="panel panel-body">
        
            <table class="table table-bordered table-striped">
                <tr>
                    <th>FECHA:</th>
                    <td><?php echo $comunicado->fecha_com; ?></td>              
                </tr>
                <tr>
                    <th>OBSERVACIÓN:</th>
                    <td>
                        <?php echo $comunicado->mensaje_com; ?>
                    </td>
                </tr>
            </table>
                        
    </div>
</div>

<div class="panel miPanel">
    
    <header class="panel-heading">        
            <b>Destinatarios del Mensaje</b>        
    </header>
    
    <div class="panel panel-body">
    

                <?php if($comunicado){ ?>  

                    <form id="frm_comunicados" >                       
                         <table class="table-responsive table table-striped table-hover table-bordered tblBuscadorSinPaginador" style="font-size:12px;">
                             <thead>
                                 <tr>
                                     <th style="height:10px;">No.                                        
                                         <input type="hidden" name="codigo_cur" id="codigo_cur" value="<?php echo $curso->codigo_cur; ?>">
                                         <input type="hidden" name="codigo_com" id="codigo_com" value="<?php echo $comunicado->codigo_com; ?>">
                                         <input type="hidden" name="codigo_mat" id="codigo_mat" value="<?php echo $materia->codigo_mat; ?>">
                                         <input type="hidden" name="codigo_per" id="codigo_per" value="<?php echo $periodo->codigo_per; ?>"> 
                                     </th>
                                     <th>CÉDULA</th>
                                     <th>ESTUDIANTE</th>                                                                             
                                 </tr>
                             </thead>
                            <tfoot>                                                         
                                 <tr>
                                     <th>No.</th>
                                     <th>CÉDULA</th>
                                     <th>ESTUDIANTE</th>                                                                                  
                                 </tr>
                             </tfoot>
                             <tbody>
                                <?php $i=1; ?>                           
                                <?php foreach($estudiantes->result() as $estudiante){ ?>
                                     <tr>
                                         <td style="height:28px; padding-bottom:0px; padding-top: 5px;"><?php echo $i; ?></td>
                                         <td style="height:28px; padding-bottom:0px; padding-top: 5px;"><?php echo $estudiante->cedula_est; ?></td>
                                         <td style="height:28px; padding-bottom:0px; padding-top: 5px;"><?php echo $estudiante->nombre_est; ?></td>                                         
                                     </tr>
                                 <?php $i++; ?>
                                 

                                 <?php } ?>  
                          
                             </tbody>
                         </table>                         
                    </form>

                   
                    
                 

          <?php }else{ ?>
              <div class="alert alert-danger">
                  <i class="fa fa-exclamation-triangle"> </i> &nbsp; No se encontraron estudiantes registrados en este curso.
              </div>

          <?php } ?>

    </div>
</div>






