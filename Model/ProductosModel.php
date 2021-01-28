<?php

class ProductosModel extends Crud
{
     public $idProducto;
     public $nombre;
     public $precio;
     public $stock;
     public $descripcion;
     public $medida;
     public $state;

     public function __construct()
     {
          parent::__construct();
     }

     public function selectProductos()
     {
          // $sql = "SELECT * FROM productos WHERE state != 0 AND stock > 0";
          // $sql = "SELECT * FROM productos WHERE state != 0";
          $sql = "SELECT * FROM productos";
          $resquest = $this->get_AllRegister($sql);
          return $resquest;
     }

     public function selectCantProductos()
     {
          $sql = "SELECT count(id) as Cantidad FROM productos";
          $resquest = $this->get_CountRegister($sql);
          return $resquest;
     }

     public function selectProducto(int $idProducto)
     {
          $this->idProducto = $idProducto;
          $sql = "SELECT * FROM productos WHERE id = $this->idProducto";
          $resquest = $this->get_OneRegister($sql);
          return $resquest;
     }

     public function insertProducto(string $nombre, int $precio, int $stock, string $descripcion, string $medida, int $state)
     {
          $return = "";
          $this->nombre = $nombre;
          $this->precio = $precio;
          $this->stock = $stock;
          $this->descripcion = $descripcion;
          $this->medida = $medida;
          $this->state = $state;

          // Validamos si existe el producto
          $sql = "SELECT * FROM productos WHERE name = '{$this->nombre}'";
          $resquest = $this->get_AllRegister($sql);

          if (empty($resquest)) {
               $query_insert = "INSERT INTO productos(name, price, stock, description, measure, state) VALUES(?,?,?,?,?,?)";
               $arrData = array($this->nombre, $this->precio, $this->stock, $this->descripcion, $this->medida, $this->state);
               $resquest_insert = $this->Insert_Register($query_insert, $arrData);
               $return = $resquest_insert;
          } else {
               $return = "exist";
          }
          return $return;
     }

     public function updateProducto(int $idProducto, string $nombre, int $precio, int $stock, string $descripcion, string $medida, int $state)
     {
          $this->idProducto = $idProducto;
          $this->nombre = $nombre;
          $this->precio = $precio;
          $this->stock = $stock;
          $this->descripcion = $descripcion;
          $this->medida = $medida;
          $this->state = $state;

          $sql = "SELECT * FROM productos WHERE name = '$this->nombre' AND id != $this->idProducto";
          $resquest = $this->get_AllRegister($sql);

          if (empty($resquest)) {
               $sql = "UPDATE productos SET name = ?, price = ?, stock = ?, description = ?, measure = ?, state = ? WHERE id = $this->idProducto";
               $arrData = array($this->nombre, $this->precio, $this->stock, $this->descripcion, $this->medida, $this->state);
               $resquest = $this->update_Register($sql, $arrData);
          } else {
               $resquest = "exist";
          }
          return $resquest;
     }

     public function deleteProducto(int $idProducto)
     {
          $this->idProducto = $idProducto;
          $sql = "SELECT * FROM productos WHERE id = $this->idProducto";
          $resquest = $this->get_OneRegister($sql);
          
          if (!empty($resquest)) {
               $sql = "UPDATE productos SET state = ? WHERE id = $this->idProducto";
               $arrData = array(0);
               $resquest = $this->update_Register($sql, $arrData);
               if ($resquest) {
                    $resquest = "ok";
               }else{
                    $resquest = "error";
               }
          }else {
               $resquest = "exist";
          }
          return $resquest;
     }
}
