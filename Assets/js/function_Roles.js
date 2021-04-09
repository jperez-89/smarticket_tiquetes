document.addEventListener("DOMContentLoaded", function () {
  // Mostrar los datos en la tabla
  tableRoles = $("#tblRoles").DataTable({
    aProcessing: true,
    aServerSide: true,
    sDom: "Bfrtip",
    // buttons: [
    //   {
    //     extend: "excelHtml5",
    //     titleAttr: "Exportar a Excel",
    //     text:
    //       '<h6><i class="fas fa-file-excel" aria-hidden="true"></i> Excel <h6/> ',
    //     className: "btn btn-success btn-sm m-1",
    //   },
    //   {
    //     extend: "pdfHtml5",
    //     titleAttr: "Exportar a PDF",
    //     text:
    //       '<h6><i class="far fa-file-pdf" aria-hidden="true"></i> PDF <h6/>',
    //     className: "btn btn-danger btn-sm m-1",
    //   },
    // ],
    languaje: {
      url: "//cnd.datatables.net/plug-ins/1.10.20/i18n/spanish.json",
    },
    ajax: {
      url: " " + base_url + "/Roles/getRoles",
      dataSrc: ""
    },
    columns: [{
        data: "Id"
      },
      {
        data: "nombreRol"
      },
      {
        data: "descripcion"
      },
      {
        data: "status"
      },
      {
        data: "options"
      },
    ],
    responsive: "true",
    bDestroy: true,
    iDisplayLenght: 10,
    // order: [
    //   [0, "desc"]
    // ],
  });
});

// Registrar y editar un producto
var frmRoles = document.querySelector("#frmRoles");
if (frmRoles != null) {
  frmRoles.onsubmit = function (e) {
    e.preventDefault();

    // Extraemos los datos
    var idRol = document.querySelector("#idRol").value;
    var nombreRol = document.querySelector("#txtNombreRol").value;
    var descripcion = document.querySelector("#txtDescripcionRol").value;
    var status = document.querySelector("#selecEstadoRol").value;

    // Validamos si los campos estan vacios para mostrar alerta
    if (nombreRol == "" || status == "" || descripcion == "") {
      swal("Atención", "Todos los campos son obligatorios", "error");
      return false;
    }

    const url = `${base_url}Roles/setRol`;
    frmDatos = new FormData(this);

    const response = fnt_Fetch(url, 'post', frmDatos);
    response.then(objData => {
      if (objData.status) {
        // Reseteamos los campos del formulario de productos
        frmRoles.reset();
        // Cerramos el modal
        $("#modalRoles").modal("hide");
        // Enviamos mensaje de exito
        swal("Roles", objData.msg, "success");
        // Recargamos la tabla
        tableRoles.ajax.reload();
      } else {
        // Mostramos error
        swal("Error", objData.msg, "error");
      }
    })
  }
}

function fntEditRol(idRol) {
  // Editar el estilo del modal
  document.querySelector("#titleModal").innerHTML = "Actualizar Rol";
  document.querySelector(".modal-header").classList.replace("headerRegister", "headerUpdate");
  document.querySelector("#btnGuardar").classList.replace("btn-primary", "btn-info");
  document.querySelector("#btnText").innerHTML = "Actualizar";

  // Obtener los datos
  var url = `${base_url}Roles/getRol/${idRol}`;

  const response = fnt_Fetch(url);
  response.then(objData => {
    if (objData.status) {
      // Mostar los datos en los campos para editar
      document.querySelector("#idRol").value = objData.data.Id;
      document.querySelector("#txtNombreRol").value = objData.data.nombreRol;
      document.querySelector("#txtDescripcionRol").value = objData.data.descripcion;
      document.querySelector("#lstRol").style.display = "none";
      // document.querySelector("#selecEstadoRol").value = objData.data.status;

      // Validamos el estado
      if (objData.data.status == 1) {
        var select =
          '<option value="1" selected class="notBlock">Activo</option>';
      } else if (objData.data.state == 0) {
        var select =
          '<option value="0" selected class="notBlock">Inactivo</option>';
      }
      var htmlSelectEstado = `${select}
            <option value="1">Activo</option>
            <option value="0">Inactivo</option>
            `;

      // Mostramos los datos en los select
      document.querySelector("#selecEstadoRol").innerHTML = htmlSelectEstado;

      // MOSTRAMOS EL MODAL
      $("#modalRoles").modal("show");
    } else {
      // Mostramos error
      swal("Error", objData.msg, "error");
    }
  })
}

function fntDeleteRol(id) {
  swal({
      // title: "Deshabilitar Usuario",
      title: "Realmente quiere deshabilitar el Rol?",
      type: "warning",
      showCancelButton: true,
      confirmButtonText: "Sí, Deshabilitar!",
      cancelButtonText: "No, cancelar!",
      closeOnConfirm: false,
      closeOnCancel: true,
    },
    (isConfirm) => {
      if (isConfirm) {
        const url = `${base_url}Roles/deleteRol/`;
        const frm = new FormData()
        frm.append('id', id)

        const response = fnt_Fetch(url, 'post', frm)
        response.then(objData => {
          if (objData.status) {
            swal("Eliminar!", objData.msg, "success");
            tableRoles.ajax.reload();
          } else {
            swal("Atencion!", objData.msg, "error");
          }
        })
      }
    })
}

function fntEnableRol(id) {
  swal({
      // title: "Habilitar Rol",
      title: "Realmente quiere habilitar el Rol?",
      type: "warning",
      showCancelButton: true,
      confirmButtonText: "Sí, Habilitar!",
      cancelButtonText: "No, cancelar!",
      closeOnConfirm: false,
      closeOnCancel: true,
    },
    (isConfirm) => {
      if (isConfirm) {
        const url = `${base_url}Roles/enableRol/`;
        const frm = new FormData()
        frm.append('id', id)

        const response = fnt_Fetch(url, 'post', frm)
        response.then(objData => {
          if (objData.status) {
            swal("Habilitar!", objData.msg, "success");
            tableRoles.ajax.reload();
          } else {
            swal("Atencion!", objData.msg, "error");
          }
        })
      }
    })
}

// Funcion para mostrar el modal
function OpenModal() {
  document.querySelector("#idRol").value = "";
  document.querySelector("#titleModal").innerHTML = "Nuevo Rol";
  document
    .querySelector(".modal-header")
    .classList.replace("headerUpdate", "headerRegister");
  document
    .querySelector("#btnGuardar")
    .classList.replace("btn-info", "btn-primary");
  document.querySelector("#btnText").innerHTML = "Guardar";
  document.querySelector("#frmRoles").reset();
  $("#modalRoles").modal("show");
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