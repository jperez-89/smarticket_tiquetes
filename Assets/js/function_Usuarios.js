document.addEventListener("DOMContentLoaded", function () {
  // Mostrar los datos en la tabla
  tblUsuarios = $("#tblUsuarios").DataTable({
    aProcessing: true,
    aServerSide: true,
    sDom: "Bfrtip",
    // buttons: [{
    //     extend: "excelHtml5",
    //     titleAttr: "Exportar a Excel",
    //     text: '<h6><i class="fas fa-file-excel" aria-hidden="true"></i> Excel <h6/> ',
    //     className: "btn btn-success btn-sm m-1",
    //   },
    //   {
    //     extend: "pdfHtml5",
    //     titleAttr: "Exportar a PDF",
    //     text: '<h6><i class="far fa-file-pdf" aria-hidden="true"></i> PDF <h6/>',
    //     className: "btn btn-danger btn-sm m-1",
    //   },
    // ],
    languaje: {
      url: "//cnd.datatables.net/plug-ins/1.10.20/i18n/spanish.json",
    },
    ajax: {
      url: ` ${base_url}/Usuarios/getUsers`,
      dataSrc: "",
    },
    columns: [{
        data: "id",
      },
      {
        data: "dni",
      },
      {
        data: "name",
      },
      {
        data: "surnames",
      },
      {
        data: "phone",
      },
      {
        data: "email",
      },
      {
        data: "username",
      },
      {
        data: "password",
      },
      {
        data: "rol",
      },
      {
        data: "status",
      },
      {
        data: "options",
      }
    ],
    responsive: "true",
    bDestroy: true,
    iDisplayLenght: 10,
    // order: [
    //   [0, "desc"]
    // ],
  });

  // Registro de nuevo cliente
  const frmUsuarios = document.querySelector("#frmUsuarios");
  frmUsuarios.onsubmit = function (e) {
    e.preventDefault();

    // Extraemos los datos
    const idUsuario = document.querySelector("#idUsuario").value;
    const txtDNI = document.querySelector("#txtDNI").value;
    const txtNombre = document.querySelector("#txtNombre").value;
    const txtApellidos = document.querySelector("#txtApellidos").value;
    const txtTelefono = document.querySelector("#txtTelefono").value;
    const txtEmail = document.querySelector("#txtEmail").value;
    const txtUsuario = document.querySelector("#txtUsuario").value;
    const txtContra = document.querySelector("#txtContra").value;
    const selecRol = document.querySelector("#selecRol").value;
    // const imgUsuario = document.querySelector("#imgUsuario").value;
    const selecEstado = document.querySelector("#selecEstado").value;

    // Validamos si los campos estan vacios para mostrar alerta
    if (
      txtDNI == "" ||
      txtNombre == "" ||
      txtApellidos == "" ||
      txtTelefono == "" ||
      txtEmail == "" ||
      txtUsuario == "" ||
      txtContra == "" ||
      selecRol == "" ||
      // imgUsuario == "" ||
      selecEstado == ""
    ) {
      swal("Atención", "Todos los campos son obligatorios", "error");
      return false;
    }

    const url = `${base_url}Usuarios/setUser`;
    frmDatos = new FormData(this)

    const response = fnt_Fetch(url, 'post', frmDatos)
    response.then(objData => {
      if (objData.status) {
        // Reseteamos los campos del formulario de productos
        frmUsuarios.reset();
        // Cerramos el modal
        $("#modalUsuarios").modal("hide");
        // Enviamos mensaje de exito
        swal("Usuario", objData.msg, "success");
        // Recargamos la tabla
        tblUsuarios.ajax.reload();
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
    //       frmUsuarios.reset();
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

function fntEditUser(id) {
  document.querySelector("#titleModal").innerHTML = "Actualizar Usuario";
  document.querySelector(".modal-header").classList.replace("headerRegister", "headerUpdate");
  document.querySelector("#btnGuardar").classList.replace("btn-primary", "btn-info");
  document.querySelector("#btnText").innerHTML = "Actualizar";

  const url = `${base_url}Usuarios/getUser/${id}`;

  const response = fnt_Fetch(url)
  response.then(infoUser => {
    if (infoUser.status) {
      // MOSTRAMOS LOS DATOS EN LOS CAMPOS DE TEXTO
      // const imgUsuario = document.querySelector("#imgUsuario").value;
      document.querySelector("#idUsuario").value = infoUser.data.id;
      document.querySelector("#txtDNI").value = infoUser.data.dni;
      document.querySelector("#txtNombre").value = infoUser.data.name;
      document.querySelector("#txtApellidos").value = infoUser.data.surnames;
      document.querySelector("#txtTelefono").value = infoUser.data.phone;
      document.querySelector("#txtEmail").value = infoUser.data.email;
      document.querySelector("#txtUsuario").value = infoUser.data.username;
      document.querySelector("#txtContra").value = infoUser.data.password;
      document.querySelector("#lstUser").style.display = "none";

      // HACEMOS SELECT DEL ROL DEL USUARIO
      document.getElementById("selecRol").selectedIndex = infoUser.data.idRol;

      // VALIDA EL ESTADO
      if (infoUser.data.status == 1) {
        var select = '<option value="1" selected class="notBlock">Activo</option>';
      } else if (infoUser.data.status == 0) {
        var select = '<option value="0" selected class="notBlock">Inactivo</option>';
      }
      const htmlSelectEstado = `${select}
                   <option value="1">Activo</option>
                   <option value="0">Inactivo</option>`;
      document.querySelector("#selecEstado").innerHTML = htmlSelectEstado;

      // MOSTRAMOS EL MODAL
      $("#modalUsuarios").modal("show");
    } else {
      // MOSTRAMOS ERROR
      swal("Error", infoUser.msg, "error");
    }
  })
}

function fntDeleteUser(id) {
  swal({
      title: "Deshabilitar Usuario",
      text: "Realmente quiere deshabilitar el usuario?",
      type: "warning",
      showCancelButton: true,
      confirmButtonText: "Sí, Deshabilitar!",
      cancelButtonText: "No, cancelar!",
      closeOnConfirm: false,
      closeOnCancel: true,
    },
    (isConfirm) => {
      if (isConfirm) {
        const url = `${base_url}Usuarios/deleteUser/`;
        const frm = new FormData()
        frm.append('id', id)

        const response = fnt_Fetch(url, 'post', frm)
        response.then(objData => {
          if (objData.status) {
            swal("Eliminar!", objData.msg, "success");
            tblUsuarios.ajax.reload();
          } else {
            swal("Atencion!", objData.msg, "error");
          }
        })
      }
    })
}

function fntEnableUser(id) {
  swal({
      title: "Habilitar Usuario",
      text: "Realmente quiere habilitar el usuario?",
      type: "warning",
      showCancelButton: true,
      confirmButtonText: "Sí, Habilitar!",
      cancelButtonText: "No, cancelar!",
      closeOnConfirm: false,
      closeOnCancel: true,
    },
    (isConfirm) => {
      if (isConfirm) {
        const url = `${base_url}Usuarios/enableUser/`;
        const frm = new FormData()
        frm.append('id', id)

        const response = fnt_Fetch(url, 'post', frm)
        response.then(objData => {
          if (objData.status) {
            swal("Habilitar!", objData.msg, "success");
            tblUsuarios.ajax.reload();
          } else {
            swal("Atencion!", objData.msg, "error");
          }
        })
      }
    })
}

// Funcion para mostrar el modal
function OpenModal() {
  document.querySelector("#idUsuario").value = "";
  document.querySelector("#titleModal").innerHTML = "Nuevo Usuario";
  document
    .querySelector(".modal-header")
    .classList.replace("headerUpdate", "headerRegister");
  document
    .querySelector("#btnGuardar")
    .classList.replace("btn-info", "btn-primary");
  document.querySelector("#btnText").innerHTML = "Guardar";
  document.querySelector("#frmUsuarios").reset();

  $("#modalUsuarios").modal("show");
}

// LLENADO DEL SELEC ROLES
function GetRoles() {
  const url = `${base_url}Usuarios/getRoles`;
  fetch(url)
    .then(response => response.json())
    .then(data => {
      if (data.status) {
        selecRol.options[0] = new Option("Seleccione un rol", "0");
        arrRoles = data.data;

        for (let i = 1; i <= arrRoles.length; i++) {
          selecRol.options[i] = new Option(
            arrRoles[i - 1]["nombreRol"],
            arrRoles[i - 1]["Id"]
          );
        }
      } else {
        swal("Error", data.msg, "error");
      }
    });
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

GetRoles();