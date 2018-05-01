<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
    <meta name="author" content="GeeksLabs">
    <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
    <link rel="shortcut icon" href="<?php echo base_url('/assets/img/logo1.png'); ?>">
    
    <script src="<?php echo base_url('/assets/js/jquery.js'); ?>"></script>
	<script src="<?php echo base_url('/assets/js/jquery-ui-1.10.4.min.js'); ?>"></script>
    <script src="<?php echo base_url('/assets/js/jquery-1.8.3.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('/assets/js/jquery-ui-1.9.2.custom.min.js'); ?>"></script>
    <!-- bootstrap -->
    <script src="<?php echo base_url('/assets/js/bootstrap.min.js'); ?>"></script>

    <title>Login</title>

    <!-- Bootstrap CSS -->    
    <link href="<?php echo base_url('/assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <!-- bootstrap theme -->
    <link href="<?php echo base_url('/assets/css/bootstrap-theme.css'); ?>" rel="stylesheet">
    <!--external css-->
    <!-- font icon -->
    <link href="<?php echo base_url('/assets/css/elegant-icons-style.css'); ?>" rel="stylesheet" />
    <link href="<?php echo base_url('/assets/css/font-awesome.css'); ?>" rel="stylesheet" />
    <!-- Custom styles -->
    <link href="<?php echo base_url('/assets/css/style.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('/assets/css/style-responsive.css'); ?>" rel="stylesheet" />
    
    <meta http-equiv="Expires" content="0" /> 
    <meta http-equiv="Pragma" content="no-cache" />

    <script type="text/javascript">
      if(history.forward(1)){
        location.replace( history.forward(1) );
      }
    </script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
</head>

  <body class="login-img3-body">

    <div class="container">

      <form class="login-form" action="<?php echo site_url('security/validarDatos'); ?>" method="post">        
        <div class="login-wrap">
           <div class="row">
               <div class="col-md-3">
                    <p class="login-img">
                        <i class="icon_lock_alt"></i> <br>                            
                    </p>                          
               </div>
               <div class="col-md-9">
                    <legend style="color:#007AFF"><b>Sistema de Seguimiento Curricular</b></legend>                     
               </div>
               
           </div>    
            
            
            <?php  if ($this->session->flashdata('errorLogin')) { ?>
          
                <div class="alert alert-danger">
                   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                   </button>
                    <i class="fa fa-exclamation-triangle"> </i>
                    <?php echo $this->session->flashdata('errorLogin'); ?>
                </div>
        
            <?php } ?>

          <?php  if ($this->session->flashdata('cerrarSesion')) { ?>
         
                <div class="alert alert-success">
                   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                   </button>
                   <i class="fa fa-check"> </i>
                    <?php echo $this->session->flashdata('cerrarSesion'); ?>
                </div>
          
            <?php } ?>
            
            <div class="input-group">
              <span class="input-group-addon"><i class="icon_profile"></i></span>
              <input required title="Ingrese su nombre de usuario" type="text" name="username_usu" class="form-control" placeholder="Ingrese su usuario" autofocus>
            </div>
            <div class="input-group">
                <span class="input-group-addon"><i class="icon_key_alt"></i></span>
                <input required title="Ingrese su contraseña" type="password" name="password_usu" class="form-control" placeholder="Ingrese su contraseña">
            </div>
            <label class="checkbox">
            <!--<input type="checkbox" value="remember-me"> Recordar cuenta 
                <span class="pull-right"> <a href="#" style="text-decoration:underline;"> <b>¿Olvido su contraseña? </b></a></span>-->
            </label>
            <button class="btn btn-primary btn-lg btn-block" type="submit"> <i class="fa fa-sign-in"> </i> Ingresar</button>
            <!--<button class="btn btn-info btn-lg btn-block" type="submit">Signup</button>-->
        </div>
      </form>
      </div>

        
    
  </body>
  
  
    
</html>
 