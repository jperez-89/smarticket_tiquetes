<?php

class Facturacion extends Controllers
{
     public function __construct()
     {
          // Ejecutar los metodos del Controllers
          parent::__construct();
     }

     public function Nueva_factura()
     {
          // echo " - func ". $this . " -- ";
          $data['page_title'] = "Supermarket  - Nueva Factura";
          $data['page_name'] = "Nueva Factura";
          $data['page_functions'] = "js/function_NuevaFactura.js";
          // Hacemos el enlace a la vista
          $this->views->getViews($this, 'nueva_factura', $data);
     }

     public function getCliente(string $id)
     {
          $identificacion = strClean($id);
          if ($id > 0) {
               $arrdatos = $this->model->selectCliente($identificacion);
               if (empty($arrdatos)) {
                    $arrResponse = array('status' => false, 'msg' => 'Datos no encontrados');
               } else {
                    $arrResponse = array('status' => true, 'data' => $arrdatos);
               }
               echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
          }
          die();
     }

     public function getProduct(string $name)
     {
          $nameProduct = strClean($name);
          if ($nameProduct != " ") {
               $arrdatos = $this->model->selectProduct($nameProduct);
               // print_r($arrdatos);
               if (empty($arrdatos)) {
                    $arrResponse = array('status' => false, 'msg' => 'Datos no encontrados');
               } else {
                    // if ($arrdatos['state'] == 0) {
                    //      $arrResponse = array('status' => false, 'msg' => 'Producto no disponible');
                    // } else {
                    // }
                    $arrResponse = array('status' => true, 'data' => $arrdatos);
               }
               echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
          }
          die();
     }

     public function getProducts()
     {
          $arrdatos = $this->model->selectProducts();
          if (empty($arrdatos)) {
               $arrResponse = array('status' => false, 'msg' => 'Datos no encontrados');
          } else {
               $arrResponse = array('status' => true, 'data' => $arrdatos);
          }
          echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
          die();
     }

     // ============================ FACTURAS CONTROLER ================================================== //

     public function Facturas()
     {
          $data['page_title'] = "Supermarket  - Facturas";
          $data['page_name'] = "Facturas";
          $data['page_functions'] = "js/function_Facturas.js";
          // Hacemos el enlace a la vista
          $this->views->getViews($this, 'facturas', $data);
     }
}
