<?= headerAdmin($data); ?>

<!-- CONTENIDO PRICIPAL -->
<main class="app-content">
     <div class="app-title">
          <div>
               <h1>
                    <i class="fas fa-shopping-cart"></i> <?= $data['page_name'] ?>
                    <!-- <button class="btn btn-primary" type="button" onclick="OpenModal()"><i class="fas fa-plus-circle" data-toggle="modal" data-target="#modalProductos"> Facturar</i></button> -->
               </h1>
          </div>
          <ul class="app-breadcrumb breadcrumb">
               <li class="breadcrumb-item"><a href="<?= base_url(); ?>dashboard"><i class="fa fa-dashboard fa-lg"></i></a></li>
               <li class="breadcrumb-item"><a href="#"><i class=""></i>Ventas</a></li>
               <li class="breadcrumb-item active"><a class="active" href="<?= base_url(); ?>facturacion/nueva_factura"> Nueva Factura</a></li>
          </ul>
     </div>

     <div class="row">
          <div class="col-md-8">
               <!-- DATOS CLIENTE -->
               <div class="mb-3">
                    <div class="row mb-1">
                         <div class="col-md-3">
                              <div class="input-group-append">
                                   <div class="form-floating">
                                        <input type="text" class="form-control" maxlength="10" id="Identificacion" name="Identificacion" placeholder=" ">
                                        <!-- onkeyup="SearchClient(this.value);" -->
                                        <label for="Identificacion">Identificación</label>
                                   </div>
                                   <button class="btn btn-primary2" id="btnIdentificacion"><i class="fas fa-search"></i></button>
                              </div>
                         </div>
                         <div class="col-md-8">
                              <div class="form-floating">
                                   <input type="text" class="form-control" id="Nombre" placeholder=" " disabled>
                                   <label for="Nombre">Nombre</label>
                              </div>
                         </div>
                    </div>

                    <div class="row mt-3 ">
                         <div class="col-md-3">
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
                         <div class="col-md-6">
                              <div class="form-floating">
                                   <textarea class="form-control" name="Direccion" id="Direccion" cols="20" rows="3" placeholder=" " disabled></textarea>
                                   <!-- <input type="text" class="form-control" name="Direccion" id="Direccion" placeholder=" " disabled> -->
                                   <label for="Direccion">Dirección</label>
                              </div>
                         </div>
                    </div>
               </div>

               <!-- DATOS PRODUCTOS -->
               <div class="mt-4">
                    <div class="tile-body">
                         <div class="row">
                              <div class="col-md-4">
                                   <div class="form-floating">
                                        <input type="text" class="form-control" name="nombreProducto" id="nombreProducto" placeholder=" " aria-describedby="nombreProducto">
                                        <label for="nombreProducto">Digite el código del producto <strong id="alerta"></strong></label>
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
                                   <div class="">
                                        <button style="height: calc(3.5rem + 2px);" class="btn btn-primary2 btn-block" id="btnAgregarProducto">Agregar</button>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>

               <!-- TABLA -->
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
          </div>

          <!-- TOTALES -->
          <div class="col-md-4">
               <div class="tile-body">
                    <div class="card">
                         <div class="card-header">
                              <div class="text-center">
                                   <h3 id="totalFactura" class="text-center">Total Factura</h3>
                                   <input class="text-center h2 border-0" value="0.00" type="text" disabled id="totalFactura">
                              </div>
                         </div>
                         <div class="card-header">
                              <div class="container">
                                   <div class="row">
                                        <div class="col-md-6">
                                             <label for="tipoDocumento">DOCUMENTO</label>
                                             <select class="custom-select" name="tipoDocumento" id="tipoDocumento">
                                                  <option value="0" selected>Factura Electrónica</option>
                                                  <option value="1">Tiquete Electrónico</option>
                                             </select>
                                        </div>

                                        <div class="col-md-6">
                                             <label for="tipoPago">TIPO PAGO</label>
                                             <select class="custom-select form-control" name="tipoPago" id="tipoPago">
                                                  <option value="0" selected>Contado</option>
                                                  <option value="1">Crédito</option>
                                             </select>
                                        </div>
                                   </div>

                                   <div class="row mt-4">
                                        <div class="col-md-6">
                                             <div class="">
                                                  <label for="Fecha">FECHA COMPRA</label>
                                                  <input type="date" pattern="[0-9]{2}-[0-9]{2}-[0-9]{4}" class="form-control" id="txtFecha" name="Fecha">
                                             </div>
                                        </div>
                                        <div class="col-md-6">
                                             <div class="">
                                                  <label for="numVenta">N. VENTA</label>
                                                  <input type="text" class="form-control" name="numVenta" id="numVenta" placeholder=" " disabled>
                                             </div>
                                        </div>
                                   </div>

                                   <div class="justify-content-between">
                                        <div class="row mt-4">
                                             <div class="col-md-4">
                                                  <div class="form-floating">
                                                       <input type="text" class="form-control" name="Subtotal" id="Subtotal" placeholder=" " disabled>
                                                       <label for="Subtotal">Subtotal</label>
                                                  </div>
                                             </div>
                                             <div class="col-md-4">
                                                  <div class="form-floating">
                                                       <input type="text" class="form-control" name="iva" id="iva" placeholder=" " disabled>
                                                       <label for="iva">IVA</label>
                                                  </div>
                                             </div>
                                             <div class="col-md-4">
                                                  <div class="form-floating ">
                                                       <input type="text" class="form-control" name="totalFactura" id="totalFactura" placeholder=" " disabled>
                                                       <label for="totalFactura" class="">Total</label>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                         <div class="card-footer">
                              <button style="height: calc(3.5rem + 2px);" class="btn btn-primary2 btn-block " id="btnFacturar">
                                   <h3>Facturar</h3>
                              </button>
                              <!-- <button style="height: calc(3.5rem + 2px);" class="btn btn-danger btn-block " id="btnCancelar"> -->
                              <!-- <h3><i class="fas fa-cash-register"></i> Cancelar</h3>
                                   </button> -->
                         </div>
                    </div>
               </div>
          </div>
     </div>




</main>

<?=
// ShowModal('modalProductos');
footerAdmin($data);
?>