<?php

class ClientesModel extends Crud
{
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

          $resquest = array(
               array(
                    "Id" => '1',
                    "NombreDistrito" => 'Prueba',
                    "IdCanton" => '601'
               ),
               array(
                    "id" => '2',
                    "NombreDistrito" => 'Prueba2',
                    "IdCanton" => '601'
               )
          );

          // $sql = "SELECT * FROM Distrito WHERE idCanton = $idCanton";
          // $resquest = $this->get_AllRegister($sql);
          return $resquest;
     }
}
