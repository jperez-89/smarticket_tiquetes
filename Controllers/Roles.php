<?php

class  Roles extends Controllers
{
     public function __construct()
     {
          // Ejecutar los metodos del Controllers
          parent::__construct();
     }

     public function Roles()
     {
          $data['page_title'] = "Tienda Virtual - Roles";
          $data['page_name'] = "Roles de usuario";
          $data['page_functions'] = 'js/function_Roles.js';

          // Hacemos el enlace a la vista
          $this->views->getViews($this, 'roles', $data);
     }

     public function getRoles()
     {
          $arrdatos = $this->model->selectRoles();

          for ($i = 0; $i < count($arrdatos); $i++) {
               if ($arrdatos[$i]['status'] == 1) {
                    // ESTADO
                    $arrdatos[$i]['status'] = '<span class="badge badge-success">Activo</span>';

                    // ACCIONES
                    $arrdatos[$i]['options'] = '<div class="p-0 m-0">
                                             <button onclick="fntEditRol(' . $arrdatos[$i]['Id'] . ')" class="btn btn-sm btn-primary">
                                                  <i class="fas fa-pencil-alt"></i>
                                             </button>
                                             <button onclick="fntDeleteRol(' . $arrdatos[$i]['Id'] . ')" class="btn btn-sm btn-danger">
                                                  <i class="fas fa-trash"></i>
                                             </button>
                                        </div>';
               } else {
                    // ESTADO
                    $arrdatos[$i]['status'] = '<span class="badge badge-danger">Inactivo</span>';

                    // ACCIONES
                    $arrdatos[$i]['options'] = '<div class="p-0 m-0">
                                             <button onclick="fntEnableRol(' . $arrdatos[$i]['Id'] . ')" class="btn btn-sm btn-warning">
                                                  <i class="fas fa-sync-alt"></i>
                                             </button>
                                             <button idUser="' . $arrdatos[$i]['Id'] . '"disabled=true class="btnDeleteUser btn btn-sm btn-danger">
                                                  <i class="fas fa-trash"></i>
                                             </button>
                                        </div>';
               }
          }
          echo json_encode($arrdatos, JSON_UNESCAPED_UNICODE);
          die();
     }

     public function getRol(int $idRol)
     {
          $idRol = intval(strClean($idRol));
          if ($idRol > 0) {
               $arrdatos = $this->model->selectRol($idRol);
               if (empty($arrdatos)) {
                    $arrResponse = array('status' => false, 'msg' => 'Datos no encontrados');
               } else {
                    $arrResponse = array('status' => true, 'data' => $arrdatos);
               }
               echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
          }
          die();
     }

     public function setRol()
     {
          $idRol = intval($_POST['idRol']);
          $nombreRol = strClean($_POST['txtNombreRol']);
          $DescripcionRol = strClean($_POST['txtDescripcionRol']);
          $status = intval($_POST['selecEstadoRol']);;

          if ($idRol == 0) {
               $request_Producto = $this->model->insertRol($nombreRol, $DescripcionRol, $status);
               $option = 1;
          } else {
               $request_Producto = $this->model->updateRol($idRol, $nombreRol, $DescripcionRol, $status);
               $option = 2;
          }

          if ($request_Producto > 0) {
               if ($option == 1) {
                    $arrResponse = array('status' => true, 'msg' => 'Datos guardados.');
               } else {
                    $arrResponse = array('status' => true, 'msg' => 'Datos actualizados.');
               }
          } elseif ($request_Producto == 'exist') {
               $arrResponse = array('status' => false, 'msg' => 'Atencion! El rol ya existe.');
          } else {
               $arrResponse = array('status' => false, 'msg' => 'No es posible almacenar los datos.');
          }
          echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
          die();
     }

     public function deleteRol()
     {
          $id = intval($_POST['id']);
          $resquestDelete = $this->model->deleteRol($id);

          if ($resquestDelete == 'ok') {
               $arrResponse = array('status' => true, 'msg' => 'Rol deshabilitado.');
          } elseif ($resquestDelete == 'exist') {
               $arrResponse = array('status' => false, 'msg' => 'No es posible deshabilitar el Rol.');
          } else {
               $arrResponse = array('status' => false, 'msg' => 'No es posible eliminar los datos.');
          }
          echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
          die();
     }

     public function enableRol()
     {
          $id = intval($_POST['id']);
          $request = $this->model->enableRol($id);

          if ($request == 'ok') {
               $arrResponse = array('status' => true, 'msg' => 'Rol habilitado.');
          } elseif ($request == 'exist') {
               $arrResponse = array('status' => false, 'msg' => 'No es posible habilitar el Rol.');
          } else {
               $arrResponse = array('status' => false, 'msg' => 'No es posible eliminar los datos.');
          }
          echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
          die();
     }


}
