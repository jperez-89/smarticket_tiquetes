<?php

class  Dashboard extends Controllers
{
     public function __construct()
     {
          // Ejecutar los metodos del Controllers
          parent::__construct();
          session_start();
          // VALIDA QUE INICIE SESION SINO LO REGRESA
          // DESCOMENTAR CUANDO ESTE LISTO EL PROYECTO
          // if (empty($_SESSION['login'])) {
          //      header('Location: '.base_url().'login');
          // }
     }

     public function Dashboard()
     {
          $data['page_title'] = "Tienda Virtual - Dashboard";
          $data['page_name'] = "Dashboard";
          // Hacemos el enlace a la vista
          $this->views->getViews($this, 'dashboard', $data);
     }
}