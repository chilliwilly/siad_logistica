<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="SIAD PYME">
<meta name="author" content="Despacho Nacional">
<link rel="icon" type="image/<?php echo EXTENSION_IMAGEN_FAVICON; ?>" href="<?php echo base_url();?>img/<?php echo NOMBRE_IMAGEN_FAVICON; ?>" />

<title><?php echo TITULO_PAGINA; ?></title>
<!-- Bootstrap core CSS -->
<!--<link href="<?php echo base_url()?>bootstrap/bootstrap.min.css" rel="stylesheet">-->
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/Tablas.css">
<!--<script type="text/javascript" src="<?php echo base_url()?>js/jquery.min.js"></script>-->
<!--<script type="text/javascript" src="<?php echo base_url()?>bootstrap/bootstrap.min.js"></script>-->


<!-- INI AGREGADOS -->

<!-- Tell the browser to be responsive to screen width -->
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport"/>
<!-- Bootstrap 3.3.5 -->
<link rel="stylesheet" href="<?php echo base_url();?>bootstrap/css/bootstrap.min.css"/>
<!-- Font Awesome -->
<link rel="stylesheet" href="<?php echo base_url();?>css/font-awesome/css/font-awesome.min.css">
<!-- Ionicons -->
<link rel="stylesheet" href="<?php echo base_url();?>bootstrap/css/ionicons.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="<?php echo base_url();?>dist/css/AdminLTE.min.css"/>
<!-- iCheck -->
<link rel="stylesheet" href="<?php echo base_url();?>plugins/iCheck/square/blue.css"/>

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<!-- FIN AGREGADOS -->


<script type="text/javascript">
  var baseurl = "<?php echo base_url(); ?>";
</script>
</head>
<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <img src="<?php echo base_url();?>img/Claro.png" width="20%" height="20%"/><br /><b>LOGISTICA</b>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">Ingrese Datos Para Iniciar Sesion</p>
            <form id="loginform" name="loginform" role="form">
                <input type="hidden" value="0" id="validausuario" name="validausuario">
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" placeholder="Usuario" id="txtUsuario" name="txtUsuario" autofocus="autofocus" onblur='validarEmail(this.value);'/>
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" placeholder="Contraseña" id="txtPassword" name="txtPassword" />
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-8">

                    </div>
                    <!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Entrar</button>                        
                    </div>
                    <!-- /.col -->
                </div>
            </form>
            <!--<a href="modaltest.aspx#myModal" class="btn btn-primary"> Open Modal </a><br />-->
            <a href="#">Olvido Contraseña?</a>
            <br/><br/>
            <div id="mensaje"></div>
        </div>
        <!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url();?>/plugins/jQuery/jquery-2.2.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo base_url();?>/bootstrap/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="<?php echo base_url();?>/plugins/iCheck/icheck.min.js"></script>

    <script type="text/javascript" src="<?php echo base_url();?>js/jsValidacion.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>js/jsonLogin.js"></script>

    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
</body>
</html>
