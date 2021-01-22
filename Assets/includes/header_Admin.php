<!DOCTYPE html>
<html lang="es">

<head>
     <meta charset="utf-8">
     <!-- Descripcion que se muestran en los resultados de la busqueda de google -->
     <meta name="description" content="Supermercado en Linea">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <meta name="author" content="Jairo RPR">
     <meta name="theme-color" content="#009688">
     <link rel="shortcut icon" href="<?= media(); ?>images/favicon2.ico" type="image/x-icon">
     <title><?php echo $data["page_title"] ?></title>
     <!-- Main CSS-->
     <link rel="stylesheet" type="text/css" href="<?php echo media(); ?>css/main.css">
     <link rel="stylesheet" type="text/css" href="<?php echo media(); ?>css/style.css">
</head>

<body class="app sidebar-mini">
     <!-- Navbar-->
     <header class="app-header">
          <a class="app-header__logo" href="<?php base_url() ?>dashboard">Supermarket</a>
          <!-- Sidebar toggle button-->
          <a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
          <!-- Navbar Right Menu-->
          <ul class="app-nav">

               <li class="dropdown">
                    <img data-toggle="dropdown" aria-label="Open Profile Menu" class="app-sidebar__user-avatar settings" src="<?= media(); ?>images/avatar.png" alt="User Image">
                    <ul class="dropdown-menu settings-menu dropdown-menu-right">
                         <!-- <li><a class="dropdown-item" href="<?= base_url() ?>settings"><i class="fa fa-cog fa-lg"></i> Settings</a></li> -->
                         <!-- <li><a class="dropdown-item" href="<?= base_url() ?>profile"><i class="fa fa-user fa-lg"></i> Profile</a></li> -->
                         <li><a class="dropdown-item" href="<?= base_url() ?>logout"><i class="fa fa-sign-out fa-lg"></i> Logout</a></li>
                    </ul>
               </li>
          </ul>
     </header>

     <?= navBarAdmin(); ?>