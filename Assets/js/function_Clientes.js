var tblClientes, Provincias, Cantones, Distritos;
var selecProvincia = document.getElementById("selecProvincia");
var selecCanton = document.getElementById("selecCanton");
var selecDistrito = document.getElementById("selecDistrito");

document.addEventListener("DOMContentLoaded", function () {
  // Mostrar los datos en la tabla
  tblClientes = $("#tblClientes").DataTable({
    aProcessing: true,
    aServerSide: true,
    sDom: "Bfrtip",
    buttons: [
      {
        extend: "excelHtml5",
        titleAttr: "Exportar a Excel",
        text:
          '<h6><i class="fas fa-file-excel" aria-hidden="true"></i> Excel <h6/> ',
        className: "btn btn-success btn-sm m-1",
      },
      {
        extend: "pdfHtml5",
        titleAttr: "Exportar a PDF",
        text:
          '<h6><i class="far fa-file-pdf" aria-hidden="true"></i> PDF <h6/>',
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
    columns: [
      {
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
    order: [[0, "desc"]],
  });

  // Registro de nuevo producto
  var frmClientes = document.querySelector("#frmClientes");
  if (frmClientes != null) {
    frmClientes.onsubmit = function (e) {
      e.preventDefault();
      // Extraemos los datos
      var txtIdentificacion = document.querySelector("#txtIdentificacion")
        .value;
      var txtNombre = document.querySelector("#txtNombre").value;
      var txtTelefono = document.querySelector("#txtTelefono").value;
      var txtEmail = document.querySelector("#txtEmail").value;
      var selecProvincia = document.querySelector("#selecProvincia").value;
      var selecCanton = document.querySelector("#selecCanton").value;
      var selecDistrito = document.querySelector("#selecDistrito").value;
      var txtDireccion = document.querySelector("#txtDireccion").value;
      // Validamos si los campos estan vacios para mostrar alerta
      if (
        txtIdentificacion == "" ||
        txtNombre == "" ||
        txtTelefono == "" ||
        txtEmail == "" ||
        selecProvincia == "" ||
        selecCanton == "" ||
        selecDistrito == "" ||
        txtDireccion == ""
      ) {
        swal("Atención", "Todos los campos son obligatorios", "error");
        return false;
      } /* Detecta en cual navegador se encuentra el usuario
                  Si está en chrome o firefox crea un elemento xmlhttprequest
                  sino crea un objeto activexobjet de microsoft
             */

      var request = window.XMLHttpRequest
        ? new XMLHttpRequest()
        : new ActiveXObject("Microsoft.XMLHTTP");
      var Url = base_url + "Clientes/setCliente";
      var frmData = new FormData(frmClientes);
      //   Enviamos los datos por medio de ajax
      request.open("POST", Url, true);
      request.send(frmData);
      request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
          // console.log(request);
          // console.log(request.responseText);
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
              fntEditProducto();
              // fntDeleteProducto();
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
  var request = window.XMLHttpRequest
    ? new XMLHttpRequest()
    : new ActiveXObject("Microsoft.XMLHTTP");
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

// FUNCION QUE LLENA EL COMBO DE CANTON AL SELECCIONAR UNA PROVINCIA
function CargaCanton(idProvincia) {
  // VERIFICAMOS QUE TIPO DE NAVEGADOR UTILIZA EL CLIENTE
  var request = window.XMLHttpRequest
    ? new XMLHttpRequest()
    : new ActiveXObject("Microsoft.XMLHTTP");

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

// FUNCION CON $.GET
function CargaCanton2(IdProvincia) {
  resetListaCanton();
  if (IdProvincia != "") {
    var Url = base_url + "Clientes/getCanton/" + IdProvincia;

    $.get(Url, function (data) {
      // AGREGAMOS UNA OPCION DEFAULT AL SELECT
      selecCanton.options[0] = new Option("Selecciona un Cantón", "0");

      // ALMACENAMOS LA INFORMACION QUE NOS DA LA CONSULTA A LA BASE DE DATOS
      Cantones = JSON.parse(data);

      // ASIGNAMOS LOS VALORES AL SELECT DE CANTONES
      for (let i = 1; i <= Cantones.length; i++) {
        selecCanton.options[i] = new Option(
          Cantones[i - 1]["NombreCanton"],
          Cantones[i - 1]["Id"]
        );
      }
    });
  }
}

// FUNCION QUE LLENA EL COMBO DE DISTRITO AL SELECCIONAR UN CANTON
function CargaDistrito(idCanton) {
  var request = window.XMLHttpRequest
    ? new XMLHttpRequest()
    : new ActiveXObject("Microsoft.XMLHTTP");
  var Url = base_url + "Clientes/getDistrito/" + idCanton;
  request.open("GET", Url, true);
  request.send();

  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      selecDistrito.options[0] = new Option("Selecciona un Distrito", "0");
      Distritos = JSON.parse(request.responseText);
      // Distritos = objData;

      for (let i = 1; i <= Distritos.length; i++) {
        selecDistrito.options[i] = new Option(
          Distritos[i - 1]["nombreDistrito"],
          Distritos[i - 1]["Id"]
        );
      }
    }
  };
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
      document
        .querySelector(".modal-header")
        .classList.replace("headerRegister", "headerUpdate");
      document
        .querySelector("#btnGuardar")
        .classList.replace("btn-primary", "btn-info");
      document.querySelector("#btnText").innerHTML = "Actualizar";
      // Obtener los datos
      var idCliente = this.getAttribute("idCliente");
      var request = window.XMLHttpRequest
        ? new XMLHttpRequest()
        : new ActiveXObject("Microsoft.XMLHTTP");
      var url = `${base_url}Clientes/getCliente/${idCliente}`;
      request.open("GET", url, true);
      request.send();
      request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
          var InfoCliente = JSON.parse(request.responseText);
          // MOSTRAMOS LOS DATOS A EDITAR
          if (InfoCliente.status) {
            document.querySelector("#idCliente").value = InfoCliente.data.Id;
            document.querySelector("#txtIdentificacion").value =
              InfoCliente.data.Identificacion;
            document.querySelector("#txtNombre").value =
              InfoCliente.data.Nombre;
            document.querySelector("#txtTelefono").value =
              InfoCliente.data.Telefono;
            document.querySelector("#txtEmail").value = InfoCliente.data.Email;
            document.querySelector("#txtDireccion").value =
              InfoCliente.data.Direccion;
            document.querySelector("#txtActividad").value =
              InfoCliente.data.Actividad;

            // PROCESO PARA SELECCCIONAR LA PROVINCIA DEL CLIENTE
            selecProvincia.selectedIndex = InfoCliente.data.idProvincia;

            // CARGA EL SELECT DE CANTONES Y MUESTRA EL DEL CLIENTE
            // let idProvincia = InfoCliente.data.idProvincia;
            // CargaCanton(idProvincia);
            // CargaCanton2(idProvincia);

            // NOTA: A NO RECONOCE Cantones, POR ESO NO SE USAN ESTOS METODOS
            // PROCESO PARA SELECCCIONAR EL CANTON DEL CLIENTE
            // var encontro;
            // for (let i = 0; i < Cantones.length; i++) {
            //   if (InfoCliente.data.idCanton == Cantones[i].Id) {
            //     encontro = i + 1;
            //     selecCanton.selectedIndex = encontro;
            //   }
            // }

            // PROCESO PARA SELECCCIONAR EL DISTRITO DEL CLIENTE
            // CargaDistrito(encontro);
            // for (let index = 0; index < Distritos.length; index++) {
            //   if (objData.data.idDistrito == Distritos[index].Id) {
            //     encontro = index + 1;
            //     selecDistrito.selectedIndex = encontro;
            //   }
            // }

            // VALIDA EL REGIMEN
            if (InfoCliente.data.Regimen == "Factura Electrónica") {
              var select =
                '<option value="Factura Electrónica" selected class="notBlock">Factura Electrónica</option>';
            } else if (InfoCliente.data.Regimen == "Simplificado") {
              var select =
                '<option value="Simplificado" selected class="notBlock">Simplificado</option>';
            }
            var htmlSelectRegimen = `${select}
            <option value="Factura Electrónica">Factura Electrónica</option>
            <option value="Simplificado">Simplificado</option>
            `;
            document.querySelector(
              "#selecRegimen"
            ).innerHTML = htmlSelectRegimen;

            // VALIDA EL ESTADO
            if (InfoCliente.data.Status == 1) {
              var select =
                '<option value="1" selected class="notBlock">Activo</option>';
            } else if (InfoCliente.data.Status == 0) {
              var select =
                '<option value="0" selected class="notBlock">Inactivo</option>';
            }
            var htmlSelectEstado = `${select}
            <option value="1">Activo</option>
            <option value="0">Inactivo</option>`;
            document.querySelector("#selecEstado").innerHTML = htmlSelectEstado;
            $("#modalClientes").modal("show");
          } else {
            // MOSTRAMOS ERROR
            swal("Error", InfoCliente.msg, "error");
          }
        }
      };
    });
  });
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
