var tblTipoEntradas;

// Funcion para autocargar el datatable
document.addEventListener("DOMContentLoaded", function () {
     tblTipoEntradas = $("#tblTipoEntradas").DataTable({
          aProcessing: true,
          aServerSide: true,
          dom: "Bfrtip",
          // buttons: [{
          //           extend: "excel",
          //           titleAttr: "Exportar a Excel",
          //           text: '<i class="fas fa-file-excel" aria-hidden="true"></i> Excel',
          //           className: "",
          //      },
          //      {
          //           extend: "pdf",
          //           titleAttr: "Exportar a PDF",
          //           text: '<i class="far fa-file-pdf" aria-hidden="true"></i> PDF',
          //           className: "",
          //      },
          // ],
          languaje: {
               url: "//cnd.datatables.net/plug-ins/1.10.20/i18n/spanish.json",
          },
          ajax: {
               url: ` ${base_url}/Entradas/getTipoEntradas`,
               dataSrc: "",
          },
          columns: [{
                    data: "idTipoEntrada",
               },
               {
                    data: "nombreTipoEntrada",
               },
               {
                    data: "Status",
               },
               {
                    data: "options",
               },
          ],
          responsive: "true",
          bDestroy: true,
          iDisplayLenght: 10,
          order: [
               [0, "desc"]
          ],
     });

     // REGISTRO
     const frmTipoEntrada = document.querySelector("#frmTipoEntrada");
     frmTipoEntrada.onsubmit = function (e) {
          e.preventDefault();

          // Extraemos los datos
          const idTipoEntrada = document.querySelector("#idTipoEntrada").value;
          const txtNombre = document.querySelector("#txtNombre").value;
          const selecEstado = document.querySelector("#selecEstado").value;

          // Validamos si los campos estan vacios para mostrar alerta
          if (
               txtNombre == "" ||
               selecEstado == ""
          ) {
               swal("Atención", "Todos los campos son obligatorios", "error");
               return false;
          }

          const url = `${base_url}Entradas/setTipoEntrada`;
          frmDatos = new FormData(this)

          const response = fnt_Fetch(url, 'post', frmDatos)
          response.then(objData => {
               if (objData.status) {
                    // Reseteamos los campos del formulario
                    frmTipoEntrada.reset();
                    // Cerramos el modal
                    $("#modalTipoEntradas").modal("hide");
                    // Enviamos mensaje de exito
                    swal("Tipo Entrada", objData.msg, "success");
                    // Recargamos la tabla
                    tblTipoEntradas.ajax.reload();
               } else {
                    // Mostramos error
                    swal("Error", objData.msg, "error");
               }
          })
     };
});

function fntEditTipoEntrada(idTipoEntrada) {
     document.querySelector("#titleModal").innerHTML = "Actualizar Tipo Entrada";
     document.querySelector(".modal-header").classList.replace("headerRegister", "headerUpdate");
     document.querySelector("#btnGuardar").classList.replace("btn-primary2", "btn-danger2");
     document.querySelector("#btnText").innerHTML = "Actualizar";

     const url = `${base_url}Entradas/getTipoEntrada/${idTipoEntrada}`;

     const response = fnt_Fetch(url)
     response.then(response => {
          if (response.status) {
               // MOSTRAMOS LOS DATOS EN LOS CAMPOS DE TEXTO
               document.querySelector("#idTipoEntrada").value = response.data.idTipoEntrada;
               document.querySelector("#txtNombre").value = response.data.nombreTipoEntrada;
               document.querySelector("#lstTipoEntrada").style.display = "none";

               // VALIDA EL ESTADO
               if (response.data.Status == 1) {
                    var select = '<option value="1" selected class="notBlock">Activo</option>';
               } else if (response.data.Status == 0) {
                    var select = '<option value="0" selected class="notBlock">Inactivo</option>';
               }
               const htmlSelectEstado = `${select}
                   <option value="1">Activo</option>
                   <option value="0">Inactivo</option>`;
               document.querySelector("#selecEstado").innerHTML = htmlSelectEstado;

               // MOSTRAMOS EL MODAL
               $("#modalTipoEntradas").modal("show");
          } else {
               // MOSTRAMOS ERROR
               swal("Error", response.msg, "error");
          }
     })
}

function fntDeleteTipoEntrada(idTipoEntrada) {
     swal({
               title: "Deshabilitar Tipo Entrada",
               text: "Realmente quiere deshabilitar el Tipo de Entrada?",
               type: "warning",
               showCancelButton: true,
               confirmButtonText: "Sí, Deshabilitar!",
               cancelButtonText: "No, cancelar!",
               closeOnConfirm: false,
               closeOnCancel: true,
          },
          (isConfirm) => {
               if (isConfirm) {
                    const url = `${base_url}Entradas/deleteTipoEntrada/`;
                    const frm = new FormData()
                    frm.append('idTipoEntrada', idTipoEntrada)

                    const response = fnt_Fetch(url, 'post', frm)
                    response.then(objData => {
                         if (objData.status) {
                              swal("Eliminar!", objData.msg, "success");
                              tblTipoEntradas.ajax.reload();
                         } else {
                              swal("Atencion!", objData.msg, "error");
                         }
                    })
               }
          })
}

function fntEnableTipoEntrada(idTipoEntrada) {
     swal({
               title: "Habilitar Tipo Entrada",
               text: "Realmente quiere Habilitar el Tipo Entrada?",
               type: "info",
               showCancelButton: true,
               confirmButtonText: "Sí, Habilitar!",
               cancelButtonText: "No, cancelar!",
               closeOnConfirm: false,
               closeOnCancel: true,
          },
          (isConfirm) => {
               if (isConfirm) {

                    const url = `${base_url}Entradas/enableTipoEntrada/`;

                    // Ejecutar petición por medio de elemento request
                    const frm = new FormData()
                    frm.append('idTipoEntrada', idTipoEntrada)

                    const response = fnt_Fetch(url, 'post', frm)
                    response.then(objData => {
                         if (objData.status) {
                              swal("Habilitar!", objData.msg, "success");
                              tblTipoEntradas.ajax.reload();
                         } else {
                              swal("Atencion!", objData.msg, "error");
                         }
                    })
               }
          })
}

// DESPLIEGA EL MODAL
function OpenModal() {
     document.querySelector("#idTipoEntrada").value = "";
     document.querySelector("#titleModal").innerHTML = "Nuevo Tipo Entrada";
     document.querySelector(".modal-header").classList.replace("headerUpdate", "headerRegister");
     document.querySelector("#btnGuardar").classList.replace("btn-danger2", "btn-primary2");
     document.querySelector("#btnText").innerHTML = "Guardar";
     document.querySelector("#lstTipoEntrada").style.display = "block";
     document.querySelector("#frmTipoEntrada").reset();
     $("#modalTipoEntradas").modal("show");
}

function fnt_Fetch(url, method = '', Databody) {
     var jsonResponse;

     if (method == 'post') {
          jsonResponse = fetch(url, {
               method: method,
               body: Databody
          }).then(res => res.json())
     } else {
          jsonResponse = fetch(url).then(res => res.json())
     }
     return jsonResponse;
}

$(".cerrarModal").click(function () {
     $("#modalTipoEntradas").modal('hide')
});