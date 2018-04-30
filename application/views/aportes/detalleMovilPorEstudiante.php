<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?php echo base_url('/assets/img/logo1.png'); ?>">

    <title>Unidad Educativa Fiscal Patria</title>

    <!-- Bootstrap CSS -->    
    <link href="<?php echo base_url('/assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <!-- bootstrap theme -->
    <link href="<?php echo base_url('/assets/css/bootstrap-theme.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('/assets/css/font-awesome.min.css'); ?>" rel="stylesheet">
 
	
    <!-- javascripts -->
    <script src="<?php echo base_url('/assets/js/jquery.js'); ?>"></script>
	<script src="<?php echo base_url('/assets/js/jquery-ui-1.10.4.min.js'); ?>"></script>
    <!--
    <script src="<?php echo base_url('/assets/js/jquery-1.8.3.min.js'); ?>"></script>
    -->
    <!--
    <script type="text/javascript" src="<?php echo base_url('/assets/js/jquery-ui-1.9.2.custom.min.js'); ?>"></script>
    -->
    <!-- bootstrap -->
    <script src="<?php echo base_url('/assets/js/bootstrap.min.js'); ?>"></script>
 
  </head>
  
 <body>
 
       
       
        <?php if($aportes && $tipos){ ?>
        
        
       <?php
                $promedios=array(); 

                foreach($tipos->result() as $tipo){ 
                    
                        $total=0;
                        $contador=0;
                    
                         foreach($aportes->result() as $aporte){ 
                                    
                                    if($tipo->codigo_tip==$aporte->codigo_tip){  
                                        $contador++;
                                        $total+=$aporte->calificacion_ca;
                                   } 
                             
                        }
                    
                        if($total>0 && $contador >0){
                            $promedios[$tipo->codigo_tip]=$total/$contador;   
                        }else{
                            $promedios[$tipo->codigo_tip]=0;   
                        }
                    
                }
     
        ?>
       
        
        
        
                <table class="table table-responsive table-striped table-bordered">
                    
                    <thead>
                        <tr style="font-size:10px;">
                            <?php foreach($tipos->result() as $tipo){ ?>                            
                                <th class="text-center"><label for="" class="rotate"><?php echo $tipo->nombre_tip; ?> <span class="badge" style="color:#555; font-size:10px;"><?php echo $tipo->porcentaje_tip; ?>%</span></label></th>                                
                            <?php } ?>
                                <th class="text-center"><label for="">Nota Final</label></th>
                        </tr>
                        
                        <tr>
                            
                            <?php foreach($tipos->result() as $tipo){ ?>         
                                <td class="text-center">
                                    <button type="button" class="btn btn-default btn-sm" 
                                            data-toggle="modal" data-target="#demo_<?php echo $tipo->codigo_tip; ?>">
                                            
                                          <b><?php echo number_format($promedios[$tipo->codigo_tip],2); ?></b>
                                            
                                          <i class="fa fa-plus-circle"> </i>
                                    </button>
       

                                    <div id="demo_<?php echo $tipo->codigo_tip; ?>" class="modal fade" role="dialog">
                                      
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

                                                                <?php if($tipo->codigo_tip==$aporte->codigo_tip){  ?>
                                                                    <tr>
                                                                        <td class="text-center"><?php echo $aporte->observacion_apo; ?></td>
                                                                        <td class="text-center"><?php echo $aporte->calificacion_ca; ?></td>
                                                                    </tr>                                                                    
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
                    </thead>

                </table>
        

                       
        
        <?php }else{ ?>
            
            <div class="alert alert-danger">
                
                <i class="fa fa-exclamation-triangle"> </i> <b>No se encontraron aportes para la materia y estudiante seleccionados</b>
                
            </div>
        
        <?php } ?>
        
        
       

 

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
 

     
     
</body>



</html>
 


