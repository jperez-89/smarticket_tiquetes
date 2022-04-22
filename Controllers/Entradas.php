<?php

class Entradas extends Controllers
{
     public function __construct()
     {
          // Ejecutar los metodos del Controllers
          parent::__construct();
     }

     // ============================ TIPO ENTRADAS CONTROLER ================================================== //
     public function Tipo_entradas()
     {
          $data['page_title'] = "Smarticket  - Tipo Entradas";
          $data['page_name'] = "Tipo Entradas";
          $data['page_functions'] = "js/fnt_TipoEntradas.js";
          // Hacemos el enlace a la vista
          $this->views->getViews($this, 'tipo_entradas', $data);
     }

     public function getTipoEntradas()
     {
          $arrdatos = $this->model->selectTipoEntradas();

          for ($i = 0; $i < count($arrdatos); $i++) {
               if ($arrdatos[$i]['Status'] == 1) {
                    // ESTADO
                    $arrdatos[$i]['Status'] = '<span class="badge badge-success">Activo</span>';

                    // ACCIONES
                    $arrdatos[$i]['options'] = '<div class="p-0 m-0">
                                             <button onclick="fntEditTipoEntrada(' . $arrdatos[$i]['idTipoEntrada'] . ')" class="btn btn-sm btn-primary">
                                                  <i class="fas fa-pencil-alt"></i>
                                             </button>
                                             <button onclick="fntDeleteTipoEntrada(' . $arrdatos[$i]['idTipoEntrada'] . ')" class="btn btn-sm btn-danger">
                                                  <i class="fas fa-trash"></i>
                                             </button>
                                        </div>';
               } else {
                    // ESTADO
                    $arrdatos[$i]['Status'] = '<span class="badge badge-danger">Inactivo</span>';

                    // ACCIONES
                    $arrdatos[$i]['options'] = '<div class="p-0 m-0">
                                             <button onclick="fntEnableTipoEntrada(' . $arrdatos[$i]['idTipoEntrada'] . ')" class="btn btn-sm btn-warning">
                                                  <i class="fas fa-sync-alt"></i>
                                             </button>
                                             <button idTipoEntrada="' . $arrdatos[$i]['idTipoEntrada'] . '"disabled=true class="btnDeleteTipoEntrada btn btn-sm btn-danger">
                                                  <i class="fas fa-trash"></i>
                                             </button>
                                        </div>';
               }
          }
          echo json_encode($arrdatos, JSON_UNESCAPED_UNICODE);
          die();
     }

     public function getTipoEntrada(int $idTipoEntrada)
     {
          $idTipoEntrada = intval(strClean($idTipoEntrada));
          if ($idTipoEntrada > 0) {
               $arrdatos = $this->model->selectTipoEntrada($idTipoEntrada);
               if (empty($arrdatos)) {
                    $arrResponse = array('status' => false, 'msg' => 'Datos no encontrados');
               } else {
                    $arrResponse = array('status' => true, 'data' => $arrdatos);
               }
               echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
          }
          die();
     }

     public function setTipoEntrada()
     {
          try {
               $idTipoEntrada = intval($_POST['idTipoEntrada']);
               $nombreTipoEntrada = strClean($_POST['txtNombre']);
               $Status = intval($_POST['selecEstado']);

               if ($idTipoEntrada == 0) {
                    $request = $this->model->insertTipoEntrada($nombreTipoEntrada, $Status);
                    $option = 1;
               } else {
                    $request = $this->model->updateTipoEntrada($idTipoEntrada, $nombreTipoEntrada, $Status);
                    $option = 2;
               }

               if ($request > 0) {
                    if ($option == 1) {
                         $arrResponse = array('status' => true, 'msg' => 'Datos guardados.');
                    } else {
                         $arrResponse = array('status' => true, 'msg' => 'Datos actualizados.');
                    }
               } elseif ($request == 'exist') {
                    $arrResponse = array('status' => false, 'msg' => 'Atencion! El tipo de entrada ya existe.');
               } else {
                    $arrResponse = array('status' => false, 'msg' => 'No es posible almacenar los datos.');
               }

               echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
               die();
          } catch (Throwable $th) {
               throw $th;
          }
     }

     public function deleteTipoEntrada()
     {
          $idTipoEntrada = intval($_POST['idTipoEntrada']);
          $resquestDelete = $this->model->deleteTipoEntrada($idTipoEntrada);

          if ($resquestDelete == 'ok') {
               $arrResponse = array('status' => true, 'msg' => 'Tipo de entrada deshabilitada.');
          } elseif ($resquestDelete == 'exist') {
               $arrResponse = array('status' => false, 'msg' => 'No es posible deshabilitar el tipo de entrada.');
          } else {
               $arrResponse = array('status' => false, 'msg' => 'No es posible eliminar los datos.');
          }
          echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
          die();
     }

     public function enableTipoEntrada()
     {
          $idTipoEntrada = intval($_POST['idTipoEntrada']);
          $resquest = $this->model->enableTipoEntrada($idTipoEntrada);

          if ($resquest == 'ok') {
               $arrResponse = array('status' => true, 'msg' => 'Tipo de Entrada Habilitada.');
          } elseif ($resquest == 'exist') {
               $arrResponse = array('status' => false, 'msg' => 'No es posible habilitar el Tipo de Entrada.');
          } else {
               $arrResponse = array('status' => false, 'msg' => 'No es posible eliminar los datos.');
          }
          echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
          die();

     }

     // ============================ ENTRADAS CONTROLER ================================================== //
     public function Agregar_entradas()
     {
          $data['page_title'] = "Smarticket  - Agregar Entradas";
          $data['page_name'] = "Agregar Entradas a Evento";
          $data['page_functions'] = "js/fnt_AgregarEntradas.js";
          // Hacemos el enlace a la vista
          $this->views->getViews($this, 'agregar_entradas', $data);
     }

     public function getEntradas()
     {
          $arrdatos = $this->model->selectEntradas();

          for ($i = 0; $i < count($arrdatos); $i++) {
               if ($arrdatos[$i]['Status'] == 1) {
                    // ESTADO
                    $arrdatos[$i]['Status'] = '<span class="badge badge-success">Activo</span>';

                    // ACCIONES
                    $arrdatos[$i]['options'] = '<div class="p-0 m-0">
                                             <button onclick="fntEditEntrada(' . $arrdatos[$i]['idEntrada'] . ')" class="btn btn-sm btn-primary">
                                                  <i class="fas fa-pencil-alt"></i>
                                             </button>
                                             <button onclick="fntDeleteEntrada(' . $arrdatos[$i]['idEntrada'] . ')" class="btn btn-sm btn-danger">
                                                  <i class="fas fa-trash"></i>
                                             </button>
                                        </div>';
               } else {
                    // ESTADO
                    $arrdatos[$i]['Status'] = '<span class="badge badge-danger">Inactivo</span>';

                    // ACCIONES
                    $arrdatos[$i]['options'] = '<div class="p-0 m-0">
                                             <button onclick="fntEnableEntrada(' . $arrdatos[$i]['idEntrada'] . ')" class="btn btn-sm btn-warning">
                                                  <i class="fas fa-sync-alt"></i>
                                             </button>
                                             <button idEntrada="' . $arrdatos[$i]['idEntrada'] . '"disabled=true class="btnDeleteEntrada btn btn-sm btn-danger">
                                                  <i class="fas fa-trash"></i>
                                             </button>
                                        </div>';
               }
          }
          echo json_encode($arrdatos, JSON_UNESCAPED_UNICODE);
          die();
     }

     public function setEntrada()
     {
          try {
               $idEntrada = intval($_POST['idEntrada']);
               $selecEventos = intval($_POST['selecEventos']);
               $selecTipoEntradas = intval($_POST['selecTipoEntradas']);
               $txtCantidadEntradas = strClean($_POST['txtCantidadEntradas']);
               $txtPrecioUnitario = intval(strClean($_POST['txtPrecioUnitario']));
               $txtLimiteCompra = intval(strClean($_POST['txtLimiteCompra']));
               $Status = intval($_POST['selecEstado']);

               if ($idEntrada == 0) {
                    $request = $this->model->insertEntrada($selecEventos, $selecTipoEntradas, $txtCantidadEntradas, $txtPrecioUnitario, $txtLimiteCompra, $Status);
                    $option = 1;
               } else {
                    $request = $this->model->updateEntrada($idEntrada, $selecEventos, $selecTipoEntradas, $txtCantidadEntradas, $txtPrecioUnitario, $txtLimiteCompra, $Status);
                    $option = 2;
               }

               if ($request > 0) {
                    if ($option == 1) {
                         $arrResponse = array('status' => true, 'msg' => 'Datos guardados.');
                    } else {
                         $arrResponse = array('status' => true, 'msg' => 'Datos actualizados.');
                    }
               } elseif ($request == 'exist') {
                    $arrResponse = array('status' => false, 'msg' => 'Atencion! El tipo de entrada ya existe.');
               } else {
                    $arrResponse = array('status' => false, 'msg' => 'No es posible almacenar los datos.');
               }

               echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
               die();
          } catch (Throwable $th) {
               throw $th;
          }
     }

     public function getEntrada(int $idEntrada)
     {
          $idEntrada = intval(strClean($idEntrada));

          if ($idEntrada > 0) {
               $arrdatos = $this->model->selectEntrada($idEntrada);

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
