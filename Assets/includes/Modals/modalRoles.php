<!-- Modal -->
<div class="modal fade" id="modalRoles" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-hidden="true">
     <div class="modal-dialog">
          <div class="modal-content">
               <div class="modal-header headerRegister">
                    <h5 class="tile-title" id="titleModal">Nuevo Rol</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                    </button>
               </div>
               <div class="modal-body">
                    <div class="tile">
                         <div class="tile-body">
                              <form id="frmRoles" name="frmRoles">
                                   <input type="hidden" name="idRol" id="idRol" value="">
                                   <div class="row">
                                        <div class="col-md-12">
                                             <div class="form-group">
                                                  <label for="txtNombreRol" class="control-label">Nombre</label>
                                                  <input class="form-control" id="txtNombreRol" name="txtNombreRol" type="text" placeholder="Nombre del rol">
                                             </div>
                                             <div class="form-group">
                                                  <label for="txtDescripcionRol" class="control-label">Descripción</label>
                                                  <input class="form-control" id="txtDescripcionRol" name="txtDescripcionRol" type="text" placeholder="Descripción">
                                             </div>
                                             <div class="form-group">
                                                  <label for="selecEstadoRol" class="control-label">Estado</label>
                                                  <select class="form-control" name="selecEstadoRol" id="selecEstadoRol">
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