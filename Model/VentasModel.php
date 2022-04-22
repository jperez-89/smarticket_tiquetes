<?php

class VentasModel extends Crud
{
     public $txtTelefono, $idEvento, $idEntrada, $idCliente, $idTipoEntrada, $PrecioEntrada, $cantEntradas, $TotalPagar, $tipoReserva;

     public function __construct()
     {
          parent::__construct();
     }

     public function selectEventos()
     {
          $sql = "SELECT idEvento, nombreEvento, Status FROM eventos WHERE Status = 1";
          $resquest = $this->get_AllRegister($sql);
          return $resquest;
     }

     public function selectTipoEntradas(int $idEvento)
     {
          $this->idEvento = $idEvento;
          $sql = "SELECT te.nombreTipoEntrada, e.idEntrada, e.idTipoEntrada FROM entradas e INNER JOIN tipoentradas te ON te.idTipoEntrada = e.idTipoEntrada WHERE e.idEvento = $this->idEvento";
          $resquest = $this->get_AllRegister($sql);
          return $resquest;
     }

     public function selectCliente(int $txtTelefono)
     {
          $this->txtTelefono = $txtTelefono;
          $sql = "SELECT idCliente, nombreCliente, telefonoCliente, emailCliente, Status FROM clientes WHERE telefonoCliente = $this->txtTelefono AND Status = 1";
          $resquest = $this->get_OneRegister($sql);
          return $resquest;
     }

     public function selectCantEntradas(int $idEvento, int $idTipoEntrada)
     {
          $this->idEvento = $idEvento;
          $this->idTipoEntrada = $idTipoEntrada;

          $sql = "SELECT EntradasDisponibles, PrecioUnitario, LimiteCompra FROM entradas WHERE idTipoEntrada = $this->idTipoEntrada AND idEvento = $this->idEvento";
          $resquest = $this->get_OneRegister($sql);
          return $resquest;
     }

     public function selectVentas()
     {
          $sql = "SELECT re.idReservaEntrada, c.nombreCliente, e.nombreEvento, te.nombreTipoEntrada, re.PrecioEntrada, re.cantEntradas, re.TotalPagar, re.tipoReserva FROM reservaentradas re INNER JOIN clientes c ON c.idCliente = re.idCliente INNER JOIN eventos e ON e.idEvento = re.idEvento INNER JOIN tipoentradas te ON te.idTipoEntrada = re.idTipoEntrada";
          $resquest = $this->get_AllRegister($sql);
          return $resquest;
     }

     public function insertReservaEntrada(int $idCliente, int $idEvento, int $idTipoEntrada, int $Precio, int $cantEntradas, int $txtTotalPagar, string $tipoReserva)
     {
          $this->idCliente = $idCliente;
          $this->idEvento = $idEvento;
          $this->idTipoEntrada = $idTipoEntrada;
          $this->PrecioEntrada = $Precio;
          $this->cantEntradas = $cantEntradas;
          $this->TotalPagar = $txtTotalPagar;
          $this->tipoReserva = $tipoReserva;

          // Validamos si existe el producto
          $sql = "SELECT idReservaEntrada FROM reservaentradas WHERE idCliente = '$this->idCliente' AND idEvento = '$this->idEvento' AND idTipoEntrada = '$this->idTipoEntrada'";
          $resquest = $this->get_OneRegister($sql);

          if (!empty($resquest)) {
               $return = true;
          } else {
               $query_insert = "INSERT INTO reservaentradas (idCliente, idEvento, idTipoEntrada, PrecioEntrada, cantEntradas, TotalPagar, tipoReserva) VALUES(?,?,?,?,?,?,?)";

               $arrData = array($this->idCliente, $this->idEvento, $this->idTipoEntrada, $this->PrecioEntrada, $this->cantEntradas, $this->TotalPagar, $this->tipoReserva);

               $resquest_insert = $this->Insert_Register($query_insert, $arrData);
               $return = false;
          }
          return $return;
     }
}
