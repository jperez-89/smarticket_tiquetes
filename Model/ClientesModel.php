<?php

class ClientesModel extends Crud
{
     public $idCliente, $nombreCliente, $telefonoCliente, $emailCliente, $Status;

     public function __construct()
     {
          parent::__construct();
     }

     public function selectClientes()
     {
          $sql = "SELECT idCliente, nombreCliente, telefonoCliente, emailCliente, Status FROM clientes";
          $resquest = $this->get_AllRegister($sql);
          return $resquest;
     }

     public function selectCliente(int $idCliente)
     {
          $this->idCliente = $idCliente;
          $sql = "SELECT idCliente, nombreCliente, telefonoCliente, emailCliente, Status FROM clientes WHERE idCliente = $this->idCliente";
          $resquest = $this->get_OneRegister($sql);
          return $resquest;
     }

     public function selectCantClients()
     {
          $sql = "SELECT count(idCliente) as Cantidad FROM clientes";
          $resquest = $this->get_CountRegister($sql);
          return $resquest;
     }

     public function insertCliente(string $nombreCliente, string $telefonoCliente, string $emailCliente, int $Status)
     {
          $return = "";
          $this->nombreCliente = $nombreCliente;
          $this->telefonoCliente = $telefonoCliente;
          $this->emailCliente = $emailCliente;
          $this->Status = $Status;
          // PrintData('MODELO...' . $identificacionCliente);

          // Validamos si existe el producto
          $sql = "SELECT * FROM clientes WHERE emailCliente = '$this->emailCliente'";
          $resquest = $this->get_AllRegister($sql);

          if (empty($resquest)) {
               $query_insert = "INSERT INTO clientes (nombreCliente, telefonoCliente, emailCliente, Status) VALUES(?,?,?,?)";
               $arrData = array($this->nombreCliente, $this->telefonoCliente, $this->emailCliente, $this->Status);
               $resquest_insert = $this->Insert_Register($query_insert, $arrData);
               $return = $resquest_insert;
          } else {
               $return = "exist";
          }
          return $return;
     }

     public function updateCliente(int $idCliente, string $nombreCliente, string $telefonoCliente, string $emailCliente, int $Status)
     {
          $this->idCliente = $idCliente;
          $this->nombreCliente = $nombreCliente;
          $this->telefonoCliente = $telefonoCliente;
          $this->emailCliente = $emailCliente;
          $this->Status = $Status;

          // Validamos si existe el producto
          $sql = "SELECT * FROM clientes WHERE idCliente = $this->idCliente";
          $resquest = $this->get_AllRegister($sql);

          // PrintData('MODELO...datos ');
          // PrintData($resquest);

          if (!empty($resquest)) {
               $query_update = "UPDATE clientes SET nombreCliente = ?, telefonoCliente = ?, emailCliente = ?, Status = ? WHERE idCliente = $this->idCliente";
               // PrintData('MODELO..QUERY ' . $query_update);

               $arrData = array($this->nombreCliente, $this->telefonoCliente, $this->emailCliente, $this->Status);

               $resquest = $this->update_Register($query_update, $arrData);
          } else {
               $resquest = "exist";
          }
          return $resquest;
     }

     public function deleteCliente(int $idCliente)
     {
          $this->idCliente = $idCliente;
          $sql = "SELECT * FROM clientes WHERE idCliente = $this->idCliente";
          $resquest = $this->get_OneRegister($sql);

          if (!empty($resquest)) {
               $sql = "UPDATE clientes SET Status = ? WHERE idCliente = $this->idCliente";
               $arrData = array(0);
               $resquest = $this->update_Register($sql, $arrData);
               if ($resquest) {
                    $resquest = "ok";
               } else {
                    $resquest = "error";
               }
          } else {
               $resquest = "exist";
          }
          return $resquest;
     }

     public function enableCliente(int $idCliente)
     {
          $this->idCliente = $idCliente;
          $sql = "SELECT * FROM clientes WHERE idCliente = $this->idCliente";
          $resquest = $this->get_OneRegister($sql);

          if (!empty($resquest)) {
               $sql = "UPDATE clientes SET Status = ? WHERE idCliente = $this->idCliente";
               $arrData = array(1);
               $resquest = $this->update_Register($sql, $arrData);
               if ($resquest) {
                    $resquest = "ok";
               } else {
                    $resquest = "error";
               }
          } else {
               $resquest = "exist";
          }
          return $resquest;
     }
}
