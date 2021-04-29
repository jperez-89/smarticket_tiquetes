<?= headerAdmin($data); ?>

<!-- CONTENIDO PRICIPAL -->
<main class="app-content">
     <div class="app-title">
          <div>
               <h1><i class="fa fa-dashboard"></i> <?= $data['page_name'] ?></h1>
          </div>
          <!-- <ul class="app-breadcrumb breadcrumb">
               <li class="breadcrumb-item"><a href="<?= base_url(); ?>dashboard"><i class="fa fa-home fa-lg"></i></a></li>
          </ul> -->
          <form class="d-flex">
               <div class="input-group">
                    <input type="date" pattern="[0-9]{2}-[0-9]{2}-[0-9]{4}" class="form-control form-control-light" id="txtFecha">
                    <!-- <span class="input-group-text bg-primary border-primary text-white">
                         <i class="mdi mdi-calendar-range font-13"></i>
                    </span> -->
               </div>
          </form>

     </div>
     <div class="row">
          <div class="col-md-6 col-lg-3">
               <div class="widget-small shadow info coloured-icon">
                    <a href="<?= base_url(); ?>facturas"><i class="icon fas fa-file-invoice fa-3x"></i> </a>
                    <div class="info">
                         <h4>Facturas</h4>
                         <p><b>25</b></p>
                    </div>
               </div>
          </div>
          <div class="col-md-6 col-lg-3">
               <div class="widget-small shadow warning coloured-icon">
                    <a href="<?= base_url(); ?>clientes"><i class="icon fas fa-people-carry fa-3x"></i></a>
                    <div class="info">
                         <h4>Clientes</h4>
                         <p> <b id="cantClientes"></b> </p>
                    </div>
               </div>
          </div>
          <div class="col-md-6 col-lg-3">
               <div class="widget-small shadow danger coloured-icon">
                    <a href="<?= base_url(); ?>productos"><i class="icon fa fa-archive fa-3x"></i></a>
                    <div class="info">
                         <h4>Productos</h4>
                         <p> <b id="cantProductos"></b> </p>
                    </div>
               </div>
          </div>
          <div class="col-md-6 col-lg-3">
               <div class="widget-small shadow primary coloured-icon">
                    <a href="<?= base_url(); ?>usuarios"><i class="icon fa fa-users fa-3x"></i></a>
                    <div class="info">
                         <h4>Usuarios</h4>
                         <p> <b id="cantUsers"></b> </p>
                    </div>
               </div>
          </div>
     </div>
</main>

<?= footerAdmin($data); ?>