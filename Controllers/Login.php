<?php

class  Login extends Controllers
{
     public function __construct()
     {
          session_start();
          if (isset($_SESSION['login'])) {
               header('Location: ' . base_url() . 'dashboard');
          }
          // Ejecutar los metodos del Controllers
          parent::__construct();


     }

     public function Login()
     {
          $data['page_title'] = "Supermarket - Iniciar";
          $data['page_functions'] = "function_login.js";
          $data['page_name'] = "Supermarket S.A";
          // Hacemos el enlace a la vista
          $this->views->getViews($this, 'Login', $data);
     }

     public function loginUser()
     {
          if ($_POST) {
               if (empty($_POST['txtUsername']) || empty($_POST['txtPassword'])) {
                    $arrResponse = array('status' => false, 'msg' => 'Complete todos los campos.');
               } else {
                    $user = strtolower(strClean($_POST['txtUsername']));
                    // $pass = hash("SHA256", $_POST['txtPassword']);
                    $pass =  strClean($_POST['txtPassword']);
                    $requestUser = $this->model->loginUser($user, $pass);

                    if (empty($requestUser)) {
                         $arrResponse = array('status' => false, 'msg' => 'Usuario o contraseña incorrectos.');
                    } else {
                         $arrData = $requestUser;
                         // ObjFormat($arrData);
                         if ($arrData['username'] != "") {
                              $_SESSION['username'] = $arrData['username'];
                              $_SESSION['login'] = true;
                              $arrResponse = array('status' => true, 'msg' => 'ok');
                         } else {
                              $arrResponse = array('status' => false, 'msg' => 'Usuario inactivo, contacta al administrador al email jrwc1989@gmail.com.');
                         }
                    }
               }
               echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
          }
          die();
     }
}
