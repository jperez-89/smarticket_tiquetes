<?= headerAdmin($data); ?>

<!-- CONTENIDO PRICIPAL -->
<main class="app-content">
     <div class="app-title">
          <div>
               <h1>
                    <i class="fa fa-ticket"></i> <?= $data['page_name'] ?>
                    <button class="btn btn-primary2" type="button" onclick="OpenModal()"><i class="fas fa-plus-circle" data-toggle="modal" data-target="#modalTipoEntradas"> Nuevo</i></button>
               </h1>
          </div>
          <ul class="app-breadcrumb breadcrumb">
               <li class="breadcrumb-item"><a href="<?= base_url(); ?>dashboard"><i class="fa fa-home fa-lg"></i></a></li>
               <li class="breadcrumb-item"><a href="#"><i class=""></i>Entradas</a></li>
               <li class="breadcrumb-item"><a class="active" href="<?= base_url(); ?>entradas/tipo_entradas"> Tipo Entradas</a></li>
          </ul>
     </div>
     <div class="row">
          <div class="col-md-12">
               <div class="tile">
                    <div class="tile-body">
                         <div class="table-responsive">
                              <table class="table table-hover table-sm" id="tblTipoEntradas" style="width: 100%;">
                                   <thead>
                                        <tr>
                                             <th>Id</th>
                                             <th>Tipo Entrada</th>
                                             <th>Estado</th>
                                             <th>Acciones</th>
                                        </tr>
                                   </thead>
                                   <tbody>
                                   </tbody>
                              </table>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</main>

<?=
ShowModal('modalTipoEntrada');
footerAdmin($data);
?>