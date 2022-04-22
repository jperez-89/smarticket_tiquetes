var tblReservaEntradas, idEvento, selecTipoEntradas, idCliente, arrEventos, arrTipoEntradas, PrecUnit, LimiteCompra;
const selecEventos = document.getElementById("selecEventos");
selecTipoEntradas = document.getElementById("selecTipoEntradas");

// Carga automática de procesos y de la información de la tabla
document.addEventListener("DOMContentLoaded", function () {
     CargaSelectEventos();

     // Mostrar los datos en la tabla
     tblReservaEntradas = $("#tblReservaEntradas").DataTable({
          aProcessing: true,
          aServerSide: true,
          dom: "Bfrtip",
          languaje: {
               url: "//cdn.datatables.net/plug-ins/1.10.16/i18n/es-ES.json",
          },
          ajax: {
               url: ` ${base_url}/ventas/getVentas`,
               dataSrc: "",
          },
          columns: [{
                    data: "idReservaEntrada",
               },
               {
                    data: "nombreCliente",
               },
               {
                    data: "nombreEvento",
               },
               {
                    data: "nombreTipoEntrada",
               },
               {
                    data: "PrecioEntrada",
               },
               {
                    data: "cantEntradas",
               },
               {
                    data: "TotalPagar",
               },
               {
                    data: "tipoReserva",
               },
               {
                    data: "options",
               }
          ],
          // "columnDefs": [
          //      {
          //           "width": "5%",
          //           "targets": 0
          //      },
          //      {
          //           "width": "5%",
          //           "targets": 4
          //      },
          //      {
          //           "width": "5%",
          //           "targets": 5
          //      },
          //      {
          //           "width": "8%",
          //           "targets": 6
          //      },
          //      {
          //           "width": "8%",
          //           "targets": 7
          //      },
          //      {
          //           "width": "18%",
          //           "targets": 8
          //      }
          // ],
          responsive: "true",
          bDestroy: true,
          iDisplayLenght: 10,
          order: [
               [0, "desc"]
          ],
     });
})

// Funcion para la busqueda del cliente por el número de teléfono
function BuscarCliente(txtTelefono) {
     document.querySelector("#txtTelefono").removeAttribute("style");
     if (txtTelefono.length == 0) {
          document.querySelector("#txtNombre").value = "";
          document.querySelector("#txtEmail").value = "";
          return;
     } else if (txtTelefono.length == 8) {
          const url = `${base_url}ventas/getCliente/${txtTelefono}`;
          const response = fnt_Fetch(url);
          response.then((Info) => {
               document.querySelector("#idCliente").value = Info.data.idCliente;
               document.querySelector("#txtNombre").value = Info.data.nombreCliente;
               document.querySelector("#txtEmail").value = Info.data.emailCliente;
          });
     }
}

// Funcion para la carga del select de eventos
function CargaSelectEventos() {
     const url = `${base_url}ventas/getEventos`;
     fetch(url)
          .then((response) => response.json())
          .then((data) => {
               selecEventos.options[0] = new Option("Selecciona un Evento", "0");
               arrEventos = data;

               for (let i = 1; i <= arrEventos.length; i++) {
                    selecEventos.options[i] = new Option(
                         arrEventos[i - 1]["nombreEvento"],
                         arrEventos[i - 1]["idEvento"]
                    );
               }
          });
}

// Funcion para la carga del select de tipo de eventos
function CargaSelectTipoEntradas(idEvento) {
     idEvento = idEvento;
     document.querySelector("#Stock").value = "";

     //Elimina los items cuando se elige otro evento
     var lengthTipoEntradas = selecTipoEntradas.length;
     for (var i = lengthTipoEntradas; i >= 0; i--) {
          selecTipoEntradas.options[i] = null;
     }

     const url = `${base_url}ventas/getTipoEntradas/${idEvento}`;
     fetch(url)
          .then((response) => response.json())
          .then((data) => {
               selecTipoEntradas.options[0] = new Option("Selecciona un Tipo de Entrada", "0");
               arrTipoEntradas = data;

               for (let i = 1; i <= arrTipoEntradas.length; i++) {
                    // console.log(arrTipoEntradas[i - 1]["idTipoEntrada"] ,arrTipoEntradas[i - 1]["idEvento"]);

                    selecTipoEntradas.options[i] = new Option(
                         arrTipoEntradas[i - 1]["nombreTipoEntrada"],
                         arrTipoEntradas[i - 1]["idTipoEntrada"]
                    );
               }
          });
}

// Funcion que toma los id del evento y tipo de evento para la busqueda del saldo disponible de entradas
function BuscaEntradasDisponibles(idTipoEntrada) {
     idEvento = selecEventos.value;
     data = new FormData();
     data.append("idEvento", idEvento);
     data.append("idTipoEntrada", idTipoEntrada)

     const url = `${base_url}ventas/getCantidadEntradas/`;
     const response = fnt_Fetch(url, 'post', data);
     response.then((Info) => {
          LimiteCompra = Info.data.LimiteCompra;
          swal("Recordatorio", `El límite de entradas para compra por cliente es de ${LimiteCompra}`, "warning");
          document.querySelector("#Stock").value = Info.data.EntradasDisponibles;
          PrecUnit = Info.data.PrecioUnitario
          document.querySelector("#Precio").value = PrecUnit;
     });
}

// Evento para validar que la cantidad de compra este dentro del limite definido por cliente
var txtcantEntradas = document.getElementById("cantEntradas");
txtcantEntradas.addEventListener('focusout', (e) => {
     var cEntradas = parseInt(txtcantEntradas.value);
     if (cEntradas > parseInt(LimiteCompra)) {
          swal("Error", `El límite de entradas por cliente es de ${LimiteCompra}`, "error");
     } else {
          CalculaTotalPagar(cantEntradas.value);
     }
})

// Funcion que calcula el monto a pagar por el cliente
function CalculaTotalPagar(CantEntradas) {
     document.querySelector("#txtTotalPagar").value = "";
     if (PrecUnit > 0) {
          var PrecTotal = PrecUnit * CantEntradas;
          document.querySelector("#txtTotalPagar").value = PrecTotal;
     } else {
          swal("Error", "Seleccione el evento y el tipo de entrada, por favor", "error");
     }
}

// Función para setear la reserva de entradas
const frmReservaEntradas = document.querySelector("#frmReservaEntradas");
frmReservaEntradas.onsubmit = function (e) {
     e.preventDefault();

     const idCliente = document.querySelector("#idCliente").value;
     const txtTelefono = document.querySelector("#txtTelefono").value;
     const txtNombre = document.querySelector("#txtNombre").value;
     const txtEmail = document.querySelector("#txtEmail").value;
     const idEvento = selecEventos.value;
     const idTipoEntradas = selecTipoEntradas.value;
     const Precio = document.querySelector("#Precio").value;
     const cantEntradas = document.querySelector("#cantEntradas").value;
     const TotalPagar = document.querySelector("#txtTotalPagar").value;

     if (
          txtTelefono == "" ||
          txtEmail == "" ||
          idEvento == "" ||
          idTipoEntradas == "" ||
          cantEntradas == ""
     ) {
          document.querySelector("#txtTelefono").style.border = "1px solid red";
          document.querySelector("#txtTelefono").focus();
          swal("Atención", "Todos los campos son obligatorios", "error");

          return false;
     }

     const url = `${base_url}ventas/setReserva`;
     frmDatos = new FormData(this)
     frmDatos.append('op', 'insert');
     frmDatos.append('Precio', Precio);
     frmDatos.append('TotalPagar', TotalPagar);

     const response = fnt_Fetch(url, 'post', frmDatos)
     response.then(Info => {
          if (Info.status) {
               swal({
                         title: "Reserva de Entradas",
                         text: Info.msg,
                         type: "success",
                         confirmButtonText: "Ok",
                         closeOnConfirm: false,
                    },
                    (isConfirm) => {
                         if (isConfirm) {
                              // Reseteamos los campos del formulario
                              frmReservaEntradas.reset();
                              location.href = "http://localhost/smarticket_tiquetes/ventas/reserva_entradas";
                         }
                    })
          } else {
               // Mostramos error
               swal("Error", Info.msg, "error");
          }
     })
}


// function fntConfirmarEntrada(idEntrada) {
//      document.querySelector("#titleModal").innerHTML = "Actualizar Cliente";
//      document.querySelector(".modal-header").classList.replace("headerRegister", "headerUpdate");
//      document.querySelector("#btnGuardar").classList.replace("btn-primary2", "btn-danger2");
//      document.querySelector("#btnText").innerHTML = "Actualizar";

//      const url = `${base_url}Clientes/getCliente/${idCliente}`;

//      const response = fnt_Fetch(url)
//      response.then(InfoCliente => {
//           if (InfoCliente.status) {
//                // MOSTRAMOS LOS DATOS EN LOS CAMPOS DE TEXTO
//                document.querySelector("#idCliente").value = InfoCliente.data.idCliente;
//                document.querySelector("#txtNombre").value = InfoCliente.data.nombreCliente;
//                document.querySelector("#txtTelefono").value = InfoCliente.data.telefonoCliente;
//                document.querySelector("#txtEmail").value = InfoCliente.data.emailCliente;
//                document.querySelector("#lstEstado").style.display = "none";

//                // VALIDA EL ESTADO
//                if (InfoCliente.data.Status == 1) {
//                     var select = '<option value="1" selected class="notBlock">Activo</option>';
//                } else if (InfoCliente.data.Status == 0) {
//                     var select = '<option value="0" selected class="notBlock">Inactivo</option>';
//                }
//                const htmlSelectEstado = `${select}
//                    <option value="1">Activo</option>
//                    <option value="0">Inactivo</option>`;
//                document.querySelector("#selecEstado").innerHTML = htmlSelectEstado;

//                // MOSTRAMOS EL MODAL
//                $("#modalClientes").modal("show");
//           } else {
//                // MOSTRAMOS ERROR
//                swal("Error", InfoCliente.msg, "error");
//           }
//      })
// }

// Funcion para el seteo y busqueda de información
async function fnt_Fetch(url, method = "", Databody) {
     var jsonResponse;

     if (method == "post") {
          jsonResponse = await fetch(url, {
               method: method,
               body: Databody,
          }).then((res) => res.json());
     } else {
          jsonResponse = await fetch(url).then((res) => res.json());
     }
     return jsonResponse;
}