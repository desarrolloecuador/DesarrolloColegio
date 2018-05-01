<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?php echo base_url('/assets/img/logo.jpg'); ?>">

    <title>Sistema de Seguimiento Curricular</title>

    <!-- Bootstrap CSS -->    
    <link href="<?php echo base_url('/assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <!-- bootstrap theme -->
    <link href="<?php echo base_url('/assets/css/bootstrap-theme.css'); ?>" rel="stylesheet">
    <!--external css-->
    <!-- font icon -->
    <link href="<?php echo base_url('/assets/css/elegant-icons-style.css'); ?>" rel="stylesheet" />
    <link href="<?php echo base_url('/assets/css/font-awesome.min.css'); ?>" rel="stylesheet" />   
    
    <!-- full calendar css-->
    <link href="<?php echo base_url('/assets/plugins/fullcalendar/fullcalendar/bootstrap-fullcalendar.css'); ?>" rel="stylesheet" />
	<link href="<?php echo base_url('/assets/plugins/fullcalendar/fullcalendar/fullcalendar.css'); ?>" rel="stylesheet" />
    <!-- easy pie chart-->
    <link href="<?php echo base_url('/assets/plugins/jquery-easy-pie-chart/jquery.easy-pie-chart.css'); ?>" rel="stylesheet" type="text/css" media="screen"/>
    
    <!-- owl carousel -->
    <link rel="stylesheet" href="<?php echo base_url('/assets/css/owl.carousel.css'); ?>" type="text/css">
	<link href="<?php echo base_url('/assets/css/jquery-jvectormap-1.2.2.css'); ?>" rel="stylesheet">
    <!-- Custom styles -->
	<link rel="stylesheet" href="<?php echo base_url('/assets/css/fullcalendar.css'); ?>">
	<link href="<?php echo base_url('/assets/css/widgets.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('/assets/css/style.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('/assets/css/style-responsive.css'); ?>" rel="stylesheet" />
	<link href="<?php echo base_url('/assets/css/xcharts.min.css'); ?>" rel=" stylesheet">	
	<link href="<?php echo base_url('/assets/css/jquery-ui-1.10.4.min.css'); ?>" rel="stylesheet">
	<link href="<?php echo base_url('/assets/css/theme.css'); ?>" rel="stylesheet">
	<link href="<?php echo base_url('/assets/css/jquery.dataTables.css'); ?>" rel="stylesheet">
	<link href="<?php echo base_url('/assets/css/lobipanel.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('/assets/css/bootstrap-select.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('/assets/css/jquery.timepicker.css'); ?>" rel="stylesheet">
	
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
    <script src="<?php echo base_url('/assets/js/notify.js'); ?>"></script>
    <script src="<?php echo base_url('/assets/js/jquery.dataTables.js'); ?>"></script>
    <script src="<?php echo base_url('/assets/js/lobipanel.js'); ?>"></script>
    <script src="<?php echo base_url('/assets/js/jquery.validate.min.js'); ?>"></script>
    <script src="<?php echo base_url('/assets/js/misvalidaciones.js'); ?>"></script>
    <script src="<?php echo base_url('/assets/js/bootstrap-select.js'); ?>"></script>
    <script src="<?php echo base_url('/assets/js/jquery.timepicker.js'); ?>"></script>
     
<!--
    <meta http-equiv="Expires" content="0" /> 
    <meta http-equiv="Pragma" content="no-cache" />

    <script type="text/javascript">
      if(history.forward(1)){
        location.replace( history.forward(1) );
      }
    </script>
-->
  
  
   

  </head>

  <body>
  
      <!-- container section start -->
      <section id="container" class="">
      
         <header class="header dark-bg">
            <div class="toggle-nav">
                <div class="icon-reorder tooltips" data-original-title="Mostrar/Ocultar Menú" data-placement="bottom"><i class="icon_menu"></i></div>
            </div>

            <!--logo start-->
            <a href="<?php echo site_url(); ?>" class="logo">Sistema de Seguimiento Curricular <!-- <span class="lite">Admin</span> --> </a>
            <!--logo end-->

            <div class="nav search-row" id="top_menu">
                <!--  search form start 
                <ul class="nav top-menu">                    
                    <li>
                        <form class="navbar-form">
                            <input class="form-control" placeholder="Search" type="text">
                        </form>
                    </li>                    
                </ul>
                   search form end -->                
            </div>

            <div class="top-nav notification-row">                
                
                <ul class="nav pull-right top-menu">
                    <!-- notificatoin dropdown start
                  
                    <li id="task_notificatoin_bar" class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <i class="icon-task-l"></i>
                            <span class="badge bg-important">6</span>
                        </a>
                        <ul class="dropdown-menu extended tasks-bar">
                            <div class="notify-arrow notify-arrow-blue"></div>
                            <li>
                                <p class="blue">You have 6 pending letter</p>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="task-info">
                                        <div class="desc">Design PSD </div>
                                        <div class="percent">90%</div>
                                    </div>
                                    <div class="progress progress-striped">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width: 90%">
                                            <span class="sr-only">90% Complete (success)</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="task-info">
                                        <div class="desc">
                                            Project 1
                                        </div>
                                        <div class="percent">30%</div>
                                    </div>
                                    <div class="progress progress-striped">
                                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="width: 30%">
                                            <span class="sr-only">30% Complete (warning)</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="task-info">
                                        <div class="desc">Digital Marketing</div>
                                        <div class="percent">80%</div>
                                    </div>
                                    <div class="progress progress-striped">
                                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                                            <span class="sr-only">80% Complete</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="task-info">
                                        <div class="desc">Logo Designing</div>
                                        <div class="percent">78%</div>
                                    </div>
                                    <div class="progress progress-striped">
                                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="78" aria-valuemin="0" aria-valuemax="100" style="width: 78%">
                                            <span class="sr-only">78% Complete (danger)</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="task-info">
                                        <div class="desc">Mobile App</div>
                                        <div class="percent">50%</div>
                                    </div>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar"  role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%">
                                            <span class="sr-only">50% Complete</span>
                                        </div>
                                    </div>

                                </a>
                            </li>
                            <li class="external">
                                <a href="#">See All Tasks</a>
                            </li>
                        </ul>
                    </li>
                    
                   
                    <li id="mail_notificatoin_bar" class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <i class="icon-envelope-l"></i>
                            <span class="badge bg-important">5</span>
                        </a>
                        <ul class="dropdown-menu extended inbox">
                            <div class="notify-arrow notify-arrow-blue"></div>
                            <li>
                                <p class="blue">You have 5 new messages</p>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="photo"><img alt="avatar" src="./img/avatar-mini.jpg"></span>
                                    <span class="subject">
                                    <span class="from">Greg  Martin</span>
                                    <span class="time">1 min</span>
                                    </span>
                                    <span class="message">
                                        I really like this admin panel.
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="photo"><img alt="avatar" src="./img/avatar-mini2.jpg"></span>
                                    <span class="subject">
                                    <span class="from">Bob   Mckenzie</span>
                                    <span class="time">5 mins</span>
                                    </span>
                                    <span class="message">
                                     Hi, What is next project plan?
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="photo"><img alt="avatar" src="./img/avatar-mini3.jpg"></span>
                                    <span class="subject">
                                    <span class="from">Phillip   Park</span>
                                    <span class="time">2 hrs</span>
                                    </span>
                                    <span class="message">
                                        I am like to buy this Admin Template.
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="photo"><img alt="avatar" src="./img/avatar-mini4.jpg"></span>
                                    <span class="subject">
                                    <span class="from">Ray   Munoz</span>
                                    <span class="time">1 day</span>
                                    </span>
                                    <span class="message">
                                        Icon fonts are great.
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="#">See all messages</a>
                            </li>
                        </ul>
                    </li>
                  
                  
                    <li id="alert_notificatoin_bar" class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">

                            <i class="icon-bell-l"></i>
                            <span class="badge bg-important">7</span>
                        </a>
                        <ul class="dropdown-menu extended notification">
                            <div class="notify-arrow notify-arrow-blue"></div>
                            <li>
                                <p class="blue">You have 4 new notifications</p>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="label label-primary"><i class="icon_profile"></i></span> 
                                    Friend Request
                                    <span class="small italic pull-right">5 mins</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="label label-warning"><i class="icon_pin"></i></span>  
                                    John location.
                                    <span class="small italic pull-right">50 mins</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="label label-danger"><i class="icon_book_alt"></i></span> 
                                    Project 3 Completed.
                                    <span class="small italic pull-right">1 hr</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="label label-success"><i class="icon_like"></i></span> 
                                    Mick appreciated your work.
                                    <span class="small italic pull-right"> Today</span>
                                </a>
                            </li>                            
                            <li>
                                <a href="#">See all notifications</a>
                            </li>
                        </ul>
                    </li>
                   
                   -->
                   
                   
                    <!-- user login dropdown start-->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="profile-ava">
                                <?php if($this->session->userdata('comil_imagen_usu')){ ?>                                    
                                    <img alt="" src="<?php echo base_url('assets/img/avatar.png'); ?>" height="30px" width="30px">
                                <?php }else{ ?>
                                    <img alt="" src="<?php echo base_url('assets/img/avatar.png'); ?>" height="30px" width="30px">
                                <?php } ?>                                                                
                            </span>
                            <span class="username">
                                <?php if($this->session->userdata('comil_nombre_usu')){ ?>
                                    <?php echo $this->session->userdata('comil_nombre_usu').": ".$this->session->userdata('comil_perfil_usu'); ?>
                                <?php }else{ ?>
                                    Anónimo
                                <?php } ?>
                            </span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu extended logout">
                            <div class="log-arrow-up"></div>
                            
                            
                            <li class="eborder-top">
                                <a href="<?php echo site_url('security/perfil'); ?>"><i class="icon_profile"></i>Mi Cuenta</a>
                            </li>
                             
 
                            <li>
                                <a href="<?php echo site_url('security/cerrarSesion'); ?>"><i class="fa fa-sign-out"></i> Salir</a>
                            </li>
                         
                        </ul>
                    </li>
                    <!-- user login dropdown end -->
                </ul>
                <!-- notificatoin dropdown end-->
            </div>
      </header>      
      <!--header end-->
      
     
    
    <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" >    
                  
                  
                  
                  
                  
                   <?php  if($this->session->userdata('comil_codigo_usu') && $this->session->userdata('comil_perfil_usu')=="DOCENTE"){  ?>
                     
                     
                      <li>
                        <a style="padding:5px;">
                             <center>
                                <?php if($this->session->userdata('comil_codigo_per') && $this->session->userdata('comil_nombre_per')){ ?>
                                     <b style="font-size:12px;">PERIODO: <?php echo $this->session->userdata('comil_nombre_per'); ?></b>
                                     
                                <?php }else{ ?>
                                    <b style="font-size:10px;">NO HAY UN PERIODO ACTIVO</b>
                                <?php } ?>
                                
                             </center>
                        </a>
                       </li>               
                     
                      <?php 
                        $ci = &get_instance();
                        $ci->load->model("periodo"); 
                        $periodoActivo=$ci->periodo->obtenerPeriodoActivo();                            
                      ?>
                       
                       
                       
                         <?php if($this->session->userdata("codigo_per")){ ?>
                             <script>
                                $("#seleccion_periodo").val("<?php echo $this->session->userdata("codigo_per"); ?>");
                            </script>
                         <?php } ?>
                       
                       
                       <script>
                                $("#seleccion_periodo").change(function(){
                                    valor=$("#seleccion_periodo").val();
                                    $.ajax({
                                        url:'<?php echo site_url('welcome/crearSesionPeriodo'); ?>',
                                        type:'post',
                                        data:{
                                            codigo_per:valor
                                        },
                                        success:function(data){            
                                            window.location.assign("<?php echo site_url('/'); ?>");
                                        }
                                        
                                    });
                                });
                        
                        </script>
                       
                    <?php } ?>                
                                       
                                        
                  <li id="menu_administracion">
                      <a class="" href="<?php echo site_url('/');  ?>" >
                          <i class="icon_house_alt"></i>
                          <span>Inicio</span> 
                      </a>
                  </li>
                  
                  
                  <?php  if($this->session->userdata('comil_codigo_usu') && $this->session->userdata('comil_perfil_usu')=="DOCENTE" &&  $this->session->userdata("comil_codigo_per")){  ?>
                             
                              <?php 
                                $ciCursos = &get_instance();
                                $ciCursos->load->model("materia"); 
                                $cursosVista=$ciCursos->materia->obtenerCursoPorDocentePeriodo($this->session->userdata('comil_codigo_usu'),$this->session->userdata("comil_codigo_per"));
                              ?>
                                   
                                <?php if($cursosVista){ ?>
                                     <?php $contadorCursos=0;  ?>
                                     <?php  foreach($cursosVista->result() as $c){ ?>
                                         <?php $contadorCursos++;  ?>
                                          <li id="menu_curso_<?php echo $c->codigo_cur;  ?>">
                                            <a style="font-size: 15px;" href="<?php echo site_url('materias/materiasDocenteCurso').'/'.$c->codigo_cur; ?>">
                                                 <span> <i class="fa" ><b><?php echo $contadorCursos;  ?>.</b></i> <?php echo $c->nombre_cur.' "'.$c->paralelo_cur.'"'.' | '.$c->seccion_cur; ?></span>
                                            </a>
                                           </li>                        
                                     <?php } ?>
                                <?php }else{ ?>
                                    
                                    <script>
                                        $.notify("No se encontraron cursos o materias en el periodo lectivo seleccionado.","error");
                                    </script>
                                
                                <?php } ?>


                    <?php } ?>
                
                
                <?php  if($this->session->userdata('comil_codigo_usu') && $this->session->userdata('comil_perfil_usu')=="ADMINISTRADOR"){  ?>
                       
                        <li id="menu_periodos">
                              <a class="" href="<?php echo site_url('/periodos/index');  ?>" >
                                  <i class="fa fa-calendar"></i>
                                  <span>Periodos</span>
                              </a>
                        </li>
                                                
                          <!--<li class="sub-menu">
                              <a href="javascript:;" class="">
                                  <i class="icon_document_alt"></i>
                                  <span>Forms</span>
                                  <span class="menu-arrow arrow_carrot-right"></span>
                              </a>
                              <ul class="sub">
                                  <li><a class="" href="form_component.html">Form Elements</a></li>                          
                                  <li><a class="" href="form_validation.html">Form Validation</a></li>
                              </ul>
                          </li> -->  


                          <li id="menu_docentes">
                              <a class="" href="<?php echo site_url('docentes/index'); ?>">
                                  <i class="fa fa-users"></i>
                                  <span>Docentes</span>
                              </a>
                          </li>
                          
                          
                          <li id="menu_representantes">
                              <a class="" href="<?php echo site_url('representantes/index'); ?>">
                                  <i class="fa fa-th-list"></i>
                                  <span>Representantes</span>
                              </a>
                          </li>

                          <li id="menu_cursos">
                              <a class="" href="<?php echo site_url('/cursos/listado');  ?>">
                                  <i class="fa fa-building"></i>
                                  <span>Cursos/Materias</span>
                              </a>
                          </li>


                          <li id="menu_tipos">
                              <a class="" href="<?php echo site_url('/tipos/index');  ?>">
                                  <i class="fa fa-list-ol"></i>
                                  <span>Tipo de Aportes</span>
                              </a>
                          </li>
                          
                          <!--
                          <li id="menu_quimestres">
                              <a class="" href="<?php echo site_url('/quimestres/index');  ?>">
                                  <i class="fa fa-table"></i>
                                  <span>Quimestres</span>
                              </a>
                          </li>
                          -->

                <?php } //Menu Administrador ?>
 
                
                
                 
                  
                   <li>
                      <a class="" href="<?php echo site_url('/security/cerrarSesion');  ?>">
                          <i class="fa fa-sign-out"></i>
                          <span>Salir</span>
                      </a>
                  </li>
               
                  
              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->
      
     
     <!--main content start-->
      <section id="main-content">
          <section class="wrapper">  
          
          <?php if($this->session->flashdata('bienvenida')){ ?>
              <script>
                 $.notify("<?php  echo $this->session->flashdata('bienvenida'); ?>","success");
              </script>
          <?php } ?>
          
         
            <?php  if ($this->session->flashdata('error')) { ?>          
               <script>
                 $.notify("<?php  echo $this->session->flashdata('error'); ?>","error");
              </script>        
            <?php } ?>

          <?php  if ($this->session->flashdata('confirmacion')) { ?>         
                <script>
                 $.notify("<?php  echo $this->session->flashdata('confirmacion'); ?>","success");
              </script> 
            <?php } ?>
            
           
          <style>
              thead>tr>th{
                  color:white;
              }    
              thead>tr{
                  background-color: #1A2732;
              }
         </style>
         
        
       <script>
        $(document).ready(function(){
            $('.miPanel').lobiPanel({
                reload:false,
                editTitle: false,
                unpin: {
                    icon: 'fa fa-arrows',
                    tooltip:'Mover'
                },
                minimize: {
                    icon: 'fa fa-chevron-up',
                    icon2: 'fa fa-chevron-down',
                    tooltip:'Añadir'
                },
                close:false,
                expand: {
                    icon: 'fa fa-expand',
                    icon2: 'fa fa-compress',
                    tooltip:"Pantalla Completa",           
                }
            });  
            
            
              $('.miPanelCerrado').lobiPanel({
                reload:false,
                state:'collapsed',
                editTitle: false,
                unpin: {
                    icon: 'fa fa-arrows',
                    tooltip:'Mover'
                },
                minimize: {
                    icon: 'fa fa-chevron-up',
                    icon2: 'fa fa-chevron-down',
                    tooltip:'Añadir'
                },
                close:false,
                expand: {
                    icon: 'fa fa-expand',
                    icon2: 'fa fa-compress',
                    tooltip:"Pantalla Completa",           
                }
            });   
            
        
           
           
           
            /*TABLA*/
	   $('.tblBuscador tfoot th').each( function () {
               var title = $(this).text();
               if(title=="No."){
                   $(this).html( '<input type="text" size="1" class="form-control" placeholder=" '+title+'" />' );
               }else{
                   $(this).html( '<input type="text" size="4"   class="form-control" placeholder=" '+title+'" />' );
               }
           } );


           var table = $('.tblBuscador').DataTable({

                buttons: [
                    'print'
                ],
                "lengthMenu": [[5,10, 25, 50, -1], [5,10, 25, 50,"Todos" ]],
                 "oLanguage": {
                 "oPaginate": {
                        "sPrevious": "Anterior",
                        "sNext": "Siguiente"
                      },
                  "sSearch": "Buscar:",
                  "sLengthMenu": "Ver _MENU_ registros",
                  "sInfo": "Total: _TOTAL_ registro. Mostrando desde el _START_ al _END_",
                  "sZeroRecords": "No se encontraron resultados"
                }

           } );


           table.columns().every( function () {
               var that = this;

               $( 'input', this.footer() ).on( 'keyup change', function () {
                   if ( that.search() !== this.value ) {
                       that
                           .search( this.value )
                           .draw();
                   }
               } );
           } );


           /*TABLA*/
            
            
            
            
            
            /*TABLA Sin Paginador*/
	   $('.tblBuscadorSinPaginador tfoot th').each( function () {
               var title = $(this).text();
               if(title=="No."){
                   $(this).html( '<input type="text" size="1" class="form-control" placeholder=" '+title+'" />' );
               }else{
                   $(this).html( '<input type="text" size="4"   class="form-control" placeholder=" '+title+'" />' );
               }
           } );


           var table = $('.tblBuscadorSinPaginador').DataTable({

                buttons: [
                    'print'
                ],
                "paging": false,
                 "oLanguage": {                  
                  "sSearch": "Buscar:",
                  "sLengthMenu": "Ver _MENU_ registros",
                  "sInfo": "Total: _TOTAL_ registro. Mostrando desde el _START_ al _END_",
                  "sZeroRecords": "No se encontraron resultados"
                }

           } );


           table.columns().every( function () {
               var that = this;

               $( 'input', this.footer() ).on( 'keyup change', function () {
                   if ( that.search() !== this.value ) {
                       that
                           .search( this.value )
                           .draw();
                   }
               } );
           } );


           /*TABLA Sin Paginador*/
            
            
            

            
            });//document ready
           

        </script>
         
    
          <style>
                  .loader {
                    border: 16px solid #f3f3f3; /* Light grey */
                    border-top: 16px solid #394A59; /* Blue */
                    border-radius: 50%;
                    width: 100px;
                    height: 100px;
                    animation: spin 2s linear infinite;
                }

                @keyframes spin {
                    0% { transform: rotate(0deg); }
                    100% { transform: rotate(360deg); }
                }
        </style>