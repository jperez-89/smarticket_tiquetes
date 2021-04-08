<!-- Modal -->
<div class="modal fade" id="modalUsuarios" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-hidden="true">
     <div class="modal-dialog modal-lg">
          <div class="modal-content">
               <div class="modal-header headerRegister">
                    <h5 class="tile-title" id="titleModal">Nuevo Usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                    </button>
               </div>
               <div class="modal-body">
                    <div class="tile">
                         <div class="tile-body">
                              <form id="frmUsuarios" name="frmUsuarios">
                                   <input type="hidden" name="idUsuario" id="idUsuario" value="">
                                   <div class="">
                                        <div class="row">
                                             <div class="col-md-3">
                                                  <div class="form-group">
                                                       <label for="txtDNI" class="control-label">Identificación</label>
                                                       <input class="form-control" id="txtDNI" name="txtDNI" type="text" placeholder="Identificación usuario">
                                                  </div>
                                             </div>
                                             <div class="col-md-3">
                                                  <div class="form-group">
                                                       <label for="txtNombre" class="control-label">Nombre</label>
                                                       <input class="form-control" id="txtNombre" name="txtNombre" type="text" placeholder="Nombre usuario">
                                                  </div>
                                             </div>
                                             <div class="col-md-4">
                                                  <div class="form-group">
                                                       <label for="txtApellidos" class="control-label">Apellidos</label>
                                                       <input class="form-control" id="txtApellidos" name="txtApellidos" type="text" placeholder="Apellidos usuario">
                                                  </div>
                                             </div>
                                             <div class="col-md-2">
                                                  <div class="form-group">
                                                       <label for="txtTelefono" class="control-label">Teléfono</label>
                                                       <input class="form-control" id="txtTelefono" name="txtTelefono" type="text" placeholder="Teléfono usuario">
                                                  </div>
                                             </div>
                                        </div>

                                        <div class="row">
                                             <div class="col-md-4">
                                                  <div class="form-group">
                                                       <label for="txtEmail" class="control-label">Email</label>
                                                       <input class="form-control" id="txtEmail" name="txtEmail" type="email" placeholder="Email usuario">
                                                  </div>
                                             </div>
                                             <div class="col-md-4">
                                                  <div class="form-group">
                                                       <label for="txtUsuario" class="control-label">Usuario</label>
                                                       <input class="form-control" id="txtUsuario" name="txtUsuario" type="text" placeholder="Usuario">
                                                  </div>
                                             </div>
                                             <div class="col-md-4">
                                                  <div class="form-group">
                                                       <label for="txtContra" class="control-label">Contraseña</label>
                                                       <input class="form-control" id="txtContra" name="txtContra" type="text" placeholder="Contraseña">
                                                  </div>
                                             </div>
                                        </div>

                                        <div class="row">
                                             <div class="col-md-4">
                                                  <div class="form-group">
                                                       <label for="selecRol" class="control-label">Rol</label>
                                                       <select class="form-control" name="selecRol" id="selecRol">
                                                            <!-- <option value="">Selecciona una opción</option> -->
                                                            <!-- <option value="1">Admin</option> -->
                                                            <!-- <option value="2">Otro</option> -->
                                                       </select>
                                                  </div>
                                             </div>
                                             <!-- <div class="col-md-4">
                                                  <div class="form-group">
                                                       <label for="imgUsuario" class="control-label">Foto</label>
                                                       <div class="custom-file">
                                                            <input type="file" class="custom-file-input" name="imgUsuario" id="imgUsuario" lang="es">
                                                            <label class="custom-file-label" for="imgUsuario">Buscar foto</label>
                                                       </div>
                                                  </div>
                                             </div> -->
                                             <div class="form-group" id="lstUser">
                                                  <div class="col-md-4">
                                                       <div class="form-group">
                                                            <label for="selecEstado" class="control-label">Estado</label>
                                                            <select class="form-control" name="selecEstado" id="selecEstado">
                                                                 <option value="1">Activo</option>
                                                                 <option value="0">Inactivo</option>
                                                            </select>
                                                       </div>
                                                  </div>
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