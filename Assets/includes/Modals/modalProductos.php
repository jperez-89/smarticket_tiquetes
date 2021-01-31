<!-- Modal -->
<div class="modal fade" id="modalProductos" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-hidden="true">
     <div class="modal-dialog">
          <div class="modal-content">
               <div class="modal-header headerRegister">
                    <h5 class="tile-title" id="titleModal">Nuevo Producto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                    </button>
               </div>
               <div class="modal-body">
                    <div class="tile">
                         <div class="tile-body">
                              <form id="frmProducto" name="frmProducto">
                                   <input type="hidden" name="idProducto" id="idProducto" value="">
                                   <div class="row">
                                        <div class="col-md-6">
                                             <div class="form-group">
                                                  <label for="txtNombre" class="control-label">Nombre</label>
                                                  <input class="form-control" id="txtNombre" name="txtNombre" type="text" placeholder="Nombre del producto">
                                             </div>
                                             <div class="form-group">
                                                  <label for="txtPrecio" class="control-label">Precio</label>
                                                  <input class="form-control" id="txtPrecio" name="txtPrecio" type="text" placeholder="Precio del producto">
                                             </div>
                                             <div class="form-group">
                                                  <label for="txtStock" class="control-label">Stock</label>
                                                  <input class="form-control" id="txtStock" name="txtStock" type="text" placeholder="Cantidad en stock">
                                             </div>
                                             <div class="form-group">
                                                  <label for="txtDescripcion" class="control-label">Descripción</label>
                                                  <input class="form-control" id="txtDescripcion" name="txtDescripcion" type="text" placeholder="Descripción">
                                             </div>
                                        </div>
                                        <div class="col-md-6">
                                             <div class="form-group">
                                                  <label for="selecMedida" class="control-label">Medida</label>
                                                  <select class="form-control" name="selecMedida" id="selecMedida">
                                                       <option value="">Selecciona una opción</option>
                                                       <option value="KG">KG</option>
                                                       <option value="UNIDAD">UNIDAD</option>
                                                  </select>
                                             </div>
                                             <div class="form-group">
                                                  <label for="selecEstado" class="control-label">Estado</label>
                                                  <select class="form-control" name="selecEstado" id="selecEstado">
                                                       <option value="1">Activo</option>
                                                       <option value="0">Inactivo</option>
                                                  </select>
                                             </div>
                                        </div>
                                   </div>
                                   <div class="tile-footer">
                                        <button id="btnGuardar" class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Guardar</span></button>&nbsp;&nbsp;&nbsp;<a class="btn btn-danger" aria-label="Close" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
                                   </div>
                              </form>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>