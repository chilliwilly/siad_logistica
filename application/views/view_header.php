<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Operaciones - Claro</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?php echo base_url();?>bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css-->
    <link rel="stylesheet" href="<?php echo base_url();?>css/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css-->
    <link rel="stylesheet" href="<?php echo base_url();?>bootstrap/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url();?>dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo base_url();?>dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/Tablas.css">

    <!-- daterange picker -->
    <link rel="stylesheet" href="<?php echo base_url();?>plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- daterange picker -->
    <link rel="stylesheet" href="<?php echo base_url();?>plugins/daterangepicker/daterangepicker.css">
    <!-- Bootstrap time Picker -->
    <link rel="stylesheet" href="<?php echo base_url();?>plugins/timepicker/bootstrap-timepicker.min.css">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="<?php echo base_url();?>plugins/datepicker/datepicker3.css">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/Tablas.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- jquery-ui css -->
    <link rel="stylesheet" href="<?php echo base_url();?>plugins/jQueryUI/jquery-ui.css">
    <link rel="stylesheet" href="<?php echo base_url();?>css/datatables.min.css">

    <!--<link rel="stylesheet" href="<?php echo base_url();?>css/bootstrap-combined.min.css"/>-->

    <!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url()?>plugins/jQuery/jquery-2.2.4.min.js"></script>
    <script src="<?php echo base_url()?>plugins/jQueryUI/jquery-ui.min.js"></script>

    <!--<script src="<?php echo base_url()?>js/jquery.ajaxfileupload.js"></script>-->
  </head>
  <!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
  <body class="hold-transition skin-red-light layout-top-nav">
    <div class="wrapper">

      <header class="main-header">
        <nav class="navbar navbar-static-top">
          <div class="container">
            <div class="navbar-header">
              <a href="#" class="navbar-brand"><b>LOGISTICA</b></a>
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                <i class="fa fa-bars"></i>
              </button>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
              <ul class="nav navbar-nav">
                <?php
                  $contador  = 0;
                  $LineaTemp = 0;
                  $IdMenu    = 0;
                  if(!isset($_SESSION)){
                    session_start();
                  }
                  //verifico si aun existe la session menu
                  if (!isset($_SESSION['Menu'])) {
                    $this->session->sess_destroy();
                    redirect('index.php/Login');
                  }

                  $ArrayMenu = $_SESSION['Menu'];
                  foreach ($ArrayMenu as $key => $value) {
                  # code...
                    $linea    = $value->menu_grupo;
                    $url      = $value->menu_url;
                    $IdMenu   = $value->menu_id;
                    $cierre   = $value->menu_cierre;

                    if($linea==0){
                      $LineaTemp = $value->menu_id;
                      //echo '<li>';
                      echo '<li class="dropdown"><a href="'.base_url().$url.'" class="dropdown-toggle" data-toggle="dropdown">'.$value->menu_nombre.'<span class="caret"></span></a>';//</li>';
                      //echo '<div>';
                      //echo '</li>';
                      echo '<ul class="dropdown-menu" role="menu">';
                      foreach ($ArrayMenu as $key => $valued) {
                        # code...
                        if($valued->menu_grupo == $LineaTemp && $this->session->userdata('TIPOUSUARIO') == 3 && $valued->menu_id == 3){
                          //MUESTRA EL SUBMENU ORDENES PARA EL ALIADO
                          echo '<li><a href="'.base_url().$valued->menu_url.'/aliado">'.$valued->menu_nombre.'</a></li>';
                        }elseif ($valued->menu_grupo == $LineaTemp && $this->session->userdata('TIPOUSUARIO') == 4 && $valued->menu_id == 3) {
                          //MUESTRA EL SUBMENU ORDENES PARA PLATAFORMA T2
                          echo '<li><a href="'.base_url().$valued->menu_url.'/plataforma">'.$valued->menu_nombre.'</a></li>';
                        }elseif ($valued->menu_grupo == $LineaTemp && $valued->menu_id != 3) {
                          //MUESTRA EL RESTO DE SUBMENU PARA <>Admin EXCLUYENDO LISTAR ORDENES
                          echo '<li><a href="'.base_url().$valued->menu_url.'">'.$valued->menu_nombre.'</a></li>';
                        }elseif ($valued->menu_grupo == $LineaTemp && $this->session->userdata('TIPOUSUARIO') != 3) {
                          //MUESTRA SUBMENU PARA ADMIN
                          echo '<li><a href="'.base_url().$valued->menu_url.'">'.$valued->menu_nombre.'</a></li>';
                        }
                      }
                    }

                    // if($linea == $LineaTemp){
                    //   echo '<li><a href="'.base_url().$url.'"><i class="fa fa-book"></i>'.$value->menu_nombre.'<i class="fa fa-angle-right pull-right"></i></a></li>';
                    // }

                    if($linea == 0){//($cierre == 1){//($url == "usuarios" or $url == "ventas" or $url == "ordencompra" or $url == "reportes"){
                      echo '</ul>';
                      echo '</li>';
                    }
                  }
                ?>
              </ul>
            </div><!-- /.navbar-collapse -->
            <!-- Navbar Right Menu -->
              <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                  <!-- Messages: style can be found in dropdown.less-->

                  <!-- /.messages-menu -->

                  <!-- Notifications Menu -->

                  <!-- Tasks Menu -->

                  <!-- User Account Menu -->
                  <li class="dropdown user user-menu">
                    <!-- Menu Toggle Button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <!-- The user image in the navbar-->
                      <img src="<?php echo base_url();?>img/Claro.png" class="user-image" alt="User Image">
                      <!-- hidden-xs hides the username on small devices so only the image appears. -->
                      <span class="hidden-xs"><?php echo 'Conectado como: '.$this->session->userdata('USRNAME'); ?></span>
                    </a>
                    <ul class="dropdown-menu">
                      <!-- The user image in the menu -->
                      <li class="user-header">
                        <img src="<?php echo base_url();?>img/Claro.png" class="img-circle" alt="User Image">
                        <p>
                          <?php
                            echo $this->session->userdata('NOMBRE').' '.$this->session->userdata('APELLIDOS');
                          ?>
                          <small><?php echo $this->session->userdata('ALIADONOMBRE'); ?></small>
                          <small><?php echo 'Rol: '.$this->session->userdata('USRROLNOM'); ?></small>
                        </p>
                      </li>
                      <!-- Menu Body -->
                      <li class="user-body">
                        <div class="col-xs-6 text-center">
                          <a href="#">Contraseña</a>
                        </div>
                        <div class="col-xs-6 text-center">
                          <a href="#">Cuenta</a>
                        </div>
                        <!--<div class="col-xs-4 text-center">
                          <a href="#">Friends</a>
                        </div>-->
                      </li>
                      <!-- Menu Footer-->
                      <li class="user-footer">
                        <div class="pull-left">
                          <!--<a href="#" class="btn btn-default btn-flat">Profile</a>-->
                        </div>
                        <div class="pull-right">
                          <a href="<?php echo base_url();?>login/CerrarSesion" class="btn btn-default btn-flat">Cerrar Sesion</a>
                        </div>
                      </li>
                    </ul>
                  </li>
                </ul>
              </div><!-- /.navbar-custom-menu -->
          </div><!-- /.container-fluid -->
        </nav>
      </header>
      <!-- Full Width Column -->
      <div class="content-wrapper">
        <div class="container">
          <!-- Content Header (Page header) -->
