document.addEventListener("DOMContentLoaded", function () {
  // Para que se agreguen automaticamente los eventos
});

window.addEventListener(
  "load",
  function () {
    getCantEventos();
    getCantClients();
    // getCantUsers();
    this.FechaActual();
  },
  false
);

function getCantEventos() {
  // Obtener los datos
  var request = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
  var url = base_url + "Eventos/getCantEventos";
  request.open("GET", url, true);
  request.send();

  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      var objData = JSON.parse(request.responseText);
      document.querySelector("#cantEventos").innerHTML = objData[0].Cantidad;
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

function getCantUsers() {
  // Obtener los datos
  var request = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
  var url = base_url + "Usuarios/getCantUsers";
  request.open("GET", url);
  request.send();

  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      var objData = JSON.parse(request.responseText);
      document.querySelector("#cantUsers").innerHTML = objData[0].Cantidad;
    }
  };
}

// PONE LA FECHA ACTUAL EN EL CAMPO FECHA
function FechaActual() {
  var fecha = new Date(); //Fecha actual
  var mes = fecha.getMonth() + 1; //obteniendo mes
  var dia = fecha.getDate(); //obteniendo dia
  var anho = fecha.getFullYear(); //obteniendo año
  if (dia < 10)
    dia = '0' + dia; //agrega cero si el menor de 10
  if (mes < 10)
    mes = '0' + mes //agrega cero si el menor de 10
  document.getElementById('txtFecha').value = anho + "-" + mes + "-" + dia;
}

// function getUser() {
//   // Obtener los datos
//   var request = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
//   var url = base_url + "Usuarios/getUser";
//   request.open("GET", url);
//   request.send();

//   request.onreadystatechange = function () {
//     if (request.readyState == 4 && request.status == 200) {
//       var objData = JSON.parse(request.responseText);
//       document.querySelector("#cantUsers").innerHTML = objData[0].Cantidad;
//     }
//   };
// }