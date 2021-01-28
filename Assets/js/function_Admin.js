document.addEventListener("DOMContentLoaded", function () {
  // Para que se agreguen automaticamente los eventos
});

window.addEventListener(
  "load",
  function () {
    obtenerCantProductos();
  },
  false
);

function obtenerCantProductos() {
  // Obtener los datos
  var request = window.XMLHttpRequest
    ? new XMLHttpRequest()
    : new ActiveXObject("Microsoft.XMLHTTP");
  var UrlGetProductos = base_url + "Productos/getCantProductos";
  request.open("GET", UrlGetProductos, true);
  request.send();

  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      var objData = JSON.parse(request.responseText);
      document.querySelector("#cantProductos").innerHTML = objData[0].Cantidad;
    }
  };
}
