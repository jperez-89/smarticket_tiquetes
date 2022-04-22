<?php
if (isset($_GET["telefonoCliente"]) && $_GET["telefonoCliente"] != "") {
     headerAdmin($data);
?>
     <!-- CONTENIDO PRICIPAL -->
     <main class="app-content">
          <div class="app-title">
               <div>
                    <h1>
                         <i class="fas fa-shopping-cart"></i> <?= $data['page_name'] ?>
                    </h1>
               </div>
               <ul class="app-breadcrumb breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url(); ?>dashboard"><i class="fa fa-dashboard fa-lg"></i></a></li>
                    <li class="breadcrumb-item"><a href="#"><i class=""></i>Ventas</a></li>
                    <li class="breadcrumb-item active"><a class="active" href="<?= base_url(); ?>ventas/nueva_venta"> Reserva Entradas</a></li>
               </ul>
          </div>

          <div class="row">
               <div class="col-md-12">
                    <!-- DATOS CLIENTE -->
                    <form id="frmReservaEntradas" name="frmReservaEntradas">
                         <div class="mb-3">
                              <div class="row">
                                   <div class="col-md-3">
                                        <input type="hidden" name="idCliente" id="idCliente" value="<?= $_GET["idCliente"] ?>">
                                        <div class="form-floating">
                                             <input type="text" class="form-control" maxlength="8" id="txtTelefono" name="txtTelefono" placeholder="No digite guiones ni espacios" value="<?= $_GET["telefonoCliente"] ?>">
                                             <label for=" txtTelefono">Digite número de teléfono <strong id="alerta"></strong></label>
                                        </div>
                                   </div>
                                   <div class="col-md-5">
                                        <div class="form-floating">
                                             <input type="text" class="form-control" id="txtNombre" placeholder=" " value="<?= $_GET["nombreCliente"] ?>" disabled>
                                             <label for="txtNombre">Nombre</label>
                                        </div>
                                   </div>
                                   <div class="col-md-4">
                                        <div class="form-floating">
                                             <input type="text" class="form-control" name="txtEmail" id="txtEmail" placeholder=" " value="<?= $_GET["emailCliente"] ?>" disabled>
                                             <label for="txtEmail">Email</label>
                                        </div>
                                   </div>
                              </div>
                         </div>
                         <!-- DATOS EVENTO -->
                         <div class="mb-3">
                              <div class="row">
                                   <div class="col-md-6">
                                        <div class="form-group" id="lstselecEventos">
                                             <label for="selecEventos" class="control-label">Selecciona un Evento</label>
                                             <select onchange="CargaSelectTipoEntradas(this.value);" class="form-control" name="selecEventos" id="selecEventos"></select>
                                        </div>
                                   </div>
                                   <div class="col-md-6">
                                        <div class="form-group" id="lstselecTipoEntradas">
                                             <label for="selecTipoEntradas" class="control-label">Selecciona un Tipo de Entrada</label>
                                             <select onchange="BuscaEntradasDisponibles(this.value);" class="form-control" name="selecTipoEntradas" id="selecTipoEntradas"></select>
                                        </div>
                                   </div>
                              </div>
                         </div>
                         <!-- DATOS PRODUCTOS -->
                         <div class="mb-3">
                              <div class="row">
                                   <div class="col-md-2">
                                        <div class="form-floating">
                                             <input type="text" class="form-control" name="Stock" id="Stock" placeholder=" " disabled>
                                             <label for="Stock">Entradas Disponibles</label>
                                        </div>
                                   </div>
                                   <div class="col-md-2">
                                        <div class="form-floating mb-1">
                                             <input value="" type="text" class="form-control" name="Precio" id="Precio" placeholder=" " disabled>
                                             <label for="Precio">Precio</label>
                                        </div>
                                   </div>

                                   <div class="col-md-4">
                                        <div class="form-floating">
                                             <input type="text" class="form-control" name="cantEntradas" id="cantEntradas" placeholder=" " aria-describedby="cantEntradas">
                                             <label for="cantEntradas">Entradas requeridas</label>
                                        </div>
                                   </div>
                                   <div class="col-md-2">
                                        <div class="form-floating mb-1">
                                             <input value="" type="text" class="form-control" name="txtTotalPagar" id="txtTotalPagar" placeholder=" " disabled>
                                             <label for="txtTotalPagar">Total a Pagar</label>
                                        </div>
                                   </div>
                                   <div class="col-md-2">
                                        <div class="">
                                             <button style="height: calc(3.5rem + 2px);" class="btn btn-primary2 btn-block" name="btnAgregarReserva" id="btnAgregarReserva">Agregar</button>
                                             <button style="height: calc(3.5rem + 2px); display: none;" class="btn btn-primary2 btn-block" name="btnActualizarReserva" id="btnActualizarReserva">Actualizar</button>
                                             <!-- onclick="ReservarEntradas();" -->
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </form>
                    <!-- TABLA -->
                    <div class="tile-body">
                         <div class="table-responsive">
                              <table class="table table-bordered table-sm" id="tblReservaEntradas" style="width: 50%;">
                                   <thead>
                                        <tr>
                                             <th>Id Reserva</th>
                                             <th>Nombre Cliente</th>
                                             <th>Evento</th>
                                             <th>Tipo Entrada</th>
                                             <th>Precio Entrada</th>
                                             <th>Cantidad Entradas</th>
                                             <th>Total a Pagar</th>
                                             <th>Tipo de Reserva</th>
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
     </main>

     <?= footerAdmin($data); ?>

<?php

} else {
     headerAdmin($data);
?>
     <!-- CONTENIDO PRICIPAL -->
     <main class="app-content">
          <div class="app-title">
               <div>
                    <h1>
                         <i class="fas fa-shopping-cart"></i> <?= $data['page_name'] ?>
                    </h1>
               </div>
               <ul class="app-breadcrumb breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url(); ?>dashboard"><i class="fa fa-dashboard fa-lg"></i></a></li>
                    <li class="breadcrumb-item"><a href="#"><i class=""></i>Ventas</a></li>
                    <li class="breadcrumb-item active"><a class="active" href="<?= base_url(); ?>ventas/nueva_venta"> Reserva Entradas</a></li>
               </ul>
          </div>

          <div class="row">
               <div class="col-md-12">
                    <form id="frmReservaEntradas" name="frmReservaEntradas">
                         <!-- DATOS CLIENTE -->
                         <div class="mb-3">
                              <div class="row">
                                   <div class="col-md-3">
                                        <input type="hidden" name="idCliente" id="idCliente" value="">
                                        <div class="form-floating">
                                             <input type="text" class="form-control" maxlength="8" id="txtTelefono" name="txtTelefono" placeholder="No digite guiones ni espacios" onkeyup="BuscarCliente(this.value);">
                                             <label for="txtTelefono">Digite número de teléfono <strong id="alerta"></strong></label>
                                        </div>
                                   </div>
                                   <div class="col-md-5">
                                        <div class="form-floating">
                                             <input type="text" class="form-control" id="txtNombre" placeholder=" " disabled>
                                             <label for="txtNombre">Nombre</label>
                                        </div>
                                   </div>
                                   <div class="col-md-4">
                                        <div class="form-floating">
                                             <input type="text" class="form-control" name="txtEmail" id="txtEmail" placeholder=" " disabled>
                                             <label for="txtEmail">Email</label>
                                        </div>
                                   </div>
                              </div>
                         </div>
                         <!-- DATOS EVENTO -->
                         <div class="mb-3">
                              <div class="row">
                                   <div class="col-md-6">
                                        <div class="form-group" id="lstselecEventos">
                                             <label for="selecEventos" class="control-label">Selecciona un Evento</label>
                                             <select onchange="CargaSelectTipoEntradas(this.value);" class="form-control" name="selecEventos" id="selecEventos"></select>
                                        </div>
                                   </div>
                                   <div class="col-md-6">
                                        <div class="form-group" id="lstselecTipoEntradas">
                                             <label for="selecTipoEntradas" class="control-label">Selecciona un Tipo de Entrada</label>
                                             <select onchange="BuscaEntradasDisponibles(this.value);" class="form-control" name="selecTipoEntradas" id="selecTipoEntradas"></select>
                                        </div>
                                   </div>
                              </div>
                         </div>
                         <!-- DATOS PRODUCTOS -->
                         <div class="mb-3">
                              <div class="row">
                                   <div class="col-md-2">
                                        <div class="form-floating">
                                             <input type="text" class="form-control" name="Stock" id="Stock" placeholder=" " disabled>
                                             <label for="Stock">Entradas Disponibles</label>
                                        </div>
                                   </div>
                                   <div class="col-md-2">
                                        <div class="form-floating mb-1">
                                             <input type="text" class="form-control" name="Precio" id="Precio" placeholder=" " disabled>
                                             <label for="Precio">Precio</label>
                                        </div>
                                   </div>

                                   <div class="col-md-4">
                                        <div class="form-floating">
                                             <input type="text" class="form-control" name="cantEntradas" id="cantEntradas" placeholder=" " aria-describedby="cantEntradas">
                                             <label for="cantEntradas">Entradas requeridas</label>
                                        </div>
                                   </div>
                                   <div class="col-md-2">
                                        <div class="form-floating mb-1">
                                             <input type="text" class="form-control" name="txtTotalPagar" id="txtTotalPagar" placeholder=" " disabled>
                                             <label for="txtTotalPagar">Total a Pagar</label>
                                        </div>
                                   </div>
                                   <div class="col-md-2">
                                        <div class="">
                                             <button type="submit" style="height: calc(3.5rem + 2px);" class="btn btn-primary2 btn-block" name="btnAgregarReserva" id="btnAgregarReserva">Reservar Entradas</button>
                                             <button style="height: calc(3.5rem + 2px); display: none;" class="btn btn-primary2 btn-block" name="btnActualizarReserva" id="btnActualizarReserva">Actualizar</button>
                                             <!-- onclick="ReservarEntradas();" -->
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </form>
                    <!-- TABLA -->
                    <div class="">
                         <div class="tile-body">
                              <div class="table-responsive">
                                   <table class="table table-bordered table-sm" id="tblReservaEntradas" style="width: 100%;">
                                        <thead>
                                             <tr>
                                                  <th>Id Reserva</th>
                                                  <th>Nombre Cliente</th>
                                                  <th>Evento</th>
                                                  <th>Tipo Entrada</th>
                                                  <th>Precio Entrada</th>
                                                  <th>Cantidad Entradas</th>
                                                  <th>Total a Pagar</th>
                                                  <th>Tipo de Reserva</th>
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

<?= footerAdmin($data);
}
?>