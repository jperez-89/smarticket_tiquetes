var tblEventos;

// Funcion para autocargar el datatable de clientes
document.addEventListener("DOMContentLoaded", function () {
  // Mostrar los datos en la tabla
  tblEventos = $("#tblEventos").DataTable({
    aProcessing: true,
    aServerSide: true,
    dom: "Bfrtip",
    buttons: [{
        extend: "excel",
        titleAttr: "Exportar a Excel",
        text: '<i class="fas fa-file-excel" aria-hidden="true"></i> Excel',
        className: "",
      },
      {
        extend: "pdf",
        titleAttr: "Exportar a PDF",
        text: '<i class="far fa-file-pdf" aria-hidden="true"></i> PDF',
        className: "",
      },
    ],
    languaje: {
      url: "//cnd.datatables.net/plug-ins/1.10.20/i18n/spanish.json",
    },
    ajax: {
      url: ` ${base_url}/Eventos/getEventos`,
      dataSrc: "",
    },
    columns: [{
        data: "idEvento",
      },
      {
        data: "nombreEvento",
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
  const frmEvento = document.querySelector("#frmEvento");
  frmEvento.onsubmit = function (e) {
    e.preventDefault();

    // Extraemos los datos
    const idEvento = document.querySelector("#idEvento").value;
    const nombreEvento = document.querySelector("#txtNombre").value;
    const selecEstado = document.querySelector("#selecEstado").value;

    // Validamos si los campos estan vacios para mostrar alerta
    if (
      nombreEvento == "" ||
      selecEstado == ""
    ) {
      swal("Atención", "Todos los campos son obligatorios", "error");
      return false;
    }

    const url = `${base_url}Eventos/setEvento`;
    frmDatos = new FormData(this)

    const response = fnt_Fetch(url, 'post', frmDatos)
    response.then(objData => {
      if (objData.status) {
        // Reseteamos los campos del formulario de productos
        frmEvento.reset();
        // Cerramos el modal
        $("#modalEvento").modal("hide");
        // Enviamos mensaje de exito
        swal("Eventos", objData.msg, "success");
        // Recargamos la tabla
        tblEventos.ajax.reload();
      } else {
        // Mostramos error
        swal("Error", objData.msg, "error");
      }
    })
  };
});

function fntEditEvento(idEvento) {
  document.querySelector("#titleModal").innerHTML = "Actualizar Evento";
  document.querySelector(".modal-header").classList.replace("headerRegister", "headerUpdate");
  document.querySelector("#btnGuardar").classList.replace("btn-primary2", "btn-danger2");
  document.querySelector("#btnText").innerHTML = "Actualizar";

  const url = `${base_url}Eventos/getEvento/${idEvento}`;

  const response = fnt_Fetch(url)
  response.then(InfoEvento => {
    if (InfoEvento.status) {
      // MOSTRAMOS LOS DATOS EN LOS CAMPOS DE TEXTO
      document.querySelector("#idEvento").value = InfoEvento.data.idEvento;
      document.querySelector("#txtNombre").value = InfoEvento.data.nombreEvento;
      document.querySelector("#lstEventos").style.display = "block";

      // VALIDA EL ESTADO
      if (InfoEvento.data.Status == 1) {
        var select = '<option value="1" selected class="notBlock">Activo</option>';
      } else if (InfoEvento.data.Status == 0) {
        var select = '<option value="0" selected class="notBlock">Inactivo</option>';
      }
      const htmlSelectEstado = `${select}
                   <option value="1">Activo</option>
                   <option value="0">Inactivo</option>`;
      document.querySelector("#selecEstado").innerHTML = htmlSelectEstado;

      // MOSTRAMOS EL MODAL
      $("#modalEvento").modal("show");
    } else {
      // MOSTRAMOS ERROR
      swal("Error", InfoEvento.msg, "error");
    }
  })
}

function fntDeleteEvento(idEvento) {
  swal({
      title: "Deshabilitar Evento",
      text: "Realmente quiere deshabilitar el evento?",
      type: "warning",
      showCancelButton: true,
      confirmButtonText: "Sí, Deshabilitar!",
      cancelButtonText: "No, cancelar!",
      closeOnConfirm: false,
      closeOnCancel: true,
    },
    (isConfirm) => {
      if (isConfirm) {
        const url = `${base_url}Eventos/deleteEvento/`;
        const frm = new FormData()
        frm.append('idEvento', idEvento)

        const response = fnt_Fetch(url, 'post', frm)
        response.then(objData => {
          if (objData.status) {
            swal("Eliminar!", objData.msg, "success");
            tblEventos.ajax.reload();
          } else {
            swal("Atencion!", objData.msg, "error");
          }
        })
      }
    })
}

function fntEnableEvento(idEvento) {
  swal({
      title: "Habilitar Evento",
      text: "Realmente quiere Habilitar el evento?",
      type: "info",
      showCancelButton: true,
      confirmButtonText: "Sí, Habilitar!",
      cancelButtonText: "No, cancelar!",
      closeOnConfirm: false,
      closeOnCancel: true,
    },
    (isConfirm) => {
      if (isConfirm) {

        const url = `${base_url}Eventos/enableEvento/`;

        // Ejecutar petición por medio de elemento request
        const frm = new FormData()
        frm.append('idEvento', idEvento)

        const response = fnt_Fetch(url, 'post', frm)
        response.then(objData => {
          if (objData.status) {
            swal("Habilitar!", objData.msg, "success");
            tblEventos.ajax.reload();
          } else {
            swal("Atencion!", objData.msg, "error");
          }
        })
      }
    })
}

// DESPLIEGA EL MODAL
function OpenModal() {
  document.querySelector("#idEvento").value = "";
  document.querySelector("#titleModal").innerHTML = "Nuevo Evento";
  document.querySelector(".modal-header").classList.replace("headerUpdate", "headerRegister");
  document.querySelector("#btnGuardar").classList.replace("btn-danger2", "btn-primary2");
  document.querySelector("#btnText").innerHTML = "Guardar";
  document.querySelector("#lstEventos").style.display = "block";
  document.querySelector("#frmEvento").reset();
  $("#modalEvento").modal("show");
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
  $("#modalEvento").modal('hide')
});