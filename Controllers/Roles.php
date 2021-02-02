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
                    $arrdatos[$i]['status'] = '<span class="badge badge-success">Activo</span>';
               } else {
                    $arrdatos[$i]['status'] = '<span class="badge badge-danger">Inactivo</span>';
               }
               $arrdatos[$i]['options'] = '<div class="p-0 m-0">
                                             <button idRol="' . $arrdatos[$i]['Id'] . '" class="btnEditRol btn btn-sm btn-primary">
                                                  <i class="fas fa-pencil-alt"></i>
                                             </button>
                                             <button idRol="' . $arrdatos[$i]['Id'] . '" class="btnDeleteRol btn btn-sm btn-danger">
                                                  <i class="fas fa-trash"></i>
                                             </button>
                                        </div>';
          }
          echo json_encode($arrdatos, JSON_UNESCAPED_UNICODE);
          die();
     }

     // INSERTA Y ACTUALIZA
     public function setRol()
     {
          $idRol = intval($_POST['idRol']);
          $nombreRol = strClean($_POST['txtNombreRol']);
          $DescripcionRol = strClean($_POST['txtDescripcionRol']);
          $status = intval($_POST['selecEstadoRol']);;

          if ($idRol == "") {
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
}
