<?php

class Conexion
{
     private $conex;

     public function __construct()
     {
          $connetionString = "mysql:host=" . host . "dbname=" . dbName . charset;

          try {
               $this->conex = new PDO($connetionString, user, password);
               $this->conex->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
               // echo "Conexión exitosa";
          } catch (PDOException $ex) {
               $this->conex = "Error de conexión";
               echo 'ERROR: ' . $ex->getMessage();
          }
     }

     public function conect()
     {
          return $this->conex;
     }
}
