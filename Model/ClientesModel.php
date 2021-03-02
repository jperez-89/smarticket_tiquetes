<?php

class ClientesModel extends Crud
{
     public $idCliente, $identificacionCliente, $nombreCliente, $telefonoCliente, $emailCliente, $idDistrito, $direccionCliente, $actividadCliente, $regimenCliente, $Status;

     public function __construct()
     {
          parent::__construct();
     }

     public function selecProvincias()
     {
          $sql = "SELECT * FROM provincia";
          $resquest = $this->get_AllRegister($sql);
          return $resquest;
     }

     public function selecCanton(int $idProvincia)
     {
          $sql = "SELECT * FROM Canton WHERE idProvincia = $idProvincia";
          $resquest = $this->get_AllRegister($sql);
          return $resquest;
     }

     public function selecDistrito(int $idCanton)
     {
          $sql = "SELECT * FROM distrito WHERE idCanton = $idCanton";
          $resquest = $this->get_AllRegister($sql);
          return $resquest;
     }

     public function selectClientes()
     {
          $sql = "SELECT cli.Id, cli.Identificacion, cli.Nombre, cli.Telefono, cli.Email, CONCAT(pro.NombreProvincia, ', ', can.NombreCanton, ', ', dis.nombreDistrito, ', ', UCASE(cli.Direccion)) as Direccion, cli.Actividad, cli.Regimen, cli.Status FROM clientes as cli INNER JOIN distrito as dis on dis.Id = cli.idDistrito INNER JOIN canton as can on can.Id = dis.idCanton INNER JOIN provincia as pro on pro.Id = can.IdProvincia";
          $resquest = $this->get_AllRegister($sql);
          return $resquest;
     }

     public function selectCliente(int $idCliente)
     {
          $this->idCliente = $idCliente;
          $sql = "SELECT cli.Id, cli.Identificacion, cli.Nombre, cli.Telefono, cli.Email, pro.Id as idProvincia, can.Id as idCanton, dis.Id as idDistrito, cli.Direccion, cli.Actividad, cli.Regimen, cli.Status FROM clientes as cli INNER JOIN distrito as dis on dis.Id = cli.idDistrito INNER JOIN canton as can on can.Id = dis.idCanton INNER JOIN provincia as pro on pro.Id = can.IdProvincia WHERE cli.Id = $this->idCliente";
          $resquest = $this->get_OneRegister($sql);
          return $resquest;
     }

     public function insertCliente(string $identificacionCliente, string $nombreCliente, string $telefonoCliente, string $emailCliente, int $idDistrito, string $direccionCliente, string $actividadCliente, string $regimenCliente, int $Status)
     {
          $return = "";
          $this->identificacionCliente = $identificacionCliente;
          $this->nombreCliente = $nombreCliente;
          $this->telefonoCliente = $telefonoCliente;
          $this->emailCliente = $emailCliente;
          $this->idDistrito = $idDistrito;
          $this->direccionCliente = $direccionCliente;
          $this->actividadCliente = $actividadCliente;
          $this->regimenCliente = $regimenCliente;
          $this->Status = $Status;

          // Validamos si existe el producto
          $sql = "SELECT * FROM clientes WHERE Identificacion = '$this->identificacionCliente'";
          $resquest = $this->get_AllRegister($sql);

          if (empty($resquest)) {
               $query_insert = "INSERT INTO clientes(Identificacion, Nombre, Telefono, Email, idDistrito, Direccion, Actividad, Regimen, Status) VALUES(?,?,?,?,?,?,?,?,?)";
               $arrData = array($this->identificacionCliente, $this->nombreCliente, $this->telefonoCliente, $this->emailCliente, $this->idDistrito, $this->direccionCliente, $this->actividadCliente, $this->regimenCliente, $this->Status);
               $resquest_insert = $this->Insert_Register($query_insert, $arrData);
               $return = $resquest_insert;
          } else {
               $return = "exist";
          }
          return $return;
     }

     public function updateCliente(int $idCliente, string $nombreCliente, string $telefonoCliente, string $emailCliente, int $idDistrito, string $direccionCliente, string $actividadCliente, string $regimenCliente, int $Status)
     {
          $this->idCliente = $idCliente;
          $this->nombreCliente = $nombreCliente;
          $this->telefonoCliente = $telefonoCliente;
          $this->emailCliente = $emailCliente;
          $this->idDistrito = $idDistrito;
          $this->direccionCliente = $direccionCliente;
          $this->actividadCliente = $actividadCliente;
          $this->regimenCliente = $regimenCliente;
          $this->Status = $Status;

          // Validamos si existe el producto
          $sql = "SELECT * FROM clientes WHERE Nombre = '$this->nombreCliente' AND Id != $this->idCliente";
          $resquest = $this->get_AllRegister($sql);

          if (!empty($resquest)) {
               $query_update = "UPDATE clientes SET Nombre = ?, Telefono = ?, Email = ?, idDistrito = ?, Direccion = ?, Actividad = ?, Regimen = ?, Status = ? WHERE Id = $this->idCliente";

               $arrData = array($this->nombreCliente, $this->telefonoCliente, $this->emailCliente, $this->idDistrito, $this->direccionCliente, $this->actividadCliente, $this->regimenCliente, $this->Status);

               $resquest = $this->update_Register($query_update, $arrData);
          } else {
               $resquest = "exist";
          }
          return $resquest;
     }
}
