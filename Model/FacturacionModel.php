<?php

class FacturacionModel extends Crud
{

     public function __construct()
     {
          parent::__construct();
     }

     public function selectCliente(int $identificacion)
     {
          $this->identificacion = $identificacion;
          $sql = "SELECT cli.Id as Id, cli.Identificacion as Identificacion, cli.Nombre, cli.Telefono, cli.Email, CONCAT(pro.NombreProvincia,', ', can.NombreCanton,', ', dis.nombreDistrito,', ', UPPER(cli.Direccion)) as Direccion FROM clientes as cli INNER JOIN distrito as dis on dis.Id = cli.idDistrito INNER JOIN canton as can on can.Id = dis.idCanton INNER JOIN provincia as pro on pro.Id = can.IdProvincia WHERE cli.Identificacion LIKE '%$this->identificacion%'";
          $resquest = $this->get_OneRegister($sql);
          return $resquest;
     }

     public function selectProduct(string $nameProduct)
     {
          $this->nameProduct = $nameProduct;
          $sql = "SELECT name, price, stock, state FROM productos WHERE name LIKE '%$this->nameProduct%'";
          $resquest = $this->get_OneRegister($sql);
          return $resquest;
     }

     public function selectProducts()
     {
          $sql = "SELECT id, name FROM productos";
          $resquest = $this->get_AllRegister($sql);
          return $resquest;
     }
}