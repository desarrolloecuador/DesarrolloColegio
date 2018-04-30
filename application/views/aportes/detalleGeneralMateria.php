 <script>    
    $("#menu_curso_<?php echo $curso->codigo_cur; ?>").addClass("active");    
</script>
  
<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header"><i class="fa fa-list-ol"></i> Promedios <?php echo $materia->nombre_mat; ?>  </h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?php echo site_url('/welcome/index'); ?>">Inicio</a></li>            
             <li><i class="fa fa-book"></i><a href="<?php echo site_url('/materias/materiasDocenteCurso').'/'.$curso->codigo_cur; ?>"> Materias | <?php echo $curso->nombre_cur.' "'.$curso->paralelo_cur.'" | '.$curso->seccion_cur; ?> </a></li>                              
            <li><i class="fa fa-book"></i><a href="<?php echo site_url('/estudiantes/listado').'/'.$curso->codigo_per.'/'.$curso->codigo_cur.'/'.$materia->codigo_mat; ?>"><?php echo $materia->nombre_mat; ?></a></li> 
             <li><i class="fa fa-edit"></i><a href="<?php echo site_url('/aportes/listado').'/'.$curso->codigo_cur.'/'.$curso->codigo_per.'/'.$materia->codigo_mat; ?>">Aportes</a></li> 
            <li><i class="fa fa-list-ol"></i>Promedios</li> 

        </ol>
    </div>
</div>
       
       <div class="panel miPanel">
    
            <header class="panel-heading">        
                    <b>Promedios | <?php echo $curso->nombre_cur.' "'.$curso->paralelo_cur.'" | '.$curso->seccion_cur; ?>  <?php echo $materia->nombre_mat; ?> |  Quimestre:  <?php echo $quimestre_apo; ?> </b>        
            </header>

            <div class="panel panel-body">
       
        <?php if($aportes && $tipos){ ?>
        
                <table class="table table-responsive table-striped table-bordered">
                    
                    <thead>
                        <tr >
                             <th class="text-center"><label for="">No.</label></th>
                             <th class="text-center"><label>Estudiante</label></th>
                            <?php foreach($tipos->result() as $tipo){ ?>                            
                                <th class="text-center"><label for="" class="rotate"><?php echo $tipo->nombre_tip; ?> <span class="badge" style="color:#555; font-size:10px;"><?php echo $tipo->porcentaje_tip; ?>%</span></label></th>                                
                            <?php } ?>
                                <th class="text-center"><label for="">Nota Final</label></th>
                        </tr>
                </thead>
                       
            <tbody>     <?php $i=1; ?>
                        <?php foreach($estudiantes->result() as $estudiante){ ?>
                        <tr>
                          
                          <td class="text-center"><?php echo $i; $i++; ?></td>
                          <td class="text-center"><?php echo $estudiante->nombre_est; ?></td>
                           
                            <?php
                                    $promedios=array(); 

                                    foreach($tipos->result() as $tipo){ 

                                            $total=0;
                                            $contador=0;

                                             foreach($aportes->result() as $aporte){ 

                                                        if($aporte->codigo_est==$estudiante->codigo_est){ 
                                                            if($tipo->codigo_tip==$aporte->codigo_tip){  
                                                                $contador++;
                                                                $total+=$aporte->calificacion_ca;
                                                            } 
                                                        }

                                            }

                                            if($total>0 && $contador >0){
                                                $promedios[$tipo->codigo_tip]=$total/$contador;   
                                            }else{
                                                $promedios[$tipo->codigo_tip]=0;   
                                            }

                                    }

                            ?>
                           
                            
                            <?php foreach($tipos->result() as $tipo){ ?>         
                                <td class="text-center">
                                    <button type="button" class="btn btn-default btn-sm" 
                                            data-toggle="modal" data-target="#demo_<?php echo $tipo->codigo_tip; ?>_<?php echo $estudiante->codigo_est; ?>">
                                            
                                          <b><?php echo number_format($promedios[$tipo->codigo_tip],2); ?></b>
                                            
                                          <i class="fa fa-plus-circle"> </i>
                                    </button>
       

                                    <div id="demo_<?php echo $tipo->codigo_tip; ?>_<?php echo $estudiante->codigo_est; ?>" class="modal fade" role="dialog">
                                      
                                        <div class="modal-dialog">

                                            <!-- Modal content-->
                                            <div class="modal-content">
                                              <div class="modal-header" style="padding:5px;">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title" style="font-size:14px;"><b>Detalles de <?php echo $tipo->nombre_tip; ?></b></h4>
                                              </div>
                                              <div class="modal-body" style="padding:5px;">


                                                    <table class="table table-bordered" style="font-size:11px;">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center">Observación</th>
                                                                <th class="text-center">Calificación</th>                                                             
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            
                                                             <?php foreach($aportes->result() as $aporte){ ?>  
                                                                <?php if($aporte->codigo_est==$estudiante->codigo_est){  ?>
                                                                <?php if($tipo->codigo_tip==$aporte->codigo_tip){  ?>
                                                                    <tr>
                                                                        <td class="text-center"><?php echo $aporte->observacion_apo; ?></td>
                                                                        <td class="text-center"><?php echo $aporte->calificacion_ca; ?></td>
                                                                    </tr>                                                                    
                                                                <?php } ?>
                                                                <?php } ?>
                                                            <?php } ?>
                                                        </tbody>
                                                     </table>

                                                     </div>
                                                  <div class="modal-footer" style="padding:5px;">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Aceptar</button>
                                                  </div>
                                                </div>
                                            </div>
                                        </div>
                                </td>
                            <?php } ?>
                            <td>
                               
                                <button type="button" class="btn btn-default btn-sm" disabled style="font-weight:bold; margin-top:5px;" >
                                   
                                    <?php
                                     
                                        $total=0;
                           
                                        foreach($tipos->result() as $tipo){                                            
                                            if($promedios[$tipo->codigo_tip]>0){                                                
                                                $total+=$promedios[$tipo->codigo_tip]*$tipo->porcentaje_tip/100;                                               
                                            }
                                        }
                                    
                                        if($total>0){
                                            echo number_format($total,2);   
                                        }else{
                                            echo 0;   
                                        }
                                     
                                    ?>
                                
                                </button>                                                                
                            </td>
                            
                            
                        </tr>
                        
                        <?php } ?>
                </tbody>

                </table>
        

                       
        
        <?php }else{ ?>
            
            <div class="alert alert-danger">
                
                <i class="fa fa-exclamation-triangle"> </i> <b>No se encontraron aportes para la materia y estudiante seleccionados</b>
                
            </div>
        
        <?php } ?>
        
        </div>
</div>
       
       
        
        
       

 

     <style>
        
         
         .notasCollapse {
            -webkit-transition: width 2s ease;
            -moz-transition: width 2s ease;
            -o-transition: width 2s ease;
            transition: width 2s ease;

            display: inline-block;
            overflow: hidden;
            white-space: nowrap;
            background: gray;
            vertical-align: middle;
            line-height: 30px;
            height: 50px;            
            padding-top: 10px;
            width: 0px;
        }
        .notasCollapse.in {
            padding-right: 5px;
            padding-left:5px;
            width: auto;
        }

         
     </style>   
     
       
     <script>
         
        $("[data-toggle='toggle']").click(function() {
            var selector = $(this).data("target");
            $(selector).toggleClass('in');
        });
         
     </script>  
 

     
 

