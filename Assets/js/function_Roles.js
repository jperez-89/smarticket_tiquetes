$("#tblRoles").DataTable();

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
