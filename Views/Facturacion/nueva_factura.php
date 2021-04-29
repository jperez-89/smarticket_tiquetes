<?= headerAdmin($data); ?>

<!-- CONTENIDO PRICIPAL -->
<main class="app-content">
     <div class="app-title">
          <div>
               <h1>
                    <i class="fa fa-box"></i> <?= $data['page_name'] ?>
                    <!-- <button class="btn btn-primary" type="button" onclick="OpenModal()"><i class="fas fa-plus-circle" data-toggle="modal" data-target="#modalProductos"> Facturar</i></button> -->
               </h1>
          </div>
          <ul class="app-breadcrumb breadcrumb">
               <li class="breadcrumb-item"><a href="<?= base_url(); ?>dashboard"><i class="fa fa-home fa-lg"></i></a></li>
               <li class="breadcrumb-item"><a href="#"><i class=""></i>Ventas</a></li>
               <li class="breadcrumb-item active"><a class="active" href="<?= base_url(); ?>facturacion/nueva_factura"> Nueva Factura</a></li>
          </ul>
     </div>

     <div class="container-fluid mt-2">
          <div class="mb-3">
               <div class="tile-body">
                    <div class="row mb-1">
                         <div class="col-md-2">
                              <div class="input-group-append">
                                   <div class="form-floating">
                                        <input type="text" class="form-control" maxlength="10" id="Identificacion" name="Identificacion" placeholder=" ">
                                        <!-- onkeyup="SearchClient(this.value);" -->
                                        <label for="Identificacion">Identificación</label>
                                   </div>
                                   <button class="ml-1 btn btn-link" id="btnIdentificacion"><i class="fas fa-search"></i></button>
                              </div>
                         </div>
                         <div class="col-md-5">
                              <div class="form-floating">
                                   <input type="text" class="form-control" id="Nombre" placeholder=" " disabled>
                                   <label for="Nombre">Nombre</label>
                              </div>
                         </div>

                         <div class="col-md-3">
                              <div class="form-floating">
                                   <input type="date" pattern="[0-9]{2}-[0-9]{2}-[0-9]{4}" class="form-control" id="txtFecha" name="Fecha">
                                   <label for="Fecha">Fecha</label>
                              </div>
                         </div>
                    </div>

                    <div class="row mt-3">
                         <div class="col-md-2">
                              <div class="form-floating">
                                   <input type="text" class="form-control" name="Telefono" id="Telefono" placeholder=" " disabled>
                                   <label for="Telefono">Teléfono</label>
                              </div>
                         </div>
                         <div class="col-md-2">
                              <div class="form-floating">
                                   <input type="text" class="form-control" name="Email" id="Email" placeholder=" " disabled>
                                   <label for="Email">Email</label>
                              </div>
                         </div>
                         <div class="col-md-8">
                              <div class="form-floating">
                                   <input type="text" class="form-control" name="Direccion" id="Direccion" placeholder=" " disabled>
                                   <label for="Direccion">Dirección</label>
                              </div>
                         </div>
                    </div>
               </div>
          </div>

          <div class="mb-3">
               <div class="tile-body">
                    <div class="row">
                         <div class="col-md-4">
                              <div class="form-floating">
                                   <input type="text" class="form-control" name="nombreProducto" id="nombreProducto" placeholder=" " aria-describedby="nombreProducto">
                                   <label for="nombreProducto">Nombre producto <strong id="alerta"></strong></label>
                              </div>
                         </div>
                         <div class="col-md-2">
                              <div class="form-floating mb-1">
                                   <input type="text" class="form-control" id="Precio" placeholder=" " disabled>
                                   <label for="Precio">Precio</label>
                              </div>
                         </div>
                         <div class="col-md-2">
                              <div class="form-floating mb-1">
                                   <input type="text" class="form-control" name="Stock" id="Stock" placeholder=" " disabled>
                                   <label for="Stock">Stock</label>
                              </div>
                         </div>
                         <div class="col-md-2">
                              <div class="form-floating mb-1">
                                   <input type="text" class="form-control" name="Cantidad" id="Cantidad" placeholder=" ">
                                   <label for="Cantidad">Cantidad</label>
                              </div>
                         </div>
                         <div class="col-md-2">
                              <div class="mb-1">
                                   <button class="mt-1 w-50 btn btn-primary" id="btnAgregarProducto"><i class="fa fa-plus"> Agregar</i></button>
                              </div>
                         </div>
                    </div>
               </div>
          </div>

          <div class="mb-3">
               <div class="tile-body">
                    <div class="table-responsive">
                         <table class="table table-bordered table-sm" id="tblFactura">
                              <thead>
                                   <tr>
                                        <th>Cantidad</th>
                                        <th>Nombre</th>
                                        <th>Precio Unitario</th>
                                        <th>Subtotal</th>
                                        <th>IVA</th>
                                        <th>Total</th>
                                        <th>Acción</th>
                                   </tr>
                              </thead>
                              <tbody>
                              </tbody>
                         </table>
                    </div>
               </div>
          </div>

          <div class="tile-body">
               <div class="row">
                    <div class="col-md-2">
                         <div class="form-floating mb-1">
                              <input type="text" class="form-control" name="Subtotal" id="Subtotal" placeholder=" " disabled>
                              <label for="Subtotal">Subtotal</label>
                         </div>
                    </div>
                    <div class="col-md-2">
                         <div class="form-floating mb-1">
                              <input type="text" class="form-control" name="iva" id="iva" placeholder=" " disabled>
                              <label for="iva">IVA</label>
                         </div>
                    </div>
                    <div class="col-md-2">
                         <div class="form-floating mb-1">
                              <input type="text" class="form-control" name="Total" id="Total" placeholder=" " disabled>
                              <label for="Total">Total</label>
                         </div>
                    </div>
                    <div class="col-md-2">
                         <div class="mb-1">
                              <button class="mt-1 w-50 btn btn-primary" id="btnFacturar"><i class="fas fa-cash-register"></i> Facturar</button>
                         </div>
                    </div>
               </div>
          </div>

</main>

<?=
// ShowModal('modalProductos');
footerAdmin($data);
?>