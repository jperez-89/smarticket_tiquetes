var tblClientes;

// Funcion para autocargar el datatable de clientes
document.addEventListener("DOMContentLoaded", function () {
  // Mostrar los datos en la tabla
  tblClientes = $("#tblClientes").DataTable({
    aProcessing: true,
    aServerSide: true,
    dom: "Bfrtip",
    languaje: {
      url: "//cdn.datatables.net/plug-ins/1.10.16/i18n/es-ES.json",
    },
    ajax: {
      url: ` ${base_url}/Clientes/getClientes`,
      dataSrc: "",
    },
    columns: [{
        data: "idCliente",
      },
      {
        data: "nombreCliente",
      },
      {
        data: "telefonoCliente",
      },
      {
        data: "emailCliente",
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
    const txtNombre = document.querySelector("#txtNombre").value;
    const txtTelefono = document.querySelector("#txtTelefono").value;
    const txtEmail = document.querySelector("#txtEmail").value;
    const selecEstado = document.querySelector("#selecEstado").value;
    
    // Validamos si los campos estan vacios para mostrar alerta
    if (
      txtNombre == "" ||
      txtTelefono == "" ||
      txtEmail == "" ||
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
  };
});

function fntEditClient(idCliente) {
  document.querySelector("#titleModal").innerHTML = "Actualizar Cliente";
  document.querySelector(".modal-header").classList.replace("headerRegister", "headerUpdate");
  document.querySelector("#btnGuardar").classList.replace("btn-primary2", "btn-danger2");
  document.querySelector("#btnText").innerHTML = "Actualizar";

  const url = `${base_url}Clientes/getCliente/${idCliente}`;

  const response = fnt_Fetch(url)
  response.then(InfoCliente => {
    if (InfoCliente.status) {
      // MOSTRAMOS LOS DATOS EN LOS CAMPOS DE TEXTO
      document.querySelector("#idCliente").value = InfoCliente.data.idCliente;
      document.querySelector("#txtNombre").value = InfoCliente.data.nombreCliente;
      document.querySelector("#txtTelefono").value = InfoCliente.data.telefonoCliente;
      document.querySelector("#txtEmail").value = InfoCliente.data.emailCliente;
      document.querySelector("#lstEstado").style.display = "none";

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

// DESPLIEGA EL MODAL
function OpenModal() {
  document.querySelector("#idCliente").value = "";
  document.querySelector("#titleModal").innerHTML = "Nuevo Cliente";
  document.querySelector(".modal-header").classList.replace("headerUpdate", "headerRegister");
  document.querySelector("#btnGuardar").classList.replace("btn-danger2", "btn-primary2");
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

$(".cerrarModal").click(function () {
  $("#modalClientes").modal('hide')
});