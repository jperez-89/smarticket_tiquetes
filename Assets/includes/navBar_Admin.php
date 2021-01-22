<!-- Sidebar menu-->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
     <div class="app-sidebar__user">
          <img class="app-sidebar__user-avatar" src="<?= media(); ?>images/avatar.png" alt="User Image">
          <div>
               <p class="app-sidebar__user-name">Jairo Pérez</p>
               <p class="app-sidebar__user-designation">Administrator</p>
          </div>
     </div>
     <ul class="app-menu">
          <li>
               <a class="app-menu__item" href="<?= base_url() ?>dashboard">
                    <i class="app-menu__icon fa fa-dashboard"></i>
                    <span class="app-menu__label">Dashboard</span>
               </a>
          </li>
          <!-- USERS -->
          <!-- <li class="treeview">
               <a class="app-menu__item" href="#" data-toggle="treeview">
                    <i class="app-menu__icon fa fa-users"></i>
                    <span class="app-menu__label">Users</span>
                    <i class="treeview-indicator fa fa-angle-right"></i>
               </a>
               <ul class="treeview-menu">
                    <li>
                         <a class="treeview-item" href="<?= base_url() ?>users"><i class="icon fa fa-circle-o"></i>Users</a>
                    </li>
                    <li>
                         <a class="treeview-item" href="<?= base_url() ?>roles" target="" rel="noopener">
                              <i class="icon fa fa-circle-o"></i>Roles
                         </a>
                    </li>
               </ul>
          </li> -->

          <!-- CLIENTS -->
          <!-- <li class="treeview">
               <a class="app-menu__item" href="#" data-toggle="treeview">
                    <i class="app-menu__icon fa fa-user"></i>
                    <span class="app-menu__label">Customers</span>
                    <i class="treeview-indicator fa fa-angle-right"></i>
               </a>
               <ul class="treeview-menu">
                    <li><a class="treeview-item" href="<?= base_url() ?>#"><i class="icon fa fa-circle-o"></i>Customers List</a></li>
               </ul>
          </li> -->
          <li class="treeview">
               <a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-archive"></i><span class="app-menu__label">Products</span><i class="treeview-indicator fa fa-angle-right"></i></a>
               <ul class="treeview-menu">
                    <li><a class="treeview-item" href="<?= base_url() ?>productos"><i class="icon fa fa-circle-o"></i>Products List</a></li>
               </ul>
          </li>
          <!-- <li><a class="app-menu__item" href="docs.html"><i class="app-menu__icon fa fa-cart-plus"></i><span class="app-menu__label">Pedidos</span></a></li> -->
     </ul>
</aside>