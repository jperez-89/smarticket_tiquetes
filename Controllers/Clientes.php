<?php

class  Clientes extends Controllers
{
     public function __construct()
     {
          // Ejecutar los metodos del Controllers
          parent::__construct();
     }

     public function Clientes()
     {
          $data['page_title'] = "Supermarket  - Clientes";
          $data['page_name'] = "Clientes";
          $data['page_functions'] = "js/function_Clientes.js";
          // Hacemos el enlace a la vista
          $this->views->getViews($this, 'clientes', $data);
     }

     public function getProvincia()
     {
          $arrdatos = $this->model->selecProvincias();
          echo json_encode($arrdatos, JSON_UNESCAPED_UNICODE);
          die();
     }

     public function getCanton(int $idProvincia)
     {
          $arrdatos = $this->model->selecCanton($idProvincia);
          if (empty($arrdatos)) {
               $arrdatos = array('status' => false, 'msg' => 'Datos no encontrados');
          } else {
               $arrdatos = array('status' => true, 'data' => $arrdatos);
          }
          echo json_encode($arrdatos, JSON_UNESCAPED_UNICODE);
          die();
     }

     public function getDistrito(int $idCanton)
     {
          $arrdatos = $this->model->selecDistrito($idCanton);
          if (empty($arrdatos)) {
               $arrdatos = array('status' => false, 'msg' => 'Datos no encontrados');
          } else {
               $arrdatos = array('status' => true, 'data' => $arrdatos);
          }
          echo json_encode($arrdatos, JSON_UNESCAPED_UNICODE);
          die();
     }

     public function getClientes()
     {
          $arrdatos = $this->model->selectClientes();

          for ($i = 0; $i < count($arrdatos); $i++) {
               if ($arrdatos[$i]['Status'] == 1) {
                    $arrdatos[$i]['Status'] = '<span class="badge badge-success">Activo</span>';
               } else {
                    $arrdatos[$i]['Status'] = '<span class="badge badge-danger">Inactivo</span>';
               }
               $arrdatos[$i]['options'] = '<div class="p-0 m-0">
                                             <button idCliente="' . $arrdatos[$i]['Id'] . '" class="btnEditCliente btn btn-sm btn-primary">
                                                  <i class="fas fa-pencil-alt"></i>
                                             </button>
                                             <button idCliente="' . $arrdatos[$i]['Id'] . '" class="btnDeleteCliente btn btn-sm btn-danger">
                                                  <i class="fas fa-trash"></i>
                                             </button>
                                        </div>';
          }
          echo json_encode($arrdatos, JSON_UNESCAPED_UNICODE);
          die();
     }

     public function getCliente(int $idCliente)
     {
          $idCliente = intval(strClean($idCliente));
          if ($idCliente > 0) {
               $arrdatos = $this->model->selectCliente($idCliente);
               if (empty($arrdatos)) {
                    $arrResponse = array('status' => false, 'msg' => 'Datos no encontrados');
               } else {
                    $arrResponse = array('status' => true, 'data' => $arrdatos);
               }
               echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
          }
          die();
     }

     public function setCliente()
     {
          $idCliente = intval($_POST['idCliente']);
          $identificacionCliente = strClean($_POST['txtIdentificacion']);
          $nombreCliente = strClean($_POST['txtNombre']);
          $EmailCliente = strClean($_POST['txtEmail']);
          $telefonoCliente = strClean($_POST['txtTelefono']);
          $idDistrito = intval($_POST['selecDistrito']);
          $DireccionCliente = strClean($_POST['txtDireccion']);
          $actividadCliente = strClean($_POST['txtActividad']);
          $regimenCliente = strClean($_POST['selecRegimen']);
          $Status = intval($_POST['selecEstado']);

          if ($idCliente == "") {
               $request_Cliente = $this->model->insertCliente($identificacionCliente, $nombreCliente, $telefonoCliente, $EmailCliente, $idDistrito, $DireccionCliente, $actividadCliente, $regimenCliente, $Status);
               $option = 1;
          } else {
               $request_Cliente = $this->model->updateCliente($idCliente, $nombreCliente, $telefonoCliente, $EmailCliente, $idDistrito, $DireccionCliente, $actividadCliente, $regimenCliente, $Status);
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
     }
}
