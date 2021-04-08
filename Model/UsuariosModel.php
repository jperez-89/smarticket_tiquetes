<?php

class UsuariosModel extends Crud
{
     public function __construct()
     {
          parent::__construct();
     }

     public function selectUsers()
     {
          $sql = "SELECT u.id, u.email, u.username, u.password, u.dni, u.name, u.surnames, u.phone, u.status, r.nombreRol as rol FROM users as u INNER JOIN roles as r on r.Id = u.idRol";
          $resquest = $this->get_AllRegister($sql);
          return $resquest;
     }

     public function selectUser(int $id)
     {
          $this->id = $id;
          $sql = "SELECT * FROM users WHERE id = $this->id";
          $resquest = $this->get_OneRegister($sql);
          return $resquest;
     }

     public function selectCantUsers()
     {
          $sql = "SELECT count(id) as Cantidad FROM users";
          $resquest = $this->get_CountRegister($sql);
          return $resquest;
     }

     public function selecRoles()
     {
          $sql = "SELECT * FROM roles";
          $resquest = $this->get_AllRegister($sql);
          return $resquest;
     }

     public function insertUser(string $DNI, string $nombre, string $apellidos, string $telefono, string $email, string $usuario, string $contra, int $idRol, int $status) //string $imagen,
     {
          $return = "";
          $this->email = $email;
          $this->usuario = $usuario;
          $this->contra = $contra;
          $this->DNI = $DNI;
          $this->nombre = $nombre;
          $this->apellidos = $apellidos;
          $this->telefono = $telefono;
          $this->idRol = $idRol;
          // $this->imagen = $imagen;
          $this->status = $status;
          // PrintData('MODELO...' . $DNI);

          // Validamos si existe el producto
          $sql = "SELECT * FROM users WHERE dni = '$this->DNI'";
          $resquest = $this->get_AllRegister($sql);

          if (empty($resquest)) {
               $query_insert = "INSERT INTO users (email, username, password, dni, name, surnames, phone, idRol, status) VALUES(?,?,?,?,?,?,?,?,?)";
               $arrData = array($this->email, $this->usuario, $this->contra, $this->DNI, $this->nombre, $this->apellidos, $this->telefono, $this->idRol, $this->status);
               $resquest_insert = $this->Insert_Register($query_insert, $arrData);
               $return = $resquest_insert;
          } else {
               $return = "exist";
          }
          return $return;
     }

     public function updateCliente(int $id, string $nombre, string $apellidos, string $telefono, string $email, string $usuario, string $contra, int $idRol)
     {
          $this->id = $id;
          $this->email = $email;
          $this->usuario = $usuario;
          $this->contra = $contra;
          $this->nombre = $nombre;
          $this->apellidos = $apellidos;
          $this->telefono = $telefono;
          $this->idRol = $idRol;

          // Validamos si existe el producto
          $sql = "SELECT * FROM users WHERE id = $this->id";
          $resquest = $this->get_AllRegister($sql);

          if (!empty($resquest)) {
               $query_update = "UPDATE users SET email = ?, username = ?, password = ?, name = ?, surnames = ?, phone = ?, idRol = ? WHERE id = $this->id";

               $arrData = array($this->email, $this->usuario, $this->contra, $this->nombre, $this->apellidos, $this->telefono, $this->idRol);

               $resquest = $this->update_Register($query_update, $arrData);
          } else {
               $resquest = "exist";
          }
          return $resquest;
     }

     public function deleteUser(int $id)
     {
          $this->id = $id;
          $sql = "SELECT * FROM users WHERE id = $this->id";
          $resquest = $this->get_OneRegister($sql);

          if (!empty($resquest)) {
               $sql = "UPDATE users SET status = ? WHERE id = $this->id";
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

     public function enableUser(int $id)
     {
          $this->id = $id;
          $sql = "SELECT * FROM users WHERE id = $this->id";
          $resquest = $this->get_OneRegister($sql);

          if (!empty($resquest)) {
               $sql = "UPDATE users SET status = ? WHERE id = $this->id";
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
