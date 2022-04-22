<?php

class  Dashboard extends Controllers
{
     public function __construct()
     {
          // Ejecutar los metodos del Controllers
          parent::__construct();
          
          // VALIDA QUE INICIE SESION SINO LO REGRESA
          // DESCOMENTAR CUANDO ESTE LISTO EL PROYECTO
          // session_start();
          // if (empty($_SESSION['login'])) {
          //      header('Location: '.base_url().'login');
          // }
     }

     public function Dashboard()
     {
          $data['page_title'] = "Smarticket - Panel de Control";
          $data['page_name'] = "Panel de Control";
          $data['page_functions'] = 'js/function_Admin.js';
          // Hacemos el enlace a la vista
          $this->views->getViews($this, 'dashboard', $data);
     }
}