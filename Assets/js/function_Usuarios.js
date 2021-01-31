$("#tblUsuarios").DataTable();

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