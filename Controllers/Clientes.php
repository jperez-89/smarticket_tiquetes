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
          echo json_encode($arrdatos, JSON_UNESCAPED_UNICODE);
          die();
     }

     public function getDistrito(int $idCanton)
     {
          $arrdatos = $this->model->selecDistrito($idCanton);
          echo json_encode($arrdatos, JSON_UNESCAPED_UNICODE);
          die();
     }
}
