$("#tblClientes").DataTable();

document.addEventListener("DOMContentLoaded", function () {
  // Mostrar los datos en la tabla
  // tableClientes = $("#tblClientes").DataTable({
  //   aProcessing: true,
  //   aServerSide: true,
  //   sDom: "Bfrtip",
  //   buttons: [
  //     {
  //       extend: "excelHtml5",
  //       titleAttr: "Exportar a Excel",
  //       text:
  //         '<h6><i class="fas fa-file-excel" aria-hidden="true"></i> Excel <h6/> ',
  //       className: "btn btn-success btn-sm m-1",
  //     },
  //     {
  //       extend: "pdfHtml5",
  //       titleAttr: "Exportar a PDF",
  //       text:
  //         '<h6><i class="far fa-file-pdf" aria-hidden="true"></i> PDF <h6/>',
  //       className: "btn btn-danger btn-sm m-1",
  //     },
  //   ],
  //   languaje: {
  //     url: "//cnd.datatables.net/plug-ins/1.10.20/i18n/spanish.json",
  //   },
  //   ajax: { url: " " + base_url + "/Clientes/getClientes", dataSrc: "" },
  //   columns: [
  //     { data: "id" },
  //     { data: "dni" },
  //     { data: "nombre" },
  //     { data: "telefono" },
  //     { data: "emial" },
  //     { data: "idPronvincia" },
  //     { data: "idCanton" },
  //     { data: "idDistrito" },
  //     { data: "direccion" },
  //     { data: "actividad" },
  //     { data: "tRegimen" },
  //     { data: "options" },
  //   ],
  //   responsive: "true",
  //   bDestroy: true,
  //   iDisplayLenght: 10,
  //   order: [[0, "desc"]],
  // });
});

// LLENADO DEL SELEC PROVINCIA
function CargaProvincia() {
  var request = window.XMLHttpRequest
    ? new XMLHttpRequest()
    : new ActiveXObject("Microsoft.XMLHTTP");
  var Url = `${base_url}Clientes/getProvincia`;
  request.open("GET", Url, true);
  request.send();

  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      var selecProvincia = document.getElementById("selecProvincia");
      selecProvincia.options[0] = new Option("Selecciona una Provincia", "0");
      var objData = JSON.parse(request.responseText);
      var Provincias = objData;

      for (let i = 1; i <= Provincias.length; i++) {
        selecProvincia.options[i] = new Option(
          Provincias[i - 1]["NombreProvincia"],
          Provincias[i - 1]["Id"]
        );
      }
    }
  };
}

// FUNCION QUE LLENA EL COMBO DE CANTON
function CargaCanton(idProvincia) {
  var selecCanton = document.getElementById("selecCanton");

  if (idProvincia == "0") {
    //Elimina los items cuando se elige otra Provincia
    var lengthddlCanton = selecCanton.length;
    for (var i = lengthddlCanton; i >= 0; i--) {
      selecCanton.options[i] = null;
    }
  } else {
    var request = window.XMLHttpRequest
      ? new XMLHttpRequest()
      : new ActiveXObject("Microsoft.XMLHTTP");
    var Url = `${base_url}Clientes/getCanton/${idProvincia}`;
    request.open("GET", Url, true);
    request.send();

    request.onreadystatechange = function () {
      if (request.readyState == 4 && request.status == 200) {
        selecCanton.options[0] = new Option("Selecciona un Cantón", "0");
        var objData = JSON.parse(request.responseText);
        var Cantones = objData;

        for (let i = 1; i <= Cantones.length; i++) {
          selecCanton.options[i] = new Option(
            Cantones[i - 1]["NombreCanton"],
            Cantones[i - 1]["Id"]
          );
        }
      }
    };
  }
}

// FUNCION QUE LLENA EL COMBO DE DISTRITO
function CargaDistrito(idCanton) {
  var selecDistrito = document.getElementById("selecDistrito");

  if (idCanton == "0") {
    //Elimina los items cuando se elige otra Provincia
    var lengthddlDistrito = selecDistrito.length;
    for (var i = lengthddlDistrito; i >= 0; i--) {
      selecDistrito.options[i] = null;
    }
  } else {
    var request = window.XMLHttpRequest
      ? new XMLHttpRequest()
      : new ActiveXObject("Microsoft.XMLHTTP");
    var Url = `${base_url}Clientes/getDistrito/${idCanton}`;
    request.open("GET", Url, true);
    request.send();

    request.onreadystatechange = function () {
      if (request.readyState == 4 && request.status == 200) {
        console.log(request);
        selecDistrito.options[0] = new Option("Selecciona un Distrito", "0");
        var objData = JSON.parse(request.responseText);
        var Distritos = objData;

        for (let i = 1; i <= Distritos.length; i++) {
          selecDistrito.options[i] = new Option(
            Distritos[i - 1]["NombreDistrito"],
            Distritos[i - 1]["Id"]
          );
        }
      }
    };
  }
}

// Para que se agreguen automaticamente los eventos
window.addEventListener(
  "load",
  function () {
    CargaProvincia();
  },
  false
);

// Funcion para mostrar el modal
function OpenModal() {
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
