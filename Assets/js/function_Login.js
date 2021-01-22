// Login Page Flipbox control
$('.login-content [data-toggle="flip"]').click(function () {
  $(".login-box").toggleClass("flipped");
  return false;
});

document.addEventListener(
  "DOMContentLoaded",
  function () {
    if (document.querySelector("#frmLogin")) {
      let frmLogin = document.querySelector("#frmLogin");

      frmLogin.onsubmit = function (e) {
        e.preventDefault();

        let email = document.querySelector("#txtUsername").value;
        let password = document.querySelector("#txtPassword").value;

        if (email == "" || password == "") {
          swal("Please", "Enter your email and password.", "error");
          return false;
        } else {
          var request = window.XMLHttpRequest
            ? new XMLHttpRequest()
            : new ActiveXObject("Microsoft.XMLHTTP");

          var UrlUser = base_url + "Login/loginUser";
          var frmData = new FormData(frmLogin);

          //   Enviamos los datos por medio de ajax
          request.open("POST", UrlUser, true);
          request.send(frmData);

          request.onreadystatechange = function () {
            if (request.readyState != 4) return;
            if (request.status == 200) {
              var objData = JSON.parse(request.responseText);

              if (objData.status) {
                window.location = base_url + 'dashboard';
              } else {
                swal("Atención", objData.msg, "error");
                document.querySelector("#txtPassword").value = "";
              }
            } else {
              swal("Atención", "Error en el proceso de autenticación", "error");
            }
            return false;
          };
        }
      };
    }
  },
  false
);
