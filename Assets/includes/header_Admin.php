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

     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

     <!-- Select 2 -->
     <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

     <!-- DataTables CSS -->
     <link rel="stylesheet" type="text/css" href="<?php echo media(); ?>DataTables/datatables.min.css">
     <link rel="stylesheet" type="text/css" href="<?php echo media(); ?>DataTables/DataTables-1.10.23/css/datatables.bootstrap4.min.css">

     <!-- Main CSS-->
     <link rel="stylesheet" type="text/css" href="<?php echo media(); ?>css/style.css">
     <link rel="stylesheet" type="text/css" href="<?php echo media(); ?>css/main.css">
</head>

<body class="app sidebar-mini">
     <!-- Navbar-->
     <header class="app-header">
          <a class="app-header__logo" href="<?php echo base_url() ?>">Supermarket</a>
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

     <div class="container-fluid">
          <?= navBarAdmin(); ?>