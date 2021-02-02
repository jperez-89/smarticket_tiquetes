var tableProductos;

document.addEventListener("DOMContentLoaded", function () {
  // Mostrar los datos en la tabla
  tableProductos = $("#tblProductos").DataTable({
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
      // {
      //   extend: "print",
      //   titleAttr: "Imprimir",
      //   text: '<label><i class="fas fa-print" aria-hidden="true"></i> IMPRIMIR <label/> ',
      //   className: "btn btn-info btn-sm",
      // },
    ],
    languaje: {
      url: "//cnd.datatables.net/plug-ins/1.10.20/i18n/spanish.json",
    },
    ajax: { url: " " + base_url + "/Productos/getProductos", dataSrc: "" },
    columns: [
      { data: "id" },
      { data: "name" },
      { data: "price" },
      { data: "stock" },
      { data: "description" },
      { data: "measure" },
      { data: "state" },
      { data: "img" },
      { data: "options" },
    ],
    responsive: "true",
    bDestroy: true,
    iDisplayLenght: 10,
    order: [[0, "desc"]],
  });

  // Registro de nuevo producto
  var frmProducto = document.querySelector("#frmProducto");
  if (frmProducto != null) {
    frmProducto.onsubmit = function (e) {
      e.preventDefault();

      // Extraemos los datos
      var idProducto = document.querySelector("#idProducto").value;
      var name = document.querySelector("#txtNombre").value;
      var price = document.querySelector("#txtPrecio").value;
      var stock = document.querySelector("#txtStock").value;
      var description = document.querySelector("#txtDescripcion").value;
      var measure = document.querySelector("#selecMedida").value;
      var state = document.querySelector("#selecEstado").value;

      // Validamos si los campos estan vacios para mostrar alerta
      if (
        name == "" ||
        price == "" ||
        stock == "" ||
        description == "" ||
        measure == "" ||
        state == ""
      ) {
        swal("Atención", "Todos los campos son obligatorios", "error");
        return false;
      }

      /* Detecta en cual navegador se encuentra el usuario
                  Si está en chrome o firefox crea un elemento xmlhttprequest
                  sino crea un objeto activexobjet de microsoft
             */
      var request = window.XMLHttpRequest
        ? new XMLHttpRequest()
        : new ActiveXObject("Microsoft.XMLHTTP");

      var ajaxUrl = base_url + "Productos/setProducto";
      var frmData = new FormData(frmProducto);

      //   Enviamos los datos por medio de ajax
      request.open("POST", ajaxUrl, true);
      request.send(frmData);
      request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
          // console.log(request);
          // console.log(request.responseText);
          var objData = JSON.parse(request.responseText);

          if (objData.status) {
            // Reseteamos los campos del formulario de productos
            frmProducto.reset();
            // Cerramos el modal
            $("#modalProductos").modal("hide");
            // Enviamos mensaje de exito
            swal("Productos", objData.msg, "success");
            // Recargamos la tabla
            tableProductos.ajax.reload(function () {
              fntEditProducto();
              fntDeleteProducto();
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

$("#tblProductos").DataTable();

// Funcion para mostrar el modal
function OpenModal() {
  document.querySelector("#idProducto").value = "";
  document.querySelector("#titleModal").innerHTML = "Nuevo Producto";
  document
    .querySelector(".modal-header")
    .classList.replace("headerUpdate", "headerRegister");
  document
    .querySelector("#btnGuardar")
    .classList.replace("btn-info", "btn-primary");
  document.querySelector("#btnText").innerHTML = "Guardar";
  document.querySelector("#frmProducto").reset();
  $("#modalProductos").modal("show");
}

// Para que se agreguen automaticamente los eventos
window.addEventListener(
  "load",
  function () {
    fntEditProducto();
    fntDeleteProducto();
  },
  false
);

function fntEditProducto() {
  // Todos los elementos que tengan la clase
  var btnEditProducto = document.querySelectorAll(".btnEditProducto");
  // Por cada elemento le agregamos un evento click para mostrar el modal
  btnEditProducto.forEach(function (btnEditProducto) {
    btnEditProducto.addEventListener("click", function () {
      // Editar el estilo del modal
      document.querySelector("#titleModal").innerHTML = "Actualizar Producto";
      document
        .querySelector(".modal-header")
        .classList.replace("headerRegister", "headerUpdate");
      document
        .querySelector("#btnGuardar")
        .classList.replace("btn-primary", "btn-info");
      document.querySelector("#btnText").innerHTML = "Actualizar";

      // Obtener los datos
      var idProducto = this.getAttribute("idProducto");
      var request = window.XMLHttpRequest
        ? new XMLHttpRequest()
        : new ActiveXObject("Microsoft.XMLHTTP");
      var UrlUpdateProducto = base_url + "Productos/getProducto/" + idProducto;
      request.open("GET", UrlUpdateProducto, true);
      request.send();

      request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
          var objData = JSON.parse(request.responseText);

          // Mostar los datos en los campos para editar
          if (objData.status) {
            document.querySelector("#idProducto").value = objData.data.id;
            document.querySelector("#txtNombre").value = objData.data.name;
            document.querySelector("#txtPrecio").value = objData.data.price;
            document.querySelector("#txtStock").value = objData.data.stock;
            document.querySelector("#txtDescripcion").value =
              objData.data.description;
            document.querySelector("#selecMedida").value = objData.data.measure;
            document.querySelector("#selecEstado").value = objData.data.state;

            // validamos las unidades de medida
            if (objData.data.measure == "KG") {
              var select =
                '<option value="KG" selected class="notBlock">KG</option>';
            } else if (objData.data.measure == "UNIDAD") {
              var select =
                '<option value="UNIDAD" selected class="notBlock">UNIDAD</option>';
            }

            var htmlSelectMedida = `${select}
            <option value="KG">KG </option>
            <option value="UNIDAD">UNIDAD </option>
            `;

            // Validamos el estado
            if (objData.data.state == 1) {
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
            document.querySelector("#selecMedida").innerHTML = htmlSelectMedida;
            document.querySelector("#selecEstado").innerHTML = htmlSelectEstado;
            $("#modalProductos").modal("show");
          } else {
            // Mostramos error
            swal("Error", objData.msg, "error");
          }
        }
      };

      // Mostramos el modal
      // $("#modalProductos").modal("show");
    });
  });
}

function fntDeleteProducto() {
  // Todos los elementos que tengan la clase
  var btnDeleteProducto = document.querySelectorAll(".btnDeleteProducto");
  // Por cada elemento le agregamos un evento click para mostrar el modal
  btnDeleteProducto.forEach(function (btnDeleteProducto) {
    btnDeleteProducto.addEventListener("click", function () {
      // Obtener los datos
      var idProducto = this.getAttribute("idProducto");

      swal(
        {
          title: "Eliminar Producto",
          text: "Realmente quiere eliminar el producto?",
          type: "warning",
          showCancelButton: true,
          confirmButtonText: "Sí, eliminar!",
          cancelButtonText: "No, cancelar!",
          closeOnConfirm: false,
          closeOnCancel: true,
        },
        (isConfirm) => {
          if (isConfirm) {
            var request = window.XMLHttpRequest
              ? new XMLHttpRequest()
              : new ActiveXObject("Microsoft.XMLHTTP");

            var UrlDeleteProducto = base_url + "Productos/deleteProduct/";
            var data = "idProducto=" + idProducto;
            request.open("POST", UrlDeleteProducto, true);
            request.setRequestHeader(
              "Content-type",
              "application/x-www-form-urlencoded"
            );
            request.send(data);

            request.onreadystatechange = function () {
              if (request.readyState == 4 && request.status == 200) {
                var objData = JSON.parse(request.responseText);
                if (objData.status) {
                  swal("Eliminar!", objData.msg, "success");
                  tableProductos.ajax.reload(function () {
                    fntEditProducto();
                    fntDeleteProducto();
                  });
                } else {
                  swal("Atencion!", objData.msg, "error");
                }
              }
            };
          }
        }
      );
    });
  });
}
