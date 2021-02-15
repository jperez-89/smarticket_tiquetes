<?php

class Crud extends Conexion
{
     private $cone;
     private $stringQuery;
     private $arrValues;

     public function __construct()
     {
          // Hacemos una instancia de la clase conecion
          $this->conex = new Conexion();
          // Obtenemos el enlace
          $this->cone = $this->conex->conect();
     }

     // -----------------> METODO PARA INSERTAR REGISTROS <-----------------
     public function Insert_Register(string $query, array $arrValues)
     {
          // Preparamos el query
          $insert = $this->cone->prepare($query);
          // Ejecutamos la sentencia
          $result = $insert->execute($arrValues);

          // Validamos si se realizo
          if ($result) {
               // Retorna el ultimo Id registrado en la tabla
               $lastInsert = $this->cone->lastInsertId();
          } else {
               $lastInsert = 0;
          }
          return $lastInsert;
     }

     // -----------------> METODO PARA BUSCAR UN REGISTRO <-----------------
     public function get_OneRegister(string $query)
     {
          // Preparamos el query
          $result = $this->cone->prepare($query);
          // Ejecutamos
          $result->execute();
          // Asociamos los valores devueltos
          $data = $result->fetch(PDO::FETCH_ASSOC);
          return $data;
     }

     // -----------------> METODO PARA BUSCAR TODOS LOS REGISTROS <-----------------
     public function get_AllRegister(string $query)
     {
          $this->stringQuery = $query;
          $result = $this->cone->prepare($this->stringQuery);
          $result->execute();
          $data = $result->fetchall(PDO::FETCH_ASSOC);
          $result = null;
          $this->cone = null;
          return $data;
     }

     // -----------------> METODO PARA CONTAR TODOS LOS REGISTROS <-----------------
     public function get_CountRegister(string $query)
     {
          $this->stringQuery = $query;
          $result = $this->cone->prepare($this->stringQuery);
          $result->execute();
          $data = $result->fetchall(PDO::FETCH_ASSOC);
          return $data;
     }

     // -----------------> METODO PARA ACTUALIZAR REGISTRO <-----------------
     public function update_Register(string $query, array $arrValues)
     {
          $this->stringQuery = $query;
          $this->arrValues = $arrValues;
          
          $update = $this->cone->prepare($this->stringQuery);
          $result = $update->execute($this->arrValues);
          return $result;
     }

     // -----------------> METODO PARA ELIMINAR REGISTRO <-----------------
     public function delete_Register(string $query)
     {
          $this->stringQuery = $query;
          $result = $this->cone->prepare($this->stringQuery);
          $result->execute();
          return $result;
     }
}
