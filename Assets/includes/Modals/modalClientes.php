<!-- Modal -->
<div class="modal fade" id="modalClientes" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-hidden="true">
     <div class="modal-dialog modal-lg">
          <div class="modal-content">
               <div class="modal-header headerRegister">
                    <h5 class="tile-title" id="titleModal">Nuevo Cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                    </button>
               </div>
               <div class="modal-body">
                    <div class="tile">
                         <div class="tile-body">
                              <form id="frmClientes" name="frmClientes">
                                   <input type="hidden" name="idCliente" id="idCliente" value="">
                                   <div class="row">
                                        <div class="col-md-6">
                                             <div class="form-group">
                                                  <label for="txtIdentificacion" class="control-label">Identificación</label>
                                                  <input class="form-control" id="txtIdentificacion" name="txtIdentificacion" type="text" placeholder="Física o jurídica">
                                             </div>
                                             <div class="form-group">
                                                  <label for="txtNombre" class="control-label">Nombre</label>
                                                  <input class="form-control" id="txtNombre" name="txtNombre" type="text" placeholder="Nombre o razón social">
                                             </div>
                                             <div class="form-group">
                                                  <label for="txtTelefono" class="control-label">Teléfono</label>
                                                  <input class="form-control" id="txtTelefono" name="txtTelefono" type="text" placeholder="Teléfono">
                                             </div>
                                             <div class="form-group">
                                                  <label for="txtEmail" class="control-label">Email</label>
                                                  <input class="form-control" id="txtEmail" name="txtEmail" type="email" placeholder="Email">
                                             </div>
                                        </div>

                                        <div class="col-md-6">
                                             <div class="form-group">
                                                  <label for="selecProvincia" class="control-label">Provincia</label>
                                                  <select onchange="CargaCanton(this.value);" class="form-control" name="selecProvincia" id="selecProvincia">

                                                  </select>
                                             </div>
                                             <div class="form-group">
                                                  <label for="selecCanton" class="control-label">Cantón</label>
                                                  <select onchange="CargaDistrito(this.value);" class="form-control" name="selecCanton" id="selecCanton">
                                                  </select>
                                             </div>
                                             <div class="form-group">
                                                  <label for="selecDistrito" class="control-label">Distrito</label>
                                                  <select class="form-control" name="selecDistrito" id="selecDistrito">
                                                  </select>
                                             </div>
                                             <div class="form-group">
                                                  <label for="txtDireccion" class="control-label">Dirección</label>
                                                  <input class="form-control" id="txtDireccion" name="txtDireccion" type="text" placeholder="Dirección exacta">
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