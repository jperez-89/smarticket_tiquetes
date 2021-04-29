<!-- Sidebar menu-->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
     <div class="app-sidebar__user">
          <img class="app-sidebar__user-avatar" src="<?= media(); ?>images/avatar.png" alt="User Image">
          <div>
               <p class="app-sidebar__user-name">
                    Jairo Pérez

                    <!-- session_start();
                    $_SESSION['username'] -->
               </p>
               <p id="RolUsuario" class="app-sidebar__user-designation">Administrador</p>
          </div>
     </div>
     <ul class="app-menu">
          <!-- DASHBOARD --------------------------------------- -->
          <li>
               <a class="app-menu__item" href="<?= base_url() ?>">
                    <i class="app-menu__icon fa fa-dashboard"></i>
                    <span class="app-menu__label">Dashboard</span>
               </a>
          </li>
          <!-- CLIENTES --------------------------------------- -->
          <li>
               <a class="app-menu__item" href="<?= base_url() ?>clientes">
                    <i class="app-menu__icon fas fa-people-arrows"></i>
                    <span class="app-menu__label">Clientes</span>
               </a>
          </li>

          <!-- PRODUCTOS --------------------------------------- -->
          <li>
               <a class="app-menu__item" href="<?= base_url() ?>productos">
                    <i class="app-menu__icon fa fa-archive"></i>
                    <span class="app-menu__label">Productos</span>
               </a>
          </li>

          <!-- VENTAS --------------------------------------- -->
          <li class="treeview">
               <a class="app-menu__item" href="#" data-toggle="treeview">
                    <i class="app-menu__icon fa fa-users"></i>
                    <span class="app-menu__label">Ventas</span>
                    <i class="treeview-indicator fa fa-angle-right"></i>
               </a>
               <ul class="treeview-menu">
                    <li>
                         <a class="treeview-item" href="<?= base_url() ?>facturacion/nueva_factura" rel="noopener">
                              <i class="icon fa fa-circle-o"></i>Nueva Venta
                         </a>
                    </li>
                    <li>
                         <a class="treeview-item" href="<?= base_url() ?>facturacion/facturas"><i class="icon fa fa-circle-o"></i>Facturas</a>
                    </li>

               </ul>
          </li>

          <!-- USUARIOS --------------------------------------- -->
          <li class="treeview">
               <a class="app-menu__item" href="#" data-toggle="treeview">
                    <i class="app-menu__icon fa fa-users"></i>
                    <span class="app-menu__label">Usuarios</span>
                    <i class="treeview-indicator fa fa-angle-right"></i>
               </a>
               <ul class="treeview-menu">
                    <li>
                         <a class="treeview-item" href="<?= base_url() ?>usuarios"><i class="icon fa fa-circle-o"></i>Usuarios</a>
                    </li>
                    <li>
                         <a class="treeview-item" href="<?= base_url() ?>roles" target="" rel="noopener">
                              <i class="icon fa fa-circle-o"></i>Roles de usuario
                         </a>
                    </li>
               </ul>
          </li>
     </ul>
</aside>