<?= headerAdmin($data); ?>

<!-- CONTENIDO PRICIPAL -->
<main class="app-content">
     <div class="app-title">
          <div>
               <h1>
                    <i class="fa fa-box"></i> <?= $data['page_name'] ?>
                    <button class="btn btn-primary" type="button" onclick="OpenModalProductos()"><i class="fas fa-plus-circle" data-toggle="modal" data-target="#modalFormRoles"> Nuevo</i></button>
               </h1>
          </div>
          <ul class="app-breadcrumb breadcrumb">
               <li class="breadcrumb-item"><a href="<?= base_url(); ?>dashboard"><i class="fa fa-home fa-lg"></i></a></li>
               <li class="breadcrumb-item"><a href="<?= base_url(); ?>productos"> Productos</a></li>
          </ul>
     </div>
     <div class="row">
          <div class="col-md-12">
               <div class="tile">
                    <div class="tile-body">
                         <div class="table-responsive">
                              <table class="table table-hover table-bordered" id="tblProductos">
                                   <thead>
                                        <tr>
                                             <th>Id</th>
                                             <th>Nombre</th>
                                             <th>Precio</th>
                                             <th>Stock</th>
                                             <th>Descripción</th>
                                             <th>Medida</th>
                                             <th>Estado</th>
                                             <th>Imagen</th>
                                             <th>Acción</th>
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
ShowModal('modalProductos');
footerAdmin($data);
?>