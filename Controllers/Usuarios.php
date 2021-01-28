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
          $data['page_functions'] = 'js/function_Usuarios.js';

          // Hacemos el enlace a la vista
          $this->views->getViews($this, 'usuarios', $data);
     }
}
