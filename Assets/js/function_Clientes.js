var tblClientes, arrProvincias, arrCantones, arrDistritos, IdCa, idCanton, encontro, idCantonSeleccionado;
var selecProvincia = document.getElementById("selecProvincia");
var selecCanton = document.getElementById("selecCanton");
var selecDistrito = document.getElementById("selecDistrito");

document.addEventListener("DOMContentLoaded", function () {
  // Mostrar los datos en la tabla
  var tblClientes = $("#tblClientes").DataTable({
    aProcessing: true,
    aServerSide: true,
    sDom: "Bfrtip",
    buttons: [{
        extend: "excelHtml5",
        titleAttr: "Exportar a Excel",
        text: '<h6><i class="fas fa-file-excel" aria-hidden="true"></i> Excel <h6/> ',
        className: "btn btn-success btn-sm m-1",
      },
      {
        extend: "pdfHtml5",
        titleAttr: "Exportar a PDF",
        text: '<h6><i class="far fa-file-pdf" aria-hidden="true"></i> PDF <h6/>',
        className: "btn btn-danger btn-sm m-1",
      },
    ],
    languaje: {
      url: "//cnd.datatables.net/plug-ins/1.10.20/i18n/spanish.json",
    },
    ajax: {
      url: ` ${base_url}/Clientes/getClientes`,
      dataSrc: "",
    },
    columns: [{
        data: "Id",
      },
      {
        data: "Identificacion",
      },
      {
        data: "Nombre",
      },
      {
        data: "Telefono",
      },
      {
        data: "Email",
      },
      {
        data: "Direccion",
      },
      {
        data: "Actividad",
      },
      {
        data: "Regimen",
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

  // Registro de nuevo producto
  var frmClientes = document.getElementById("frmClientes");
  if (frmClientes != null) {
    frmClientes.onsubmit = function (e) {
      e.preventDefault();

      // Extraemos los datos
      var idCliente = document.querySelector("#idCliente").value;
      var txtIdentificacion = document.querySelector("#txtIdentificacion").value;
      var txtNombre = document.querySelector("#txtNombre").value;
      var txtTelefono = document.querySelector("#txtTelefono").value;
      var txtEmail = document.querySelector("#txtEmail").value;
      var selecProvincia = document.querySelector("#selecProvincia").value;
      var selecCanton = document.querySelector("#selecCanton").value;
      var selecDistrito = document.querySelector("#selecDistrito").value;
      var txtDireccion = document.querySelector("#txtDireccion").value;
      var txtActividad = document.querySelector("#txtActividad").value;
      var selecRegimen = document.querySelector("#selecRegimen").value;
      var selecEstado = document.querySelector("#selecEstado").value;

      // Validamos si los campos estan vacios para mostrar alerta
      if (
        txtIdentificacion == "" ||
        txtNombre == "" ||
        txtTelefono == "" ||
        txtEmail == "" ||
        selecProvincia == "" ||
        selecCanton == "" ||
        selecDistrito == "" ||
        txtDireccion == "" ||
        txtActividad == "" ||
        selecRegimen == "" ||
        selecEstado == ""
      ) {
        swal("Atención", "Todos los campos son obligatorios", "error");
        return false;
      }

      var url = `${base_url}Clientes/setCliente`;
      var frmData = new FormData(frmClientes);
      // impri(frmClientes);
      // impri(frmData);

      var request = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
      request.open('POST', url);
      request.send(frmData);

      request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
          impri('SE GUARDO LA INFO')
        }
      }

      // fetch(url, {
      //     method: 'POST',
      //     body: JSON.stringify(frmData),
      //     headers: {
      //       'Content-Type': 'application/json; charset=UTF-8',
      //     },
      //   })
      //   .then(res => {
      //     console.log(res.json())
      //   })
      // .then(json => {
      //   console.log('Entro al fetch', json);
      // })
      // .catch(error => console.log(error))



      // if (data.status) {
      //   // Reseteamos los campos del formulario de productos
      //   frmClientes.reset();
      //   // Cerramos el modal
      //   $("#modalClientes").modal("hide");
      //   // Enviamos mensaje de exito
      //   swal("Clientes", data.msg, "success");
      //   // Recargamos la tabla
      //   tblClientes.ajax.reload(function () {
      //     btnEditCliente();
      //     fntDeleteCliente()
      //   });
      // } else {
      //   // Mostramos error
      //   swal("Error", data.msg, "error");
      // }

      //=======================================================
      // METODO FETCH
      //========================================================

      // fetch(Url, {
      //     methods: 'post',
      //     headers: {
      //       'Accept': 'application/json, text/plain, */*',
      //       'Content-Type': 'application/json'
      //     },
      //     body: JSON.stringify(frmData)
      //   })
      //   .then(response => response.json())
      //   .then(objData => {
      //     if (objData.status) {
      //       // Reseteamos los campos del formulario de productos
      //       frmClientes.reset();
      //       // Cerramos el modal
      //       $("#modalClientes").modal("hide");
      //       // Enviamos mensaje de exito
      //       swal("Clientes", objData.msg, "success");
      //       // Recargamos la tabla
      //       tblClientes.ajax.reload(function () {
      //         btnEditCliente();
      //         fntDeleteCliente()
      //       });
      //     } else {
      //       // Mostramos error
      //       swal("Error", objData.msg, "error");
      //     }
      //   })
      //   .catch(error => console.log('Error...!! ', error))

      //=======================================================
      // METODO 
      //========================================================

      // var request = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
      //   Enviamos los datos por medio de ajax
      // request.open("POST", Url, true);
      // request.send(frmData);
      // request.onreadystatechange = function () {
      //   if (request.readyState == 4 && request.status == 200) {
      //     var objData = JSON.parse(request.responseText);

      //     if (objData.status) {
      //       // Reseteamos los campos del formulario de productos
      //       frmClientes.reset();
      //       // Cerramos el modal
      //       $("#modalClientes").modal("hide");
      //       // Enviamos mensaje de exito
      //       swal("Clientes", objData.msg, "success");
      //       // Recargamos la tabla
      //       tblClientes.ajax.reload(function () {
      //         btnEditCliente();
      //         fntDeleteCliente()
      //       });
      //     } else {
      //       // Mostramos error
      //       swal("Error", objData.msg, "error");
      //     }
      //   }
      // };
    };
  }
});

// RESETEA EL SELECT DE CANTONES
function resetListaCanton() {
  //Elimina los items cuando se elige otra Provincia
  var lengthddlCanton = selecCanton.length;
  for (var i = lengthddlCanton; i >= 0; i--) {
    selecCanton.options[i] = null;
  }
}

// RESETEA EL SELECT DE DISTRITOS
function resetListaDistrito() {
  //Elimina los items cuando se elige otra Provincia
  var lengthddlDistrito = selecDistrito.length;
  for (var i = lengthddlDistrito; i >= 0; i--) {
    selecDistrito.options[i] = null;
  }
}

// CARGA AUTOMATICA DE PROCESOS
window.addEventListener(
  "load",
  function () {
    CargaProvincia();
    btnEditCliente();
    fntDeleteCliente()
  },
  false
);

// FUNCION PARA EDITAR CLIENTE
function btnEditCliente() {
  resetListaDistrito();
  resetListaCanton();

  // Todos los elementos que tengan la clase
  var btnEditCliente = document.querySelectorAll(".btnEditCliente");
  // Por cada elemento le agregamos un evento click para mostrar el modal
  btnEditCliente.forEach(function (btnEditCliente) {
    btnEditCliente.addEventListener("click", function () {
      // Editar el estilo del modal
      document.querySelector("#titleModal").innerHTML = "Actualizar Cliente";
      document.querySelector(".modal-header").classList.replace("headerRegister", "headerUpdate");
      document.querySelector("#btnGuardar").classList.replace("btn-primary", "btn-info");
      document.querySelector("#btnText").innerHTML = "Actualizar";

      var idCliente = this.getAttribute("idCliente");
      var url = `${base_url}Clientes/getCliente/${idCliente}`;
      fetch(url)
        .then(res => res.json())
        .then(InfoCliente => {
          if (InfoCliente.status) {
            // MOSTRAMOS LOS DATOS A EDITAR
            document.querySelector("#idCliente").value = InfoCliente.data.Id;
            document.querySelector("#txtIdentificacion").value = InfoCliente.data.Identificacion;
            document.querySelector("#txtIdentificacion").disabled = true;
            document.querySelector("#txtNombre").value = InfoCliente.data.Nombre;
            document.querySelector("#txtTelefono").value = InfoCliente.data.Telefono;
            document.querySelector("#txtEmail").value = InfoCliente.data.Email;
            document.querySelector("#txtDireccion").value = InfoCliente.data.Direccion;
            document.querySelector("#txtActividad").value = InfoCliente.data.Actividad;

            var idProvincia = InfoCliente.data.idProvincia;

            // PROCESO PARA SELECCCIONAR LA PROVINCIA DEL CLIENTE
            selecProvincia.selectedIndex = idProvincia;

            // CARGA EL SELECT DE CANTONES CON EL ID DE PROVINCIA
            //arrCantones =
            // CargaCanton_Fetch(idProvincia);

            // PROCESO PARA SELECCCIONAR EL CANTON DEL CLIENTE
            idCanton = InfoCliente.data.idCanton;
            //idCantonSeleccionado =
            SeleccionaCantonCliente(idCanton, idProvincia);

            // CARGA EL SELECT DE DISTRITOS CON EL ID DEL CANTON
            // arrDistritos = CargaDistrito_Fetch(idCantonSeleccionado);

            // PROCESO PARA SELECCCIONAR EL DISTRITO DEL CLIENTE
            var idDistrito = InfoCliente.data.idDistrito;
            // SeleccionaDistritoCliente(idDistrito, idCantonSeleccionado);

            // main(idDistrito, idCantonSeleccionado)
            SelecDistriCliente(idDistrito, idCantonSeleccionado)
            // .then(res => res.json())
            // .catch(error => console.log(error))

            // VALIDA EL REGIMEN
            if (InfoCliente.data.Regimen == "Factura Electrónica") {
              var select = '<option value="Factura Electrónica" selected class="notBlock">Factura Electrónica</option>';
            } else if (InfoCliente.data.Regimen == "Simplificado") {
              var select = '<option value="Simplificado" selected class="notBlock">Simplificado</option>';
            }
            var htmlSelectRegimen = `${select}
                   <option value="Factura Electrónica">Factura Electrónica</option>
                   <option value="Simplificado">Simplificado</option>`;
            document.querySelector("#selecRegimen").innerHTML = htmlSelectRegimen;

            // VALIDA EL ESTADO
            if (InfoCliente.data.Status == 1) {
              var select = '<option value="1" selected class="notBlock">Activo</option>';
            } else if (InfoCliente.data.Status == 0) {
              var select = '<option value="0" selected class="notBlock">Inactivo</option>';
            }
            var htmlSelectEstado = `${select}
                   <option value="1">Activo</option>
                   <option value="0">Inactivo</option>`;
            document.querySelector("#selecEstado").innerHTML = htmlSelectEstado;

            // MOSTRAMOS EL MODAL
            $("#modalClientes").modal("show");
          } else {
            // MOSTRAMOS ERROR
            swal("Error", InfoCliente.msg, "error");
          }
        })
    });
  });
}

function fntDeleteCliente() {
  // Todos los elementos que tengan la clase
  var btnDeleteCliente = document.querySelectorAll(".btnDeleteCliente");
  // Por cada elemento le agregamos un evento click para mostrar el modal
  btnDeleteCliente.forEach(function (btnDeleteCliente) {
    btnDeleteCliente.addEventListener("click", function () {
      // Obtener los datos
      var idCliente = this.getAttribute("idCliente");

      swal({
          title: "Deshabilitar Cliente",
          text: "Realmente quiere Deshabilitar el Cliente?",
          type: "warning",
          showCancelButton: true,
          confirmButtonText: "Sí, Deshabilitar!",
          cancelButtonText: "No, cancelar!",
          closeOnConfirm: false,
          closeOnCancel: true,
        },
        (isConfirm) => {
          if (isConfirm) {
            /* Detecta en cual navegador se encuentra el usuario
                  Si está en chrome o firefox crea un elemento xmlhttprequest
                  sino crea un objeto activexobjet de microsoft
             */
            var request = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
            var url = `${base_url}Clientes/deleteClient/`;

            //   Enviamos los datos por medio de ajax
            request.open("POST", url);
            request.send(idCliente);
            request.onreadystatechange = function () {
              if (request.readyState == 4 && request.status == 200) {
                var objData = JSON.parse(request.responseText);

                if (objData.status) {
                  swal("Eliminar!", objData.msg, "success");
                  tblClientes.ajax.reload(function () {
                    btnEditCliente();
                    fntDeleteCliente();
                  });
                } else {
                  swal("Atencion!", objData.msg, "error");
                }
              }
            };
          }
        })



      // swal({
      //     title: "Deshabilitar Cliente",
      //     text: "Realmente quiere Deshabilitar el Cliente?",
      //     type: "warning",
      //     showCancelButton: true,
      //     confirmButtonText: "Sí, Deshabilitar!",
      //     cancelButtonText: "No, cancelar!",
      //     closeOnConfirm: false,
      //     closeOnCancel: true,
      //   },
      //   (isConfirm) => {
      //     if (isConfirm) {
      //       var url = `${base_url}Clientes/deleteClient/${idCliente}`;
      //       // var json = `{ "idCliente":${idCliente}}`;
      //       // var json = JSON.stringify({
      //       //   idCliente: idCliente
      //       // })
      //       var json = {
      //         idCliente: 1
      //       }

      //       fetch(url, {
      //           method: 'POST',
      //           headers: {
      //             // 'Accept': 'application/json, text/plain, */*',
      //             'Content-Type': 'application/json'
      //           },
      //           // body: JSON.stringify(json),
      //         })
      //         .then(res => res.json())
      //         .then(data => {
      //           console.log('Success', data)
      //         })
      //         .catch(error => console.log(`Error encontrado: ${error}`))
      //     }
      //   }
      // )
    })
  })
}

async function SeleccionaCantonCliente(idCanton, idProvincia) {
  const arrCantones = await CargaCanton_Fetch(idProvincia);

  for (let i = 0; i < arrCantones.length; i++) {
    if (idCanton == arrCantones[i].Id) {
      encontro = i + 1;
      selecCanton.selectedIndex = encontro;
      // selecCanton.options[IdCa].selected = true;
      idCantonSeleccionado = arrCantones[i].Id;
      break;
    }
  }
  return await idCantonSeleccionado;
}

// const main = async (idDistrito, idCantonSeleccionado) => {
//   try {
//     const varA = await SelecDistriCliente(idDistrito, idCantonSeleccionado)
//     return varA

//   } catch (error) {
//     throw error
//   }
// }

const SelecDistriCliente = async (idDistrito, idCantonSeleccionado) => {
  try {
    arrDistritos = await CargaDistrito_Fetch(idCantonSeleccionado);
    idCantonSeleccionado = await BuscarDistriSeleccionado(arrDistritos, idDistrito);

    return idCantonSeleccionado;

  } catch (error) {
    throw error
  }
}

// async function SeleccionaDistritoCliente(idDistrito, idCantonSeleccionado) {
//   arrDistritos = await CargaDistrito_Fetch(idCantonSeleccionado);

//   idCantonSeleccionado = await selec(arrDistritos, idDistrito);
//   return idCantonSeleccionado;
// }

const BuscarDistriSeleccionado = async (arrDistritos, idDistrito) => {
  for (let i = 0; i < arrDistritos.length; i++) {
    if (idDistrito == arrDistritos[i].Id) {
      encontro = i + 1;
      selecDistrito.selectedIndex = encontro;
      var idDistritoSeleccionado = arrDistritos[i].Id;
      break;
    }
  }
  return await idDistritoSeleccionado;
}

// LLENADO DEL SELEC PROVINCIA
function CargaProvincia() {
  var Url = base_url + "Clientes/getProvincia";
  fetch(Url)
    .then(response => response.json())
    .then(data => {
      if (data.status) {
        selecProvincia.options[0] = new Option("Selecciona una Provincia", "0");
        arrProvincias = data.data;

        for (let i = 1; i <= arrProvincias.length; i++) {
          selecProvincia.options[i] = new Option(
            arrProvincias[i - 1]["NombreProvincia"],
            arrProvincias[i - 1]["Id"]
          );
        }
      } else {
        swal("Error", data.msg, "error");
      }
    });
}

// FUNCION FETCH QUE CARGA EL SELECT DE CANTONES
async function CargaCanton_Fetch(IdProvincia) {
  resetListaCanton();
  resetListaDistrito();
  let Url = `${base_url}Clientes/getCanton/${IdProvincia}`;
  await fetch(Url)
    .then(response => response.json())
    .then(data => {
      if (data.status) {
        selecCanton.options[0] = new Option("Selecciona un Cantón", "0");
        arrCantones = data.data;

        // ASIGNAMOS LOS VALORES AL SELECT DE CANTONES
        for (let i = 1; i <= arrCantones.length; i++) {
          selecCanton.options[i] = new Option(
            arrCantones[i - 1]["NombreCanton"],
            arrCantones[i - 1]["Id"]
          );
        }
      } else {
        swal("Error", data.msg, "error");
      }
    });
  return arrCantones;
}

// FUNCION FETC QUE CARGA EL SELECT DE DISTRITOS
const CargaDistrito_Fetch = async (idCantonSeleccionado) => {
  // resetListaDistrito();
  let Url = `${base_url}Clientes/getDistrito/${idCantonSeleccionado}`;
  await fetch(Url)
    .then(response => response.json())
    .then(data => {
      if (data.status) {
        selecDistrito.options[0] = new Option("Selecciona un Distrito", "0");
        arrDistritos = data.data;

        // ASIGNAMOS LOS VALORES AL SELECT DE DISTRITOS
        for (let i = 1; i <= arrDistritos.length; i++) {
          selecDistrito.options[i] = new Option(
            arrDistritos[i - 1]["nombreDistrito"],
            arrDistritos[i - 1]["Id"]
          );
        }
      } else {
        swal("Error", data.msg, "error");
      }
    });
  return arrDistritos;
}

// DESPLIEGA EL MODAL
function OpenModal() {
  resetListaCanton();
  resetListaDistrito();
  document.querySelector("#idCliente").value = "";
  document.querySelector("#titleModal").innerHTML = "Nuevo Cliente";
  document
    .querySelector(".modal-header")
    .classList.replace("headerUpdate", "headerRegister");
  document
    .querySelector("#btnGuardar")
    .classList.replace("btn-info", "btn-primary");
  document.querySelector("#btnText").innerHTML = "Guardar";
  document.querySelector("#frmClientes").reset();
  $("#modalClientes").modal("show");
}

function impri(data) {
  console.log(data)
}

// ---------------------- FUNCIONES NO USADAS -----------------------------------------------
// FUNCION QUE LLENA EL COMBO DE DISTRITO AL SELECCIONAR UN CANTON
// function CargaDistrito(idCanton) {
//   var request = window.XMLHttpRequest ?
//     new XMLHttpRequest() :
//     new ActiveXObject("Microsoft.XMLHTTP");
//   var Url = `${base_url}Clientes/getDistrito/${idCanton}`;
//   request.open("GET", Url);
//   request.send();

//   request.onreadystatechange = function () {
//     if (request.readyState == 4 && request.status == 200) {
//       selecDistrito.options[0] = new Option("Selecciona un Distrito", "0");
//       Distritos = JSON.parse(request.responseText);

//       for (let i = 1; i <= Distritos.length; i++) {
//         selecDistrito.options[i] = new Option(
//           Distritos[i - 1]["nombreDistrito"],
//           Distritos[i - 1]["Id"]
//         );
//       }
//     }
//   };
//   return Distritos;
// }

// FUNCION QUE LLENA EL COMBO DE CANTON AL SELECCIONAR UNA PROVINCIA
// function CargaCanton(idProvincia) {
//   // VERIFICAMOS QUE TIPO DE NAVEGADOR UTILIZA EL CLIENTE
//   var request = window.XMLHttpRequest ?
//     new XMLHttpRequest() :
//     new ActiveXObject("Microsoft.XMLHTTP");

//   // OBTENEMOS LOS CANTONES ENVIANDO EL ID DE LA PROVINCIA
//   var Url = `${base_url}Clientes/getCanton/${idProvincia}`;
//   request.open("GET", Url, true);
//   request.send();

//   request.onreadystatechange = function () {
//     // VALIDAMOS QUE NOS RETORNE DATOS
//     if (request.readyState == 4 && request.status == 200) {
//       // AGREGAMOS UNA OPCION DEFAULT AL SELECT
//       selecCanton.options[0] = new Option("Selecciona un Cantón", "0");

//       // ALMACENAMOS LA INFORMACION QUE NOS DA LA CONSULTA A LA BASE DE DATOS
//       Cantones = JSON.parse(request.responseText);

//       // ASIGNAMOS LOS VALORES AL SELECT DE CANTONES
//       for (let i = 1; i <= Cantones.length; i++) {
//         selecCanton.options[i] = new Option(
//           Cantones[i - 1]["NombreCanton"],
//           Cantones[i - 1]["Id"]
//         );
//       }
//     }
//   };
// }

// function SeleccionaCantonCliente(arrCantones, idCanton) {
//   for (let i = 0; i < arrCantones.length; i++) {
//     if (idCanton == arrCantones[i].Id) {
//       IdCa = i + 1;
//       selecCanton.selectedIndex = IdCa;
//       // selecCanton.options[IdCa].selected = true;
//       IdCa = arrCantones[i].Id;
//       break;
//     }
//   }
//   return IdCa;
// }