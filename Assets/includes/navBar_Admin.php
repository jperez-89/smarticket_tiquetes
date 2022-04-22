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
                    <span class="app-menu__label">Panel de Control</span>
               </a>
          </li>
          <!-- CLIENTES --------------------------------------- -->
          <li>
               <a class="app-menu__item" href="<?= base_url() ?>clientes">
                    <i class="app-menu__icon fas fa-user-friends"></i>
                    <span class="app-menu__label">Clientes</span>
               </a>
          </li>

          <!-- VENTAS --------------------------------------- -->
          <li class="treeview">
               <a class="app-menu__item" href="#" data-toggle="treeview">
                    <i class="app-menu__icon fas fa-shopping-cart"></i>
                    <span class="app-menu__label">Ventas</span>
                    <i class="treeview-indicator fa fa-angle-right"></i>
               </a>
               <ul class="treeview-menu">
                    <li>
                         <a class="treeview-item" href="<?= base_url() ?>ventas/reserva_entradas" rel="noopener">
                              <i class="icon fa fa-circle-o"></i>Reserva Entradas
                         </a>
                    </li>
               </ul>
          </li>

          <!-- EVENTOS --------------------------------------- -->
          <li>
               <a class="app-menu__item" href="<?= base_url() ?>eventos">
                    <i class="app-menu__icon fas fa-music""></i>
                    <span class=" app-menu__label">Eventos</span>
               </a>
          </li>

          <!-- ENTRADAS --------------------------------------- -->
          <li class="treeview">
               <a class="app-menu__item" href="#" data-toggle="treeview">
                    <i class="app-menu__icon fa fa-ticket"></i>
                    <span class="app-menu__label">Entradas</span>
                    <i class="treeview-indicator fa fa-angle-right"></i>
               </a>
               <ul class="treeview-menu">
                    <li>
                         <a class="treeview-item" href="<?= base_url() ?>entradas/tipo_entradas" rel="noopener">
                              <i class="icon fa fa-circle-o"></i>Tipo de Entradas
                         </a>
                    </li>
                    <li>
                         <a class="treeview-item" href="<?= base_url() ?>entradas/agregar_entradas"><i class="icon fa fa-circle-o"></i>Agregar Entradas</a>
                    </li>

               </ul>
          </li>

          <!-- EVENTOS --------------------------------------- -->
          <li>
               <a class="app-menu__item" href="<?= base_url() ?>">
                    <i class="app-menu__icon fas fa-network-wired"></i>
                    <span class="app-menu__label">Conexión</span>
               </a>
          </li>

          <!-- USUARIOS --------------------------------------- -->
          <!-- <li class="treeview">
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
          </li> -->
     </ul>
</aside>