var tblClientes, Provincias, arrCantones, arrDistritos, IdCa, encontro;
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
  var frmClientes = document.querySelector("#frmClientes");
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

      /* Detecta en cual navegador se encuentra el usuario
                  Si está en chrome o firefox crea un elemento xmlhttprequest
                  sino crea un objeto activexobjet de microsoft
             */
      var request = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
      var Url = base_url + "Clientes/setCliente";
      var frmData = new FormData(frmClientes);

      //   Enviamos los datos por medio de ajax
      request.open("POST", Url, true);
      request.send(frmData);
      request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
          var objData = JSON.parse(request.responseText);

          if (objData.status) {
            // Reseteamos los campos del formulario de productos
            frmClientes.reset();
            // Cerramos el modal
            $("#modalClientes").modal("hide");
            // Enviamos mensaje de exito
            swal("Clientes", objData.msg, "success");
            // Recargamos la tabla
            tblClientes.ajax.reload(function () {
              btnEditCliente();
            });
          } else {
            // Mostramos error
            swal("Error", objData.msg, "error");
          }
        }
      };
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

// LLENADO DEL SELEC PROVINCIA
function CargaProvincia() {
  var request = window.XMLHttpRequest ?
    new XMLHttpRequest() :
    new ActiveXObject("Microsoft.XMLHTTP");
  var Url = base_url + "Clientes/getProvincia";
  request.open("GET", Url, true);
  request.send();
  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      selecProvincia.options[0] = new Option("Selecciona una Provincia", "0");
      Provincias = JSON.parse(request.responseText);
      // Provincias = objData;
      for (let i = 1; i <= Provincias.length; i++) {
        selecProvincia.options[i] = new Option(
          Provincias[i - 1]["NombreProvincia"],
          Provincias[i - 1]["Id"]
        );
      }
    }
  };
}

// FUNCION FETCH QUE CARGA EL SELECT DE CANTONES
function CargaCanton_Fetch(IdProvincia) {
  let Url = `${base_url}Clientes/getCanton/${IdProvincia}`;
  fetch(Url)
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
function CargaDistrito_Fetch(idCanton) {
  let Url = `${base_url}Clientes/getDistrito/${idCanton}`;
  fetch(Url)
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

// CARGA AUTOMATICA DE PROCESOS
window.addEventListener(
  "load",
  function () {
    CargaProvincia();
    btnEditCliente();
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

            // PROCESO PARA SELECCCIONAR LA PROVINCIA DEL CLIENTE
            selecProvincia.selectedIndex = InfoCliente.data.idProvincia;

            // CARGA EL SELECT DE CANTONES CON EL ID DE PROVINCIA
            let idProvincia = InfoCliente.data.idProvincia;
            arrCantones = CargaCanton_Fetch(idProvincia);

            // PROCESO PARA SELECCCIONAR EL CANTON DEL CLIENTE
            let idCanton = InfoCliente.data.idCanton;
            SeleccionaCantonCliente(arrCantones, idCanton, selecCanton);

            // CARGA EL SELECT DE DISTRITOS CON EL ID DEL CANTON
            arrDistritos = CargaDistrito_Fetch(idCanton);

            // PROCESO PARA SELECCCIONAR EL DISTRITO DEL CLIENTE
            let idDistrito = InfoCliente.data.idDistrito;
            SeleccionaDistritoCliente(arrDistritos, idDistrito);


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

function SeleccionaCantonCliente(arrCantones, idCanton, selecCanton) {
  for (let i = 0; i < arrCantones.length; i++) {
    if (idCanton == arrCantones[i].Id) {
      IdCa = i + 1;
      selecCanton.selectedIndex = IdCa;
      IdCa = arrCantones[i].Id
    }
  }
  return IdCa;
}

function SeleccionaDistritoCliente(arrDistritos, idDistrito) {
  for (let i = 0; i < arrDistritos.length; i++) {
    if (idDistrito == arrDistritos[i].Id) {
      encontro = i + 1;
      selecDistrito.selectedIndex = encontro;
    }
  }
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
function CargaDistrito(idCanton) {
  var request = window.XMLHttpRequest ?
    new XMLHttpRequest() :
    new ActiveXObject("Microsoft.XMLHTTP");
  var Url = `${base_url}Clientes/getDistrito/${idCanton}`;
  request.open("GET", Url);
  request.send();

  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      selecDistrito.options[0] = new Option("Selecciona un Distrito", "0");
      Distritos = JSON.parse(request.responseText);

      for (let i = 1; i <= Distritos.length; i++) {
        selecDistrito.options[i] = new Option(
          Distritos[i - 1]["nombreDistrito"],
          Distritos[i - 1]["Id"]
        );
      }
    }
  };
  return Distritos;
}

// FUNCION QUE LLENA EL COMBO DE CANTON AL SELECCIONAR UNA PROVINCIA
function CargaCanton(idProvincia) {
  // VERIFICAMOS QUE TIPO DE NAVEGADOR UTILIZA EL CLIENTE
  var request = window.XMLHttpRequest ?
    new XMLHttpRequest() :
    new ActiveXObject("Microsoft.XMLHTTP");

  // OBTENEMOS LOS CANTONES ENVIANDO EL ID DE LA PROVINCIA
  var Url = `${base_url}Clientes/getCanton/${idProvincia}`;
  request.open("GET", Url, true);
  request.send();

  request.onreadystatechange = function () {
    // VALIDAMOS QUE NOS RETORNE DATOS
    if (request.readyState == 4 && request.status == 200) {
      // AGREGAMOS UNA OPCION DEFAULT AL SELECT
      selecCanton.options[0] = new Option("Selecciona un Cantón", "0");

      // ALMACENAMOS LA INFORMACION QUE NOS DA LA CONSULTA A LA BASE DE DATOS
      Cantones = JSON.parse(request.responseText);

      // ASIGNAMOS LOS VALORES AL SELECT DE CANTONES
      for (let i = 1; i <= Cantones.length; i++) {
        selecCanton.options[i] = new Option(
          Cantones[i - 1]["NombreCanton"],
          Cantones[i - 1]["Id"]
        );
      }
    }
  };
}