<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
  <meta charset="utf-8" />
  <title>Login</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <meta content="" name="description" />
  <meta content="" name="author" />
  <link href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet" />
  <link href="<?php echo base_url('assets/css/metro.css') ?>" rel="stylesheet" />
  <link href="<?php echo base_url('assets/font-awesome/css/font-awesome.css') ?>" rel="stylesheet" />
  <link href="<?php echo base_url('assets/css/style.css') ?>" rel="stylesheet" />
  <link href="<?php echo base_url('assets/css/style_responsive.css') ?>" rel="stylesheet" />
  <link href="<?php echo base_url('assets/css/style_bumida.css') ?>" rel="stylesheet" id="style_color" />
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/uniform/css/uniform.default.css') ?>" />
  <link rel="shortcut icon" href="favicon.ico" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="login">
  <!-- BEGIN LOGO -->
  <div class="logo">
    <img src="<?php echo base_url('assets/img/logo_big.jpg') ?>" alt="" /> 
  </div>
  <!-- END LOGO -->
  <!-- BEGIN LOGIN -->
  <div class="content">
    <!-- BEGIN LOGIN FORM -->
    <form class="form-vertical login-form" action="<?php echo site_url('login/masuk') ?>" method="POST" />
      <h3 class="form-title">Login to your account</h3>
      <?php if( $this->session->flashdata('error') != "" ){ ?>
      <div class="alert alert-error">
          <button class="close" data-dismiss="alert"></button>
          <strong>Perhatian!</strong> <?php echo $this->session->flashdata('error'); ?>
      </div>
      <?php } ?>
      <div class="control-group">
        <div class="controls">
          <div class="input-icon left">
            <i class="icon-user"></i>
            <input name="username" class="m-wrap" type="text" placeholder="Username" />
          </div>
        </div>
      </div>
      <div class="control-group">
        <div class="controls">
          <div class="input-icon left">
            <i class="icon-lock"></i>
            <input name="password" class="m-wrap" type="password" style="" placeholder="Password" />
          </div>
        </div>
      </div>
      <div class="form-actions">
        <label class="checkbox">
        <input type="checkbox" /> Remember me
        </label>
        <button type="submit" id="login-btn" class="btn green pull-right">
        Login <i class="m-icon-swapright m-icon-white"></i>
        </button>            
      </div>
    </form>
    <!-- END LOGIN FORM -->        
  </div>
  <!-- END LOGIN -->
  <!-- BEGIN COPYRIGHT -->
  <div class="copyright">
    2013 &copy; Metronic. Admin Dashboard Template.
  </div>
  <!-- END COPYRIGHT -->
  <!-- BEGIN JAVASCRIPTS -->
  <script src="<?php echo base_url('assets/js/jquery-1.8.3.min.js') ?>"></script>
  <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js') ?>"></script>  
  <script src="<?php echo base_url('assets/uniform/jquery.uniform.min.js') ?>"></script> 
  <script src="<?php echo base_url('assets/js/jquery.blockui.js') ?>"></script>
  <script src="<?php echo base_url('assets/js/app.js') ?>"></script>
  <script>
    jQuery(document).ready(function() {     
      App.initLogin();
    });
  </script>
  <!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>