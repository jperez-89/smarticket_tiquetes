<?php

class Eventos extends Controllers
{
     public function __construct()
     {
          // Ejecutar los metodos del Controllers
          parent::__construct();
     }

     public function Eventos()
     {
          $data['page_title'] = "Supermarket  - Eventos";
          $data['page_name'] = "Eventos";
          $data['page_functions'] = "js/fntEventos.js";
          // Hacemos el enlace a la vista
          $this->views->getViews($this, 'eventos', $data);
     }

     public function getEventos()
     {
          $arrdatos = $this->model->selectEventos();

          for ($i = 0; $i < count($arrdatos); $i++) {
               if ($arrdatos[$i]['Status'] == 1) {
                    $arrdatos[$i]['Status'] = '<span class="badge badge-success">Activo</span>';

                    $arrdatos[$i]['options'] = '<div class="p-0 m-0">
                                             <button idEvento="' . $arrdatos[$i]['idEvento'] . '" onClick="fntEditEvento(' . $arrdatos[$i]['idEvento'] . ')" class=" btn btn-sm btn-primary">
                                                  <i class="fas fa-pencil-alt"></i>
                                             </button>
                                             <button idEvento="' . $arrdatos[$i]['idEvento'] . '" onClick="fntDeleteEvento(' . $arrdatos[$i]['idEvento'] . ')" class="btn btn-sm btn-danger">
                                                  <i class="fas fa-trash"></i>
                                             </button>
                                        </div>';
               } else {
                    $arrdatos[$i]['Status'] = '<span class="badge badge-danger">Inactivo</span>';

                    $arrdatos[$i]['options'] = '<div class="p-0 m-0">
                                             <button idEvento="' . $arrdatos[$i]['idEvento'] . '" onClick="fntEnableEvento(' . $arrdatos[$i]['idEvento'] . ')" class="btn btn-sm btn-warning">
                                                  <i class="fas fa-sync-alt"></i>
                                             </button>
                                             <button idEvento="' . $arrdatos[$i]['idEvento'] . '"disabled=true class="btn btn-sm btn-danger">
                                                  <i class="fas fa-trash"></i>
                                             </button>
                                        </div>';
               }
          }
          echo json_encode($arrdatos, JSON_UNESCAPED_UNICODE);
          die();
     }

     public function getEvento(int $idEvento)
     {
          $idEvento = intval(strClean($idEvento));
          if ($idEvento > 0) {
               $arrdatos = $this->model->selectEVento($idEvento);

               if (empty($arrdatos)) {
                    $arrResponse = array('status' => false, 'msg' => 'Datos no encontrados');
               } else {
                    $arrResponse = array('status' => true, 'data' => $arrdatos);
               }
               echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
          }
          die();
     }

     public function setEvento()
     {
          $idEvento = intval($_POST['idEvento']);
          $nombreEvento = strClean($_POST['txtNombre']);
          $Status = intval($_POST['selecEstado']);

          if ($idEvento == 0) {
               $request_Evento = $this->model->insertEvento($nombreEvento, $Status);
               $option = 1;
          } else {
               $request_Evento = $this->model->updateEvento($idEvento, $nombreEvento, $Status);
               $option = 2;
          }

          if ($request_Evento > 0) {
               if ($option == 1) {
                    $arrResponse = array('status' => true, 'msg' => 'Datos guardados.');
               } else {
                    $arrResponse = array('status' => true, 'msg' => 'Datos actualizados.');
               }
          } elseif ($request_Evento == 'exist') {
               $arrResponse = array('status' => false, 'msg' => 'Atencion! El evento ya existe.');
          } else {
               $arrResponse = array('status' => false, 'msg' => 'No es posible almacenar los datos.');
          }
          echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
          die();
     }

     public function deleteEvento()
     {
          if ($_POST) {
               $idEvento = intval($_POST['idEvento']);
               $resquestDelete = $this->model->deleteEvento($idEvento);

               if ($resquestDelete == 'ok') {
                    $arrResponse = array('status' => true, 'msg' => 'Datos eliminados.');
               } elseif ($resquestDelete == 'exist') {
                    $arrResponse = array('status' => false, 'msg' => 'No es posible eliminar el evento, aún está disponible.');
               } else {
                    $arrResponse = array('status' => false, 'msg' => 'No es posible eliminar los datos.');
               }
               echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
          }
          die();
     }

     public function enableEvento()
     {
          $idEvento = intval($_POST['idEvento']);
          $resquestDelete = $this->model->enableEvento($idEvento);

          if ($resquestDelete == 'ok') {
               $arrResponse = array('status' => true, 'msg' => 'Evento Habilitado.');
          } elseif ($resquestDelete == 'exist') {
               $arrResponse = array('status' => false, 'msg' => 'No es posible habilitar el evento.');
          } else {
               $arrResponse = array('status' => false, 'msg' => 'No es posible eliminar los datos.');
          }
          echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
          die();
     }

     public function getCantEventos()
     {
          $arrdatos = $this->model->selectCantEventos();

          echo json_encode($arrdatos, JSON_UNESCAPED_UNICODE);
          die();
     }
}
