<?php

class EntradasModel extends Crud
{
     public $idTipoEntrada, $nombreTipoEntrada, $Status, $idEntrada, $idEvento, $CantidadEntradas, $PrecioUnitario, $LimiteCompra;

     public function __construct()
     {
          parent::__construct();
     }

     public function selectTipoEntradas()
     {
          $sql = "SELECT * FROM tipoEntradas";
          $resquest = $this->get_AllRegister($sql);
          return $resquest;
     }

     public function selectTipoEntrada(int $idTipoEntrada)
     {
          $this->idTipoEntrada = $idTipoEntrada;
          $sql = "SELECT idTipoEntrada, nombreTipoEntrada, Status FROM tipoEntradas WHERE idTipoEntrada = $this->idTipoEntrada";
          $resquest = $this->get_OneRegister($sql);
          return $resquest;
     }

     public function insertTipoEntrada(string $nombreTipoEntrada, int $Status)
     {
          $return = "";
          $this->nombreTipoEntrada = $nombreTipoEntrada;
          $this->Status = $Status;

          // Validamos si existe el producto
          $sql = "SELECT * FROM tipoEntradas WHERE nombreTipoEntrada = '$this->nombreTipoEntrada'";
          $resquest = $this->get_AllRegister($sql);

          if (empty($resquest)) {
               $query_insert = "INSERT INTO tipoEntradas (nombreTipoEntrada, Status) VALUES(?,?)";
               $arrData = array($this->nombreTipoEntrada, $this->Status);
               $resquest_insert = $this->Insert_Register($query_insert, $arrData);
               $return = $resquest_insert;
          } else {
               $return = "exist";
          }
          return $return;
     }

     public function updateTipoEntrada(int $idTipoEntrada, string $nombreTipoEntrada, int $Status)
     {
          $this->idTipoEntrada = $idTipoEntrada;
          $this->nombreTipoEntrada = $nombreTipoEntrada;
          $this->Status = $Status;

          // Validamos si existe el producto
          $sql = "SELECT * FROM tipoEntradas WHERE idTipoEntrada = $this->idTipoEntrada";
          $resquest = $this->get_AllRegister($sql);

          if (!empty($resquest)) {
               $query_update = "UPDATE tipoEntradas SET nombreTipoEntrada = ?, Status = ? WHERE idTipoEntrada = $this->idTipoEntrada";

               $arrData = array($this->nombreTipoEntrada, $this->Status);

               $resquest = $this->update_Register($query_update, $arrData);
          } else {
               $resquest = "exist";
          }
          return $resquest;
     }

     public function deleteTipoEntrada(int $idTipoEntrada)
     {
          $this->idTipoEntrada = $idTipoEntrada;
          $sql = "SELECT * FROM tipoEntradas WHERE idTipoEntrada = $this->idTipoEntrada";
          $resquest = $this->get_OneRegister($sql);

          if (!empty($resquest)) {
               $sql = "UPDATE tipoEntradas SET Status = ? WHERE idTipoEntrada = $this->idTipoEntrada";
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

     public function enableTipoEntrada(int $idTipoEntrada)
     {
          $this->idTipoEntrada = $idTipoEntrada;
          $sql = "SELECT * FROM tipoEntradas WHERE idTipoEntrada = $this->idTipoEntrada";
          $resquest = $this->get_OneRegister($sql);

          if (!empty($resquest)) {
               $sql = "UPDATE tipoEntradas SET Status = ? WHERE idTipoEntrada = $this->idTipoEntrada";
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

     public function selectEntradas()
     {
          $sql = "SELECT en.idEntrada, ev.nombreEvento, te.nombreTipoEntrada, en.CantidadEntradas, en.PrecioUnitario, en.EntradasDisponibles, en.LimiteCompra, en.Status 
          FROM entradas en 
          INNER JOIN eventos ev ON ev.idEvento = en.idEvento 
          INNER JOIN tipoentradas te ON te.idTipoEntrada = en.idTipoEntrada
          WHERE en.Status = 1";
          $resquest = $this->get_AllRegister($sql);
          return $resquest;
     }

     public function selectEntrada(int $idEntrada)
     {
          $this->idEntrada = $idEntrada;
          $sql = "SELECT en.idEntrada, en.idEvento, ev.nombreEvento, en.idTipoEntrada, te.nombreTipoEntrada, en.CantidadEntradas, en.PrecioUnitario, en.EntradasDisponibles, en.LimiteCompra, en.Status 
          FROM entradas en 
          INNER JOIN eventos ev ON ev.idEvento = en.idEvento 
          INNER JOIN tipoentradas te ON te.idTipoEntrada = en.idTipoEntrada 
          WHERE idEntrada = $this->idEntrada";
          $resquest = $this->get_OneRegister($sql);
          return $resquest;
     }

     public function insertEntrada(int $idEvento, int $idTipoEntrada, int $CantidadEntradas, int $PrecioUnitario, int $LimiteCompra, int $Status)
     {
          $return = "";
          $this->idEvento = $idEvento;
          $this->idTipoEntrada = $idTipoEntrada;
          $this->CantidadEntradas = $CantidadEntradas;
          $this->PrecioUnitario = $PrecioUnitario;
          $this->LimiteCompra = $LimiteCompra;
          $this->Status = $Status;

          $query_insert = "INSERT INTO entradas (idEvento, idTipoEntrada, CantidadEntradas, PrecioUnitario, EntradasDisponibles, LimiteCompra, Status) VALUES(?,?,?,?,?,?,?)";
          $arrData = array($this->idEvento, $this->idTipoEntrada, $this->CantidadEntradas, $this->PrecioUnitario, $this->CantidadEntradas, $this->LimiteCompra, $this->Status);
          $resquest_insert = $this->Insert_Register($query_insert, $arrData);
          $return = $resquest_insert;
          return $return;
     }

     public function updateEntrada(int $idEntrada, int $idEvento, int $idTipoEntrada, int $CantidadEntradas, int $PrecioUnitario, int $LimiteCompra, int $Status)
     {
          $this->idEntrada = $idEntrada;
          $this->idEvento = $idEvento;
          $this->idTipoEntrada = $idTipoEntrada;
          $this->CantidadEntradas = $CantidadEntradas;
          $this->PrecioUnitario = $PrecioUnitario;
          $this->LimiteCompra = $LimiteCompra;
          $this->Status = $Status;

          $sql = "SELECT * FROM entradas WHERE idEntrada = $this->idEntrada";
          $resquest = $this->get_AllRegister($sql);

          if (!empty($resquest)) {
               $query_update = "UPDATE entradas SET idEvento = ?,  idTipoEntrada = ?, CantidadEntradas = ?, PrecioUnitario = ?, LimiteCompra = ?, Status = ? WHERE idEntrada = $this->idEntrada";
               $arrData = array($this->idEvento, $this->idTipoEntrada, $this->CantidadEntradas, $this->PrecioUnitario, $this->LimiteCompra, $this->Status);
               $resquest = $this->update_Register($query_update, $arrData);
          } else {
               $resquest = "exist";
          }
          return $resquest;
     }
}
