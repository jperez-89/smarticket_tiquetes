<?php

class Ventas extends Controllers
{
     public function __construct()
     {
          parent::__construct();
     }

     public function Reserva_entradas()
     {
          $data['page_title'] = "Supermarket  - Nueva Ventas";
          $data['page_name'] = "Reserva Entradas";
          $data['page_functions'] = "js/fnt_NuevaVenta.js";
          // Hacemos el enlace a la vista
          $this->views->getViews($this, 'reserva_entradas', $data);
     }

     public function getEventos()
     {
          $arrdatos = $this->model->selectEventos();
          echo json_encode($arrdatos, JSON_UNESCAPED_UNICODE);
          die();
     }

     public function getTipoEntradas(int $idEvento)
     {
          $arrdatos = $this->model->selectTipoEntradas($idEvento);
          echo json_encode($arrdatos, JSON_UNESCAPED_UNICODE);
          die();
     }

     public function getCliente(string $txtTelefono)
     {
          $txtTelefono = strClean($txtTelefono);
          if ($txtTelefono > 0) {
               $arrdatos = $this->model->selectCliente($txtTelefono);
               if (empty($arrdatos)) {
                    $arrResponse = array('status' => false, 'msg' => 'No existe un cliente con ese número telefónico');
               } else {
                    $arrResponse = array('status' => true, 'data' => $arrdatos);
               }
               echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
          }
          die();
     }

     public function getCantidadEntradas()
     {
          $idEvento = intval(strClean($_POST["idEvento"]));
          $idTipoEntrada = intval(strClean($_POST["idTipoEntrada"]));

          if ($idEvento != 0 && $idTipoEntrada != 0) {
               $arrdatos = $this->model->selectCantEntradas($idEvento, $idTipoEntrada);

               if (empty($arrdatos)) {
                    $arrResponse = array('status' => false, 'msg' => 'Datos no encontrados');
               } else {
                    $arrResponse = array('status' => true, 'data' => $arrdatos);
               }
               echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
          }
          die();
     }

     public function getventas()
     {
          $arrdatos = $this->model->selectVentas();

          for ($i = 0; $i < count($arrdatos); $i++) {
               if ($arrdatos[$i]['tipoReserva'] == 'R') {
                    // ESTADO
                    $arrdatos[$i]['tipoReserva'] = '<span class="badge badge-info">Reservadas</span>';

                    // ACCIONES
                    $arrdatos[$i]['options'] = '<div class="p-0 m-0">
                                             <button onclick="fntConfirmarReserva(' . $arrdatos[$i]['idReservaEntrada'] . ')" class="btn btn-sm btn-primary">
                                                  <i class="fas fa-check"></i> Confirmar venta
                                             </button>
                                             <button onclick="fntDeleteReserva(' . $arrdatos[$i]['idReservaEntrada'] . ')" class="btn btn-sm btn-danger">
                                                  <i class="fas fa-trash"></i> Eliminar Reserva
                                             </button>
                                        </div>';
               } else if ($arrdatos[$i]['tipoReserva'] == 'C')  {
                    // ESTADO
                    $arrdatos[$i]['tipoReserva'] = '<span class="badge badge-success">Compradas</span>';

                    // ACCIONES
                    $arrdatos[$i]['options'] = '<div class="p-0 m-0">
                                             <button onclick="fntVerentradas(' . $arrdatos[$i]['idReservaEntrada'] . ')" class="btn btn-sm btn-success">
                                                  <i class="fas fa-sync-alt"></i>
                                             </button>
                                             // <button idCliente="' . $arrdatos[$i]['idCliente'] . '"disabled=true class="btnDeleteCliente btn btn-sm btn-danger">
                                             //      <i class="fas fa-trash"></i>
                                             // </button>
                                        </div>';
               }
          }

          echo json_encode($arrdatos, JSON_UNESCAPED_UNICODE);
          die();
     }

     public function setReserva()
     {
          try {
               switch ($_POST['op']) {
                    case 'insert':
                         $idCliente = intval($_POST['idCliente']);
                         $idSelecEvento = intval($_POST['selecEventos']);
                         $idSelecTipoEntrada = intval($_POST['selecTipoEntradas']);
                         $Precio = intval($_POST['Precio']);
                         $cantEntradas = intval($_POST['cantEntradas']);
                         $txtTotalPagar = intval($_POST['TotalPagar']);
                         $tipoReserva = "R";

                         $request = $this->model->insertReservaEntrada($idCliente, $idSelecEvento, $idSelecTipoEntrada, $Precio, $cantEntradas, $txtTotalPagar, $tipoReserva);

                         if ($request) {
                              $arrResponse = array('status' => false, 'msg' => 'Cliente llegó al límite de compra para este evento');
                              
                         } else {
                              $arrResponse = array('status' => true, 'msg' => 'Datos guardados.');
                         }
                         break;
                    case 'confirm':
                         # code...
                         break;
               }

               echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
               die();
          } catch (Throwable $th) {
               throw $th;
          }
     }
}
