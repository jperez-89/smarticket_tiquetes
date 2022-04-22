<?php

class  Usuarios extends Controllers
{
     public function __construct()
     {
          // Ejecutar los metodos del Controllers
          parent::__construct();
     }

     public function Usuarios()
     {
          $data['page_title'] = "Tienda Virtual - Usuarios";
          $data['page_name'] = "Usuarios";
          $data['page_functions'] = 'js/function_Usuarios.js';

          // Hacemos el enlace a la vista
          $this->views->getViews($this, 'usuarios', $data);
     }

     public function getCantUsers()
     {
          $arrdatos = $this->model->selectCantUsers();

          echo json_encode($arrdatos, JSON_UNESCAPED_UNICODE);
          die();
     }

     public function getUsers()
     {
          $arrdatos = $this->model->selectUsers();

          for ($i = 0; $i < count($arrdatos); $i++) {
               if ($arrdatos[$i]['status'] == 1) {
                    // ESTADO
                    $arrdatos[$i]['status'] = '<span class="badge badge-success">Activo</span>';

                    // ACCIONES
                    $arrdatos[$i]['options'] = '<div class="p-0 m-0">
                                             <button onclick="fntEditUser(' . $arrdatos[$i]['id'] . ')" class="btn btn-sm btn-primary">
                                                  <i class="fas fa-pencil-alt"></i>
                                             </button>
                                             <button onclick="fntDeleteUser(' . $arrdatos[$i]['id'] . ')" class="btn btn-sm btn-danger">
                                                  <i class="fas fa-trash"></i>
                                             </button>
                                        </div>';
               } else {
                    // ESTADO
                    $arrdatos[$i]['status'] = '<span class="badge badge-danger">Inactivo</span>';

                    // ACCIONES
                    $arrdatos[$i]['options'] = '<div class="p-0 m-0">
                                             <button onclick="fntEnableUser(' . $arrdatos[$i]['id'] . ')" class="btn btn-sm btn-warning">
                                                  <i class="fas fa-sync-alt"></i>
                                             </button>
                                             <button idUser="' . $arrdatos[$i]['id'] . '"disabled=true class="btnDeleteUser btn btn-sm btn-danger">
                                                  <i class="fas fa-trash"></i>
                                             </button>
                                        </div>';
               }
          }
          echo json_encode($arrdatos, JSON_UNESCAPED_UNICODE);
          die();
     }

     public function getUser(int $id)
     {
          $id = intval(strClean($id));
          if ($id > 0) {
               $arrdatos = $this->model->selectUser($id);
               if (empty($arrdatos)) {
                    $arrResponse = array('status' => false, 'msg' => 'Datos no encontrados');
               } else {
                    $arrResponse = array('status' => true, 'data' => $arrdatos);
               }
               echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
          }
          die();
     }

     public function getRoles()
     {
          $arrdatos = $this->model->selecRoles();
          if (empty($arrdatos)) {
               $arrdatos = array('status' => false, 'msg' => 'Datos no encontrados');
          } else {
               $arrdatos = array('status' => true, 'data' => $arrdatos);
          }
          echo json_encode($arrdatos, JSON_UNESCAPED_UNICODE);
          die();
     }

     public function setUser()
     {
          try {
               $idUsuario = intval($_POST['idUsuario']);
               $txtDNI = strClean($_POST['txtDNI']);
               $txtNombre = strClean($_POST['txtNombre']);
               $txtApellidos = strClean($_POST['txtApellidos']);
               $txtTelefono = strClean($_POST['txtTelefono']);
               $txtEmail = strClean($_POST['txtEmail']);
               $txtUsuario = strClean($_POST['txtUsuario']);
               $txtContra = strClean($_POST['txtContra']);
               $selecRol = intval($_POST['selecRol']);
               // $imgUsuario = strClean($_POST['selecRol']);
               $selecEstado = intval($_POST['selecEstado']);

               if ($idUsuario == 0) {
                    $request_Cliente = $this->model->insertUser($txtDNI, $txtNombre, $txtApellidos, $txtTelefono, $txtEmail, $txtUsuario, $txtContra, $selecRol, $selecEstado);
                    // $imgUsuario,
                    $option = 1;
               } else {
                    $request_Cliente = $this->model->updateCliente($idUsuario, $txtNombre, $txtApellidos, $txtTelefono, $txtEmail, $txtUsuario, $txtContra, $selecRol);
                    $option = 2;
               }

               if ($request_Cliente > 0) {
                    if ($option == 1) {
                         $arrResponse = array('status' => true, 'msg' => 'Datos guardados.');
                    } else {
                         $arrResponse = array('status' => true, 'msg' => 'Datos actualizados.');
                    }
               } elseif ($request_Cliente == 'exist') {
                    $arrResponse = array('status' => false, 'msg' => 'Atencion! El producto ya existe.');
               } else {
                    $arrResponse = array('status' => false, 'msg' => 'No es posible almacenar los datos.');
               }

               echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
               die();
          } catch (Throwable $th) {
               throw $th;
          }
     }

     public function deleteUser()
     {
          $id = intval($_POST['id']);
          if ($id == 1) {
               $arrResponse = array('status' => false, 'msg' => 'Usuario Administrador del sistema, no se puede deshabilitar');
          } else {
               $resquestDelete = $this->model->deleteUser($id);

               if ($resquestDelete == 'ok') {
                    $arrResponse = array('status' => true, 'msg' => 'Usuario deshabilitado.');
               } elseif ($resquestDelete == 'exist') {
                    $arrResponse = array('status' => false, 'msg' => 'No es posible deshabilitar el Usuario.');
               } else {
                    $arrResponse = array('status' => false, 'msg' => 'No es posible eliminar los datos.');
               }
          }
          echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
          die();
     }

     public function enableUser()
     {
          $id = intval($_POST['id']);
          $request = $this->model->enableUser($id);

          if ($request == 'ok') {
               $arrResponse = array('status' => true, 'msg' => 'Usuario habilitado.');
          } elseif ($request == 'exist') {
               $arrResponse = array('status' => false, 'msg' => 'No es posible habilitar el Usuario.');
          } else {
               $arrResponse = array('status' => false, 'msg' => 'No es posible eliminar los datos.');
          }
          echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
          die();
     }
}
