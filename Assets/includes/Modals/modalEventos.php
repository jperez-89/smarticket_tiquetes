<!-- Modal -->
<div class="modal fade" id="modalEvento" aria-labelledby="titleModal" role="dialog" tabindex="-1" aria-hidden="true">
     <div class="modal-dialog">
          <div class="modal-content">
               <div class="modal-header headerRegister">
                    <h5 class="tile-title" id="titleModal">Nuevo Evento</h5>
                    <button type="button" class="close cerrarModal" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                    </button>
               </div>
               <div class="modal-body">
                    <div class="tile">
                         <div class="tile-body">
                              <form id="frmEvento" name="frmEvento">
                                   <input type="hidden" name="idEvento" id="idEvento" value="0">
                                   <div class="row">
                                        <div class="col-md-6">
                                             <div class="form-group">
                                                  <label for="txtNombre" class="control-label">Nombre</label>
                                                  <input class="form-control" id="txtNombre" name="txtNombre" type="text" placeholder="Nombre del evento">
                                             </div>
                                        </div>
                                        <div class="col-md-6">
                                             <div class="form-group" id="lstEventos">
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