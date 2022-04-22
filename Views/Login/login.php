<!DOCTYPE html>
<html lang="es">

<head>
     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <meta name="author" content="Jairo RPR">
     <meta name="theme-color" content="#112d49">
     <link rel="shortcut icon" href="<?= media(); ?>images/favicon2.ico" type="image/x-icon">
     <title><?php echo $data["page_title"] ?></title>
     <!-- Main CSS-->
     <link rel="stylesheet" type="text/css" href="<?php echo media(); ?>css/main.css">
     <link rel="stylesheet" type="text/css" href="<?php echo media(); ?>css/style.css">
</head>

<body>
     <section class="material-half-bg">
          <div class="cover"></div>
     </section>
     <section class="login-content">
          <div class="logo">
               <h1><?php echo $data["page_name"] ?></h1>
          </div>
          <div class="login-box">
               <form id="frmLogin" name="frmLogin" class="login-form" action="">
                    <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i> INICIAR SESIÓN</h3>
                    <div class="form-group">
                         <label for="txtUsername" class="control-label">USUARIO</label>
                         <input class="form-control" id="txtUsername" name="txtUsername" type="email" placeholder="Correo electrónico">
                    </div>
                    <div class="form-group">
                         <label for="txtPassword" class="control-label">CONTRASEÑA</label>
                         <input class="form-control" id="txtPassword" name="txtPassword" type="password" placeholder="Contraseña">
                    </div>
                    <div class="form-group">
                         <div class="utility">
                              <p class="semibold-text mb-2"><a href="#" data-toggle="flip">Olvidó su contraseña?</a></p>
                         </div>
                    </div>
                    <div id="alertLogin" class="text-center"></div>
                    <div class="form-group btn-container">
                         <button type="submit" class="btn btn-primary2 btn-block"><i class="fa fa-sign-in fa-lg fa-fw"></i>Iniciar sesión</button>
                    </div>
               </form>

               <!-- FORM DE RESET PASSWORD -->
               <form class="forget-form" action="#">
                    <h3 class="login-head"><i class="fa fa-lg fa-fw fa-lock"></i>Olvidó su contraseña?</h3>
                    <div class="form-group">
                         <label for="txtEmailReset" class="control-label">EMAIL</label>
                         <input id="txtEmailReset" name="txtEmailReset" class="form-control" type="email" placeholder="Correo electrónico">
                    </div>
                    <div class="form-group btn-container">
                         <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-unlock fa-lg fa-fw"></i>RESETEAR</button>
                    </div>
                    <div class="form-group mt-3">
                         <p class="semibold-text mb-0"><a href="#" data-toggle="flip"><i class="fa fa-angle-left fa-fw"></i> INICIAR SESIÓN</a></p>
                    </div>
               </form>
          </div>
     </section>

     <script>
          const base_url = "<?= base_url(); ?>";
     </script>
     
     <!-- Essential javascripts for application to work-->
     <script type="text/javascript" src="<?php echo media(); ?>js/jquery-3.3.1.min.js"></script>
     <script type="text/javascript" src="<?php echo media(); ?>js/popper.min.js"></script>
     <script type="text/javascript" src="<?php echo media(); ?>js/bootstrap.min.js"></script>
     <script type="text/javascript" src="<?php echo media(); ?>js/main.js"></script>
     <script type="text/javascript" src="<?php echo media(); ?>js/fontawesome.js"></script>
     <script type="text/javascript" src="<?php echo media(); ?>js/plugins/sweetalert.min.js"></script>
     <script type="text/javascript" src="<?php echo media(); ?>js/<?= $data['page_functions']; ?>"></script>

     <!-- The javascript plugin to display page loading on top-->
     <script type="text/javascript" src="<?php echo media(); ?>js/plugins/pace.min.js"></script>
</body>

</html>