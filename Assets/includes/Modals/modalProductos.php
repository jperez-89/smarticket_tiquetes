<!-- Modal -->
<div class="modal fade" id="modalProductos" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-hidden="true">
     <div class="modal-dialog">
          <div class="modal-content">
               <div class="modal-header headerRegister">
                    <h5 class="tile-title" id="titleModal">New Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                    </button>
               </div>
               <div class="modal-body">
                    <div class="tile">
                         <div class="tile-body">
                              <form id="frmProducto" name="frmProducto">
                                   <input type="hidden" name="idProducto" id="idProducto" value="">
                                   <div class="form-group">
                                        <label class="control-label">Name</label>
                                        <input class="form-control" id="txtNombre" name="txtNombre" type="text" placeholder="Name of product">
                                   </div>
                                   <div class="form-group">
                                        <label class="control-label">Price</label>
                                        <input class="form-control" id="txtPrecio" name="txtPrecio" type="text" placeholder="Price of product">
                                   </div>
                                   <div class="form-group">
                                        <label class="control-label">Stock</label>
                                        <input class="form-control" id="txtStock" name="txtStock" type="text" placeholder="Quantity in stock">
                                   </div>
                                   <div class="form-group">
                                        <label class="control-label">Description</label>
                                        <input class="form-control" id="txtDescripcion" name="txtDescripcion" type="text" placeholder="Description">
                                   </div>
                                   <div class="form-group">
                                        <label class="control-label">Measure</label>
                                        <select class="form-control" name="selecMedida" id="selecMedida">
                                             <option value="">Select...</option>
                                             <option value="KG">KG</option>
                                             <option value="UNIDAD">UNIDAD</option>
                                        </select>
                                   </div>
                                   <div class="form-group">
                                        <label class="control-label">State</label>
                                        <select class="form-control" name="selecEstado" id="selecEstado">
                                             <option value="1">Active</option>
                                             <option value="0">Inactive</option>
                                        </select>
                                   </div>
                                   <div class="tile-footer">
                                        <button id="btnGuardar" class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Save</span></button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" aria-label="Close" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                                   </div>
                              </form>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>