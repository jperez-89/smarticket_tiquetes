<?php

class  Productos extends Controllers
{
     public function __construct()
     {
          // Ejecutar los metodos del Controllers
          parent::__construct();
     }

     public function Productos()
     {
          $data['page_title'] = "Supermarket  - Productos";
          $data['page_name'] = "Productos";
          $data['page_functions'] = "js/function_Products.js";
          // Hacemos el enlace a la vista
          $this->views->getViews($this, 'productos', $data);
     }

     public function getProductos()
     {
          $arrdatos = $this->model->selectProductos();

          for ($i = 0; $i < count($arrdatos); $i++) {
               if ($arrdatos[$i]['state'] == 1) {
                    $arrdatos[$i]['state'] = '<span class="badge badge-success">Activo</span>';

                    $arrdatos[$i]['options'] = '<div class="p-0 m-0">
                                             <button idProducto="' . $arrdatos[$i]['id'] . '" onClick="fntEditProduct(' . $arrdatos[$i]['id'] . ')" class=" btn btn-sm btn-primary">
                                                  <i class="fas fa-pencil-alt"></i>
                                             </button>
                                             <button idProducto="' . $arrdatos[$i]['id'] . '" onClick="fntDeleteProduct(' . $arrdatos[$i]['id'] . ')" class="btn btn-sm btn-danger">
                                                  <i class="fas fa-trash"></i>
                                             </button>
                                        </div>';
               } else {
                    $arrdatos[$i]['state'] = '<span class="badge badge-danger">Inactivo</span>';

                    $arrdatos[$i]['options'] = '<div class="p-0 m-0">
                                             <button idProducto="' . $arrdatos[$i]['id'] . '" onClick="fntEnableProduct(' . $arrdatos[$i]['id'] . ')" class="btn btn-sm btn-warning">
                                                  <i class="fas fa-sync-alt"></i>
                                             </button>
                                             <button idProducto="' . $arrdatos[$i]['id'] . '"disabled=true class="btn btn-sm btn-danger">
                                                  <i class="fas fa-trash"></i>
                                             </button>
                                        </div>';
               }
          }
          echo json_encode($arrdatos, JSON_UNESCAPED_UNICODE);
          die();
     }

     public function getCantProductos()
     {
          $arrdatos = $this->model->selectCantProductos();

          echo json_encode($arrdatos, JSON_UNESCAPED_UNICODE);
          die();
     }

     public function getProducto(int $idProducto)
     {
          $idProducto = intval(strClean($idProducto));
          if ($idProducto > 0) {
               $arrdatos = $this->model->selectProducto($idProducto);

               if (empty($arrdatos)) {
                    $arrResponse = array('status' => false, 'msg' => 'Datos no encontrados');
               } else {
                    $arrResponse = array('status' => true, 'data' => $arrdatos);
               }
               echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
          }
          die();
     }

     public function setProducto()
     {
          $idProducto = intval($_POST['idProducto']);
          $nombreProducto = strClean($_POST['txtNombre']);
          $PrecioProducto = intval($_POST['txtPrecio']);
          $StockProducto = intval($_POST['txtStock']);
          $DescripcionProducto = strClean($_POST['txtDescripcion']);
          $MedidaProducto = strClean($_POST['selecMedida']);
          $state = strClean($_POST['selecEstado']);

          if ($idProducto == '0') {
               $request_Producto = $this->model->insertProducto($nombreProducto, $PrecioProducto, $StockProducto, $DescripcionProducto, $MedidaProducto, $state);
               $option = 1;
          } else {
               $request_Producto = $this->model->updateProducto($idProducto, $nombreProducto, $PrecioProducto, $StockProducto, $DescripcionProducto, $MedidaProducto);
               $option = 2;
          }


          if ($request_Producto > 0) {
               if ($option == 1) {
                    $arrResponse = array('status' => true, 'msg' => 'Datos guardados.');
               } else {
                    $arrResponse = array('status' => true, 'msg' => 'Datos actualizados.');
               }
          } elseif ($request_Producto == 'exist') {
               $arrResponse = array('status' => false, 'msg' => 'Atencion! El producto ya existe.');
          } else {
               $arrResponse = array('status' => false, 'msg' => 'No es posible almacenar los datos.');
          }
          echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
          die();
     }

     public function deleteProduct()
     {
          if ($_POST) {
               $idProducto = intval($_POST['idProducto']);
               $resquestDelete = $this->model->deleteProducto($idProducto);

               if ($resquestDelete == 'ok') {
                    $arrResponse = array('status' => true, 'msg' => 'Datos eliminados.');
               } elseif ($resquestDelete == 'exist') {
                    $arrResponse = array('status' => false, 'msg' => 'No es posible eliminar el producto, aún tienes disponible.');
               } else {
                    $arrResponse = array('status' => false, 'msg' => 'No es posible eliminar los datos.');
               }
               echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
          }
          die();
     }

     public function enableProduct()
     {
          if ($_POST) {
               $idProducto = intval($_POST['idProducto']);
               $resquestDelete = $this->model->enableProduct($idProducto);

               if ($resquestDelete == 'ok') {
                    $arrResponse = array('status' => true, 'msg' => 'Producto Habilitado.');
               } elseif ($resquestDelete == 'exist') {
                    $arrResponse = array('status' => false, 'msg' => 'No es posible habilitar el producto');
               } else {
                    $arrResponse = array('status' => false, 'msg' => 'No es posible eliminar los datos.');
               }
               echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
          }
          die();
     }
}
