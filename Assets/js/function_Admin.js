document.addEventListener("DOMContentLoaded", function () {
  // Para que se agreguen automaticamente los eventos
});

window.addEventListener(
  "load",
  function () {
    getCantProducts();
    getCantClients()
  },
  false
);

function getCantProducts() {
  // Obtener los datos
  var request = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
  var url = base_url + "Productos/getCantProductos";
  request.open("GET", url, true);
  request.send();

  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      var objData = JSON.parse(request.responseText);
      document.querySelector("#cantProductos").innerHTML = objData[0].Cantidad;
    }
  };
}

function getCantClients() {
  // Obtener los datos
  var request = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
  var url = base_url + "Clientes/getCantClients";
  request.open("GET", url);
  request.send();

  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      var objData = JSON.parse(request.responseText);
      document.querySelector("#cantClientes").innerHTML = objData[0].Cantidad;
    }
  };
}