<script>

    $('#menu_curso_<?php echo $curso->codigo_cur; ?>').addClass('active');
    
</script>


  

  <div class="row">
    <div class="col-lg-12">
        <h3 class="page-header"><i class="fa fa-book"></i> <?php echo $curso->nombre_cur.' "'.$curso->paralelo_cur.'"'.' | '.$curso->seccion_cur; ?> </h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?php echo site_url('/welcome/index'); ?>">Inicio</a></li>
            <li><i class="fa fa-book"></i>Materias | <?php echo $curso->nombre_cur.' "'.$curso->paralelo_cur.'" | '.$curso->seccion_cur; ?></li>            
       				  	
        </ol>
    </div>
</div>


<div class="row">
    <div class="col-md-12">
      
         <div class="table-responsive">
        <section class="panel miPanel" >
              <header class="panel-heading">
                   <b>Listado de Materias</b>                                   
              </header>
              
              <div class="panel-body" >
                     
                    
                      <?php if($materias){  ?>

                            <table class="table table-hover table-striped tblBuscador">
                               <thead>
                                    <tr>
                                        <th class="text-center">No.</th>
                                        <th class="text-center">Nombre</th>
                                        <th class="text-center">Opciones</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nombre</th>
                                        <td></td>
                                    </tr>
                                </tfoot>
                                <tbody>
                                   
                                   <?php $i=0; ?>
                                   <?php foreach($materias->result() as $materia){ ?>
                                   <?php $i++; ?>
                                    <tr>
                                        <td class="text-center"><?php echo $i; ?></td>
                                        <td class="text-center"><?php echo $materia->nombre_mat; ?></td>                                        
                                        <td class="text-center"> <a href="<?php echo site_url('/estudiantes/listado').'/'.$this->session->userdata('comil_codigo_per').'/'.$curso->codigo_cur.'/'.$materia->codigo_mat; ?>" class="btn btn-default"> <i class="fa fa-eye"> </i>  Ver Nómina</a> </td>
                                    </tr>
                                    <?php } ?>
                                    
                                </tbody>
                                
                                
                                
                            </table>
                                    
                                               
                                               
                                                
                      <?php }else{ ?>
                          <div class="alert alert-danger">
                              <i class="fa fa-exclamation-triangle"> </i> &nbsp; No se encontraron materias registradas en este curso.
                          </div>
                      
                      <?php } ?>
            </div>
        </section>
        </div>  
    </div>    
</div>







