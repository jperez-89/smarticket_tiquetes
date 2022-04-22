<?php

class EventosModel extends Crud
{
     public $idEvento;
     public $nombreEvento;
     public $Status;

     public function __construct()
     {
          parent::__construct();
     }

     public function selectEventos()
     {
          $sql = "SELECT idEvento, nombreEvento, Status FROM eventos";
          $resquest = $this->get_AllRegister($sql);
          return $resquest;
     }

     public function selectEvento(int $idEvento)
     {
          $this->idEvento = $idEvento;
          $sql = "SELECT * FROM eventos WHERE idEvento = $this->idEvento";
          $resquest = $this->get_OneRegister($sql);
          return $resquest;
     }

     public function insertEvento(string $nombreEvento, int $Status)
     {
          $return = "";
          $this->nombreEvento = $nombreEvento;
          $this->Status = $Status;

          // Validamos si existe el evento
          $sql = "SELECT * FROM eventos WHERE nombreEvento = '{$this->nombreEvento}'";
          $resquest = $this->get_AllRegister($sql);

          if (empty($resquest)) {
               $query_insert = "INSERT INTO eventos (nombreEvento, Status) VALUES(?,?)";
               $arrData = array($this->nombreEvento, $this->Status);

               $resquest_insert = $this->Insert_Register($query_insert, $arrData);
               $return = $resquest_insert;
          } else {
               $return = "exist";
          }
          return $return;
     }

     public function updateEvento(int $idEvento, string $nombreEvento, int $Status)
     {
          $this->idEvento = $idEvento;
          $this->nombreEvento = $nombreEvento;
          $this->Status = $Status;

          $sql = "SELECT * FROM eventos WHERE idEvento = $this->idEvento";
          $resquest = $this->get_AllRegister($sql);

          if (!empty($resquest)) {
               $query_update = "UPDATE eventos SET nombreEvento = ?, Status = ? WHERE idEvento = $this->idEvento";
               $arrData = array($this->nombreEvento, $this->Status);

               $resquest = $this->update_Register($query_update, $arrData);
          } else {
               $resquest = "exist";
          }
          return $resquest;
     }

     public function deleteEvento(int $idEvento)
     {
          $this->idEvento = $idEvento;
          $sql = "SELECT * FROM eventos WHERE idEvento = $this->idEvento";
          $resquest = $this->get_OneRegister($sql);

          if (!empty($resquest)) {
               $sql = "UPDATE eventos SET Status = ? WHERE idEvento = $this->idEvento";
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

     public function enableEvento(int $idEvento)
     {
          $this->idEvento = $idEvento;
          $sql = "SELECT * FROM eventos WHERE idEvento = $this->idEvento";
          $resquest = $this->get_OneRegister($sql);

          if (!empty($resquest)) {
               $sql = "UPDATE eventos SET Status = ? WHERE idEvento = $this->idEvento";
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

     public function selectCantEventos()
     {
          $sql = "SELECT count(idEvento) as Cantidad FROM eventos";
          $resquest = $this->get_CountRegister($sql);
          return $resquest;
     }

}
