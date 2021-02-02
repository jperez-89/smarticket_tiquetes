<?php

class RolesModel extends Crud
{
     public $idRol;
     public $nombre;
     public $descripcion;
     public $status;

     public function __construct()
     {
          parent::__construct();
     }

     public function selectRoles()
     {
          $sql = "SELECT * FROM roles";
          $resquest = $this->get_AllRegister($sql);
          return $resquest;
     }

     public function selectRol(int $idRol)
     {
          $this->idRol = $idRol;
          $sql = "SELECT * FROM roles WHERE id = $this->idRol";
          $resquest = $this->get_OneRegister($sql);
          return $resquest;
     }

     public function insertRol(string $nombre, string $descripcion, bool $status)
     {
          $return = "";
          $this->nombre = $nombre;
          $this->descripcion = $descripcion;
          $this->status = $status;

          // Validamos si existe el producto
          $sql = "SELECT * FROM roles WHERE nombreRol = '{$this->nombre}'";
          $resquest = $this->get_AllRegister($sql);

          if (empty($resquest)) {
               $query_insert = "INSERT INTO roles(nombreRol, descripcion, status) VALUES(?,?,?)";
               $arrData = array($this->nombre, $this->descripcion, $this->status);
               $resquest_insert = $this->Insert_Register($query_insert, $arrData);
               $return = $resquest_insert;
          } else {
               $return = "exist";
          }
          return $return;
     }

     public function updateRol(int $idRol, string $nombreRol, string $descripcion, int $status)
     {
          $this->idRol = $idRol;
          $this->nombreRol = $nombreRol;
          $this->descripcion = $descripcion;
          $this->status = $status;

          $sql = "SELECT * FROM roles WHERE nombreRol = '$this->nombreRol' AND Id != $this->idRol";
          $resquest = $this->get_AllRegister($sql);

          if (empty($resquest)) {
               $sql = "UPDATE roles SET nombreRol = ?, descripcion = ?, status = ? WHERE Id = $this->idRol";
               $arrData = array($this->nombreRol, $this->descripcion, $this->status);
               $resquest = $this->update_Register($sql, $arrData);
          } else {
               $resquest = "exist";
          }
          return $resquest;
     }
}
