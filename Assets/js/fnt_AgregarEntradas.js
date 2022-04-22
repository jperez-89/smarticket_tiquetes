var tblEntradas, arrEventos, arrTipoEntradas, idEvento, idTipoEvento;
const selecEventos = document.getElementById("selecEventos");
const selecTipoEntradas = document.getElementById("selecTipoEntradas");

// Funcion para autocargar el datatable
document.addEventListener("DOMContentLoaded", function () {
     CargaSelectEventos();
     CargaSelectTipoEntradas();

     tblEntradas = $("#tblEntradas").DataTable({
          aProcessing: true,
          aServerSide: true,
          dom: "Bfrtip",
          languaje: {
               url: "//cnd.datatables.net/plug-ins/1.10.20/i18n/spanish.json",
          },
          ajax: {
               url: ` ${base_url}/Entradas/getEntradas`,
               dataSrc: "",
          },
          columns: [
               {
                    data: "idEntrada",
               },
               {
                    data: "nombreEvento",
               },
               {
                    data: "nombreTipoEntrada",
               },
               {
                    data: "CantidadEntradas",
               },
               {
                    data: "PrecioUnitario",
               },
               {
                    data: "EntradasDisponibles",
               },
               {
                    data: "LimiteCompra",
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
     const frmEntradas = document.querySelector("#frmEntradas");
     frmEntradas.onsubmit = function (e) {
          e.preventDefault();

          // Extraemos los datos
          const idEntrada = document.querySelector("#idEntrada").value;
          const selecEventos = document.querySelector("#selecEventos").value;
          const selecTipoEntradas = document.querySelector("#selecTipoEntradas").value;
          const txtCantidadEntradas = document.querySelector("#txtCantidadEntradas").value;
          const txtPrecioUnitario = document.querySelector("#txtPrecioUnitario").value;
          const txtLimiteCompra = document.querySelector("#txtLimiteCompra").value;
          const selecEstado = document.querySelector("#selecEstado").value;

          // Validamos si los campos estan vacios para mostrar alerta
          if (
               selecEventos == "" || selecTipoEntradas == "" || txtCantidadEntradas == "" || selecEstado == "" || txtPrecioUnitario == "" || txtLimiteCompra == ""
          ) {
               swal("Atención", "Todos los campos son obligatorios", "error");
               return false;
          }

          const url = `${base_url}Entradas/setEntrada`;
          frmDatos = new FormData(this)

          const response = fnt_Fetch(url, 'post', frmDatos)
          response.then(objData => {
               if (objData.status) {
                    // Reseteamos los campos del formulario
                    frmEntradas.reset();
                    // Cerramos el modal
                    $("#modalAgregarEntrada").modal("hide");
                    // Enviamos mensaje de exito
                    swal("Agregar Entradas", objData.msg, "success");
                    // Recargamos la tabla
                    tblEntradas.ajax.reload();
               } else {
                    // Mostramos error
                    swal("Error", objData.msg, "error");
               }
          })
     };
});

function CargaSelectEventos() {
     const url = `${base_url}eventos/getEventos`;
     fetch(url)
          .then(response => response.json())
          .then(data => {
               // if (data.status) {
               selecEventos.options[0] = new Option("Selecciona un Evento", "0");
               arrEventos = data;

               for (let i = 1; i <= arrEventos.length; i++) {
                    selecEventos.options[i] = new Option(
                         arrEventos[i - 1]["nombreEvento"],
                         arrEventos[i - 1]["idEvento"]
                    );
               }
               // } else {
               //      swal("Error", data.msg, "error");
               // }
          });
}

function CargaSelectTipoEntradas() {
     const url = `${base_url}entradas/getTipoEntradas`;
     fetch(url)
          .then(response => response.json())
          .then(data => {
               // if (data.status) {
               selecTipoEntradas.options[0] = new Option("Selecciona un Tipo de Entrada", "0");
               arrTipoEntradas = data;
               // console.log(arrTipoEntradas);

               for (let i = 1; i <= arrTipoEntradas.length; i++) {
                    selecTipoEntradas.options[i] = new Option(
                         arrTipoEntradas[i - 1]["nombreTipoEntrada"],
                         arrTipoEntradas[i - 1]["idTipoEntrada"]
                    );
               }
               // } else {
               //      swal("Error", data.msg, "error");
               // }
          });
}

function fntEditEntrada(idEntrada) {
     document.querySelector("#titleModal").innerHTML = "Actualizar Entrada";
     document.querySelector(".modal-header").classList.replace("headerRegister", "headerUpdate");
     document.querySelector("#btnGuardar").classList.replace("btn-primary2", "btn-danger2");
     document.querySelector("#btnText").innerHTML = "Actualizar";

     const url = `${base_url}Entradas/getEntrada/${idEntrada}`;

     const response = fnt_Fetch(url)
     response.then(Info => {
          if (Info.status) {
               // SETEO DE DATOS
               document.querySelector("#idEntrada").value = Info.data.idEntrada;
               document.querySelector("#txtPrecioUnitario").value = Info.data.PrecioUnitario;
               document.querySelector("#txtCantidadEntradas").value = Info.data.CantidadEntradas;
               document.querySelector("#txtLimiteCompra").value = Info.data.LimiteCompra;

               // SETEO DE SELECT´S
               selecEventos.selectedIndex = Info.data.idEvento;
               selecTipoEntradas.selectedIndex = Info.data.idTipoEntrada;

               // MOSTRAMOS EL MODAL
               $("#modalAgregarEntrada").modal("show");
          } else {
               // MOSTRAMOS ERROR
               swal("Error", Info.msg, "error");
          }
     })
}

// DESPLIEGA EL MODAL
function OpenModal() {
     document.querySelector("#idEntrada").value = "";
     document.querySelector("#titleModal").innerHTML = "Agregar Entradas a Evento";
     document.querySelector(".modal-header").classList.replace("headerUpdate", "headerRegister");
     document.querySelector("#btnGuardar").classList.replace("btn-danger2", "btn-primary2");
     document.querySelector("#btnText").innerHTML = "Guardar";
     document.querySelector("#lstselecEventos").style.display = "block";
     document.querySelector("#lstselecTipoEntradas").style.display = "block";
     document.querySelector("#lstEntrada").style.display = "block";
     document.querySelector("#frmEntradas").reset();
     $("#modalAgregarEntrada").modal("show");
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
     $("#modalAgregarEntrada").modal('hide')
});