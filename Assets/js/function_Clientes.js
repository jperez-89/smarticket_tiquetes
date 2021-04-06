var tblClientes, arrProvincias, arrCantones, arrDistritos, IdCa, idProvincia, idCanton, idDistrito, encontro, idCantonSeleccionado, data;
const selecProvincia = document.getElementById("selecProvincia");
const selecCanton = document.getElementById("selecCanton");
const selecDistrito = document.getElementById("selecDistrito");

// CARGA AUTOMATICA DE PROCESOS
window.addEventListener(
  "load",
  function () {
    CargaProvincia();
  },
  false
);

document.addEventListener("DOMContentLoaded", function () {
  // Mostrar los datos en la tabla
  tblClientes = $("#tblClientes").DataTable({
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

  // Registro de nuevo cliente
  const frmClientes = document.querySelector("#frmClientes");
  frmClientes.onsubmit = function (e) {
    e.preventDefault();

    // Extraemos los datos
    const idCliente = document.querySelector("#idCliente").value;
    const txtIdentificacion = document.querySelector("#txtIdentificacion").value;
    const txtNombre = document.querySelector("#txtNombre").value;
    const txtTelefono = document.querySelector("#txtTelefono").value;
    const txtEmail = document.querySelector("#txtEmail").value;
    const selecProvincia = document.querySelector("#selecProvincia").value;
    const selecCanton = document.querySelector("#selecCanton").value;
    const selecDistrito = document.querySelector("#selecDistrito").value;
    const txtDireccion = document.querySelector("#txtDireccion").value;
    const txtActividad = document.querySelector("#txtActividad").value;
    const selecRegimen = document.querySelector("#selecRegimen").value;
    const selecEstado = document.querySelector("#selecEstado").value;

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

    const url = `${base_url}Clientes/setCliente`;
    frmDatos = new FormData(this)

    const response = fnt_Fetch(url, 'post', frmDatos)
    response.then(objData => {
      if (objData.status) {
        // Reseteamos los campos del formulario de productos
        frmClientes.reset();
        // Cerramos el modal
        $("#modalClientes").modal("hide");
        // Enviamos mensaje de exito
        swal("Cliente", objData.msg, "success");
        // Recargamos la tabla
        tblClientes.ajax.reload();
      } else {
        // Mostramos error
        swal("Error", objData.msg, "error");
      }
    })

    // request.open("POST", url);
    // request.send(frmData);
    // request.onreadystatechange = function () {
    //   if (request.readyState == 4 && request.status == 200) {
    //     // console.log(request)
    //     var objData = JSON.parse(request.responseText);
    //     // console.log(objData)
    //     if (objData.status) {
    //       // Reseteamos los campos del formulario de productos
    //       frmClientes.reset();
    //       // Cerramos el modal
    //       $("#modalClientes").modal("hide");
    //       // Enviamos mensaje de exito
    //       swal("Cliente", objData.msg, "success");
    //       // Recargamos la tabla
    //       tblClientes.ajax.reload(function () {
    //         ftnEditCliente();
    //         fntDeleteCliente()
    //       });
    //     } else {
    //       // Mostramos error
    //       swal("Error", objData.msg, "error");
    //     }
    //   }
    // };

  }; // FIN DEL ONSUBMIT
});

function fntEditClient(idCliente) {
  document.querySelector("#titleModal").innerHTML = "Actualizar Cliente";
  document.querySelector(".modal-header").classList.replace("headerRegister", "headerUpdate");
  document.querySelector("#btnGuardar").classList.replace("btn-primary", "btn-info");
  document.querySelector("#btnText").innerHTML = "Actualizar";

  const url = `${base_url}Clientes/getCliente/${idCliente}`;

  const response = fnt_Fetch(url)
  response.then(InfoCliente => {
    if (InfoCliente.status) {
      // MOSTRAMOS LOS DATOS EN LOS CAMPOS DE TEXTO
      document.querySelector("#idCliente").value = InfoCliente.data.Id;
      document.querySelector("#txtIdentificacion").value = InfoCliente.data.Identificacion;
      document.querySelector("#txtNombre").value = InfoCliente.data.Nombre;
      document.querySelector("#txtTelefono").value = InfoCliente.data.Telefono;
      document.querySelector("#txtEmail").value = InfoCliente.data.Email;
      document.querySelector("#txtDireccion").value = InfoCliente.data.Direccion;
      document.querySelector("#txtActividad").value = InfoCliente.data.Actividad;
      document.querySelector("#lstEstado").style.display = "none";


      // CAPTURA DE DATOS PARA UTILIAR EN FUNCION
      idProvincia = InfoCliente.data.idProvincia;
      idCanton = InfoCliente.data.idCanton;
      idDistrito = InfoCliente.data.idDistrito;

      // HACEMOS SELECT DE LA PROVINCIA DEL CLIENTE
      selecProvincia.selectedIndex = idProvincia;

      // FUNCIÓN PARA SELECCIONAR EL CANTÓN Y DISTRITO DEL CLIENTE
      llenarDireccion(idProvincia, idCanton, idDistrito)

      // VALIDA EL REGIMEN
      if (InfoCliente.data.Regimen == "Factura Electrónica") {
        var select = '<option value="Factura Electrónica" selected class="notBlock">Factura Electrónica</option>';
      } else if (InfoCliente.data.Regimen == "Simplificado") {
        var select = '<option value="Simplificado" selected class="notBlock">Simplificado</option>';
      }
      const htmlSelectRegimen = `${select}
                   <option value="Factura Electrónica">Factura Electrónica</option>
                   <option value="Simplificado">Simplificado</option>`;
      document.querySelector("#selecRegimen").innerHTML = htmlSelectRegimen;

      // VALIDA EL ESTADO
      if (InfoCliente.data.Status == 1) {
        var select = '<option value="1" selected class="notBlock">Activo</option>';
      } else if (InfoCliente.data.Status == 0) {
        var select = '<option value="0" selected class="notBlock">Inactivo</option>';
      }
      const htmlSelectEstado = `${select}
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
}

function fntDeleteClient(idCliente) {
  swal({
      title: "Deshabilitar Cliente",
      text: "Realmente quiere deshabilitar el cliente?",
      type: "warning",
      showCancelButton: true,
      confirmButtonText: "Sí, Deshabilitar!",
      cancelButtonText: "No, cancelar!",
      closeOnConfirm: false,
      closeOnCancel: true,
    },
    (isConfirm) => {
      if (isConfirm) {
        const url = `${base_url}Clientes/deleteClient/`;
        const frm = new FormData()
        frm.append('idCliente', idCliente)

        const response = fnt_Fetch(url, 'post', frm)
        response.then(objData => {
          if (objData.status) {
            swal("Eliminar!", objData.msg, "success");
            tblClientes.ajax.reload();
          } else {
            swal("Atencion!", objData.msg, "error");
          }
        })
      }
    })
}

function fntEnableClient(idCliente) {
  swal({
      title: "Habilitar Cliente",
      text: "Realmente quiere Habilitar el cliente?",
      type: "info",
      showCancelButton: true,
      confirmButtonText: "Sí, Habilitar!",
      cancelButtonText: "No, cancelar!",
      closeOnConfirm: false,
      closeOnCancel: true,
    },
    (isConfirm) => {
      if (isConfirm) {

        const url = `${base_url}Clientes/enableClient/`;

        // Ejecutar petición por medio de elemento request
        const frm = new FormData()
        frm.append('idCliente', idCliente)
        console.log(frm)

        const response = fnt_Fetch(url, 'post', frm)
        response.then(objData => {
          if (objData.status) {
            swal("Habilitar!", objData.msg, "success");
            tblClientes.ajax.reload();
          } else {
            swal("Atencion!", objData.msg, "error");
          }
        })
      }
    })
}

async function llenarDireccion(idProvincia, idCanton, idDistrito) {
  const idCantonSeleccionado = await SeleccionaCantonCliente(idCanton, idProvincia)
  SeleccionaDistritoCliente(idDistrito, idCantonSeleccionado)
}

async function SeleccionaCantonCliente(idCanton, idProvincia) {
  const arrCantones = await CargaCanton_Fetch(idProvincia);

  for (let i = 0; i < arrCantones.length; i++) {
    if (idCanton == arrCantones[i].Id) {
      encontro = i + 1;
      selecCanton.selectedIndex = encontro;
      idCantonSeleccionado = arrCantones[i].Id;
      break;
    }
  }
  return idCantonSeleccionado;
}

async function SeleccionaDistritoCliente(idDistrito, idCantonSeleccionado) {
  const arrDistritos = await CargaDistrito_Fetch(idCantonSeleccionado);

  for (let i = 0; i < arrDistritos.length; i++) {
    if (idDistrito == arrDistritos[i].Id) {
      encontro = i + 1;
      selecDistrito.selectedIndex = encontro;
      break;
    }
  }
  // return idDistritoSeleccionado;
}

// LLENADO DEL SELEC PROVINCIA
function CargaProvincia() {
  const url = base_url + "Clientes/getProvincia";
  fetch(url)
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
  let url = `${base_url}Clientes/getCanton/${IdProvincia}`;
  await fetch(url)
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
  let url = `${base_url}Clientes/getDistrito/${idCantonSeleccionado}`;
  await fetch(url)
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

// DESPLIEGA EL MODAL
function OpenModal() {
  resetListaCanton();
  resetListaDistrito();
  document.querySelector("#idCliente").value = "";
  document.querySelector("#titleModal").innerHTML = "Nuevo Cliente";
  document.querySelector(".modal-header").classList.replace("headerUpdate", "headerRegister");
  document.querySelector("#btnGuardar").classList.replace("btn-info", "btn-primary");
  document.querySelector("#btnText").innerHTML = "Guardar";
  document.querySelector("#lstEstado").style.display = "block";
  document.querySelector("#frmClientes").reset();
  $("#modalClientes").modal("show");
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