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
          $data['page_title'] = "Smarticket  - Clientes";
          $data['page_name'] = "Clientes";
          $data['page_functions'] = "js/fnt_Clientes.js";
          // Hacemos el enlace a la vista
          $this->views->getViews($this, 'clientes', $data);
     }

     public function getClientes()
     {
          $arrdatos = $this->model->selectClientes();

          for ($i = 0; $i < count($arrdatos); $i++) {
               if ($arrdatos[$i]['Status'] == 1) {
                    // ESTADO
                    $arrdatos[$i]['Status'] = '<span class="badge badge-success">Activo</span>';

                    // ACCIONES
                    $arrdatos[$i]['options'] = '<div class="p-0 m-0">
                                             <button onclick="fntEditClient(' . $arrdatos[$i]['idCliente'] . ')" class="btn btn-sm btn-primary">
                                                  <i class="fas fa-pencil-alt"></i>
                                             </button>
                                             <button onclick="fntDeleteClient(' . $arrdatos[$i]['idCliente'] . ')" class="btn btn-sm btn-danger">
                                                  <i class="fas fa-trash"></i>
                                             </button>
                                             <a href="ventas/reserva_entradas?idCliente='. $arrdatos[$i]['idCliente'].'&telefonoCliente=' . $arrdatos[$i]['telefonoCliente'] . '&nombreCliente=' . $arrdatos[$i]['nombreCliente'] . '&emailCliente=' . $arrdatos[$i]['emailCliente'] . '" class="btn btn-sm btn-info">Reservar entradas</a>
                                        </div>';
               } else {
                    // ESTADO
                    $arrdatos[$i]['Status'] = '<span class="badge badge-danger">Inactivo</span>';

                    // ACCIONES
                    $arrdatos[$i]['options'] = '<div class="p-0 m-0">
                                             <button onclick="fntEnableClient(' . $arrdatos[$i]['idCliente'] . ')" class="btn btn-sm btn-warning">
                                                  <i class="fas fa-sync-alt"></i>
                                             </button>
                                             <button idCliente="' . $arrdatos[$i]['idCliente'] . '"disabled=true class="btnDeleteCliente btn btn-sm btn-danger">
                                                  <i class="fas fa-trash"></i>
                                             </button>
                                        </div>';
               }
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

     public function getCantClients()
     {
          $arrdatos = $this->model->selectCantClients();

          echo json_encode($arrdatos, JSON_UNESCAPED_UNICODE);
          die();
     }

     public function setCliente()
     {
          try {
               $idCliente = intval($_POST['idCliente']);
               // $identificacionCliente = strClean($_POST['txtIdentificacion']);
               $nombreCliente = strClean($_POST['txtNombre']);
               $emailCliente = strClean($_POST['txtEmail']);
               $telefonoCliente = strClean($_POST['txtTelefono']);
               // $idDistrito = intval($_POST['selecDistrito']);
               // $direccionCliente = strClean($_POST['txtDireccion']);
               // $actividadCliente = strClean($_POST['txtActividad']);
               // $regimenCliente = strClean($_POST['selecRegimen']);
               $Status = intval($_POST['selecEstado']);
               // PrintData('CONTROLADOR. ID CLIENTE.. ' . $idCliente);
               // PrintData('CONTROLADOR. CEDULA.. ' . $identificacionCliente);
               // PrintData('CONTROLADOR. DISTRITO.. ' . $idDistrito);

               if ($idCliente == 0) {
                    $request_Cliente = $this->model->insertCliente($nombreCliente, $telefonoCliente, $emailCliente, $Status);
                    $option = 1;
               } else {
                    $request_Cliente = $this->model->updateCliente($idCliente, $nombreCliente, $telefonoCliente, $emailCliente, $Status);
                    $option = 2;
               }

               if ($request_Cliente > 0) {
                    if ($option == 1) {
                         $arrResponse = array('status' => true, 'msg' => 'Datos guardados.');
                    } else {
                         $arrResponse = array('status' => true, 'msg' => 'Datos actualizados.');
                    }
               } elseif ($request_Cliente == 'exist') {
                    $arrResponse = array('status' => false, 'msg' => 'Atencion! El cliente ya existe.');
               } else {
                    $arrResponse = array('status' => false, 'msg' => 'No es posible almacenar los datos.');
               }

               echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
               die();
          } catch (Throwable $th) {
               throw $th;
          }
     }

     public function deleteClient()
     {
          $idCliente = intval($_POST['idCliente']);
          $resquestDelete = $this->model->deleteCliente($idCliente);

          if ($resquestDelete == 'ok') {
               $arrResponse = array('status' => true, 'msg' => 'Cliente deshabilitado.');
          } elseif ($resquestDelete == 'exist') {
               $arrResponse = array('status' => false, 'msg' => 'No es posible deshabilitar el cliente.');
          } else {
               $arrResponse = array('status' => false, 'msg' => 'No es posible eliminar los datos.');
          }
          echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
          die();
     }

     public function enableClient()
     {
          $idCliente = intval($_POST['idCliente']);
          $resquestDelete = $this->model->enableCliente($idCliente);

          if ($resquestDelete == 'ok') {
               $arrResponse = array('status' => true, 'msg' => 'Cliente Habilitado.');
          } elseif ($resquestDelete == 'exist') {
               $arrResponse = array('status' => false, 'msg' => 'No es posible habilitar el cliente.');
          } else {
               $arrResponse = array('status' => false, 'msg' => 'No es posible eliminar los datos.');
          }
          echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
          die();
     }
}
