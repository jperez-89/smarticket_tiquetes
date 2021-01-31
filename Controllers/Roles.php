<?php

class  Roles extends Controllers
{
     public function __construct()
     {
          // Ejecutar los metodos del Controllers
          parent::__construct();
     }

     public function Roles()
     {
          $data['page_title'] = "Tienda Virtual - Roles";
          $data['page_name'] = "Roles de usuario";
          $data['page_functions'] = 'js/function_Roles.js';

          // Hacemos el enlace a la vista
          $this->views->getViews($this, 'roles', $data);
     }
}
