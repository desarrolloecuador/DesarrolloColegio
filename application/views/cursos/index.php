<script>    
    $("#menu_cursos").addClass("active");    
</script>

  <div class="row">
    <div class="col-lg-12">
        <h3 class="page-header"><i class="fa fa-building"></i> Cursos</h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?php echo site_url('/welcome/index'); ?>">Inicio</a></li>
            <li><i class="fa fa-building"></i>Cursos/Materias</li>						  	
        </ol>
    </div>
</div>
 

<div class="row">
    <div class="col-md-12">            
        <section class="panel miPanel">
              <header class="panel-heading">
                   <b>Seleccione el Periodo Lectivo:</b>                   
              </header>
              <div class="panel-body">
                  
                  <?php if($periodos) { ?>
                      
                      <table class="table table-striped tblBuscador">
                         <thead>
                              <tr>
                                  <th>No.</th>
                                  <th>PERIODO</th>
                                  <th>OPCIONES</th>                              
                              </tr>   
                        </thead> 
                        <tfoot>
                              <tr>
                                  <th>No.</th>
                                  <th>PERIODO</th>
                                  <td></td>                              
                              </tr>   
                        </tfoot> 
                        <tbody>
                           <?php $i=1; ?>
                           <?php foreach($periodos->result() as $periodo) { ?>
                               
                               <tr>
                                   <td><?php echo $i; ?></td>
                                   <td><?php echo $periodo->nombre_per; ?></td>
                                   <td>
                                       <a href="<?php echo site_url('/cursos/listado').'/'.$periodo->codigo_per; ?>" class="btn btn-default"> <i class="fa fa-edit"> </i> Gestionar Cursos </a>                                       
                                   </td>
                                   
                               </tr>
                               <?php $i++; ?>
                           <?php } ?>
                        </tbody>
                      </table>
                  
                  <?php }else{ ?>
                      <div class="alert alert-danger">
                              <i class="fa fa-exclamation-triangle"> </i> No se encontraron periodos lectivos registrados
                      </div>                  
                  <?php } ?>
              
            </div>
        </section>
    </div>
</div>



<br>
<br>
<br>