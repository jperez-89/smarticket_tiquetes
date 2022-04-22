<!-- Modal -->
<div class="modal fade" id="modalAgregarEntrada" aria-labelledby="titleModal" role="dialog" tabindex="-1" aria-hidden="true">
     <div class="modal-dialog modal-lg">
          <div class="modal-content">
               <div class="modal-header headerRegister">
                    <h5 class="tile-title" id="titleModal">Agregar Entradas a Evento</h5>
                    <button type="button" class="close cerrarModal" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                    </button>
               </div>
               <div class="modal-body">
                    <div class="tile">
                         <div class="tile-body">
                              <form id="frmEntradas" name="frmEntradas">
                                   <input type="hidden" name="idEntrada" id="idEntrada" value="0">
                                   <div class="row">
                                        <div class="col-md-4">
                                             <div class="form-group" id="lstselecEventos">
                                                  <label for="selecEventos" class="control-label">Selecciona un Evento</label>
                                                  <select class="form-control" name="selecEventos" id="selecEventos"></select>
                                             </div>
                                        </div>
                                        <div class="col-md-4">
                                             <div class="form-group" id="lstselecTipoEntradas">
                                                  <label for="selecTipoEntradas" class="control-label">Selecciona un Tipo de Entrada</label>
                                                  <select class="form-control" name="selecTipoEntradas" id="selecTipoEntradas"></select>
                                             </div>
                                        </div>
                                        <div class="col-md-4">
                                             <div class="form-group">
                                                  <label for="txtPrecioUnitario" class="control-label">Precio Unitario</label>
                                                  <input class="form-control" id="txtPrecioUnitario" name="txtPrecioUnitario" type="text" placeholder="Precio Unitario">
                                             </div>
                                        </div>
                                   </div>
                                   <div class="row">
                                        <div class="col-md-4">
                                             <div class="form-group">
                                                  <label for="txtCantidadEntradas" class="control-label">Total Entradas en venta</label>
                                                  <input class="form-control" id="txtCantidadEntradas" name="txtCantidadEntradas" type="text" placeholder="Total Entradas en venta">
                                             </div>
                                        </div>
                                        <div class="col-md-4">
                                             <div class="form-group">
                                                  <label for="txtLimiteCompra" class="control-label">Límite Compra por persona</label>
                                                  <input class="form-control" id="txtLimiteCompra" name="txtLimiteCompra" type="text" placeholder="Cantidad Entradas">
                                             </div>
                                        </div>
                                        <div class="col-md-4">
                                             <div class="form-group" id="lstEntrada">
                                                  <label for="selecEstado" class="control-label">Estado</label>
                                                  <select class="form-control" name="selecEstado" id="selecEstado">
                                                       <option value="1">Activo</option>
                                                       <option value="0">Inactivo</option>
                                                  </select>
                                             </div>
                                        </div>
                                   </div>
                                   <div class="tile-footer">
                                        <button id="btnGuardar" class="btn btn-primary2" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Guardar</span></button>
                                   </div>
                              </form>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>