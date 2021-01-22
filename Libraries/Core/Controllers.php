<?php

class Controllers
{
     public function __construct()
     {
          // Hacemos la instancia de las vistas
          $this->views = new Views();

          // Para iniciar el metodo automaticamente
          $this->loadModel();
     }
     // Obetemos los modelos de las clases
     public function loadModel()
     {
          $model = get_class($this) . "Model";
          $UrlModel = "Model/" . $model . ".php";

          // Validar si existe el archivo del modelo
          if (file_exists($UrlModel)) {
               require_once($UrlModel);

               $this->model = new $model();
          }
     }
}
