<?php

class  Users extends Controllers
{
     public function __construct()
     {
          // Ejecutar los metodos del Controllers
          parent::__construct();
     }

     public function Users()
     {
          $data['page_title'] = "Tienda Virtual - Usuarios";
          $data['page_name'] = "Usuarios";
          // Hacemos el enlace a la vista
          $this->views->getViews($this, 'users', $data);
     }
}
