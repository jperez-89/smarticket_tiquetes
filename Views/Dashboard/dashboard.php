<?= headerAdmin($data); ?>

<!-- CONTENIDO PRICIPAL -->
<main class="app-content">
     <div class="app-title">
          <div>
               <h1><i class="fa fa-dashboard"></i> <?= $data['page_name'] ?></h1>
          </div>
          <form class="d-flex">
               <div class="input-group">
                    <input type="date" pattern="[0-9]{2}-[0-9]{2}-[0-9]{4}" class="form-control form-control-light" id="txtFecha">
               </div>
          </form>

     </div>
     <div class="row">
          <div class="col-md-6 col-lg-3">
               <div class="widget-small shadow info coloured-icon">
                    <a href="<?= base_url(); ?>ventas/reserva_entradas"><i class="icon fas fa-dollar-sign"></i></a>
                    <div class="info">
                         <h4>Reserva Entradas</h4>
                         <p><b>5</b></p>
                    </div>
               </div>
          </div>
          <div class="col-md-6 col-lg-3">
               <div class="widget-small shadow warning coloured-icon">
                    <a href="<?= base_url(); ?>clientes"><i class="icon fas fa-user-friends"></i></a>
                    <!-- <i class="icon fas fa-people-carry fa-3x"> -->
                    <div class="info">
                         <h4>Clientes</h4>
                         <p> <b id="cantClientes"></b> </p>
                    </div>
               </div>
          </div>
          <div class="col-md-6 col-lg-3">
               <div class="widget-small shadow danger coloured-icon">
                    <a href="<?= base_url(); ?>eventos"><i class="icon fas fa-music"></i></a>
                    <div class="info">
                         <h4>Eventos</h4>
                         <p> <b id="cantEventos"></b> </p>
                    </div>
               </div>
          </div>
          <!-- <div class="col-md-6 col-lg-3">
               <div class="widget-small shadow primary coloured-icon">
                    <a href="<?= base_url(); ?>usuarios"><i class="icon fa fa-users fa-3x"></i></a>
                    <div class="info">
                         <h4>Usuarios</h4>
                         <p> <b id="cantUsers"></b> </p>
                    </div>
               </div>
          </div> -->
     </div>
</main>

<?= footerAdmin($data); ?>