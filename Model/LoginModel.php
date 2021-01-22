<?php

class LoginModel extends Crud
{
     private $idUser;
     private $User;
     private $Password;
     private $status;

     public function __construct()
     {
          parent::__construct();
     }

     public function loginUser(string $Username, string $UserPassword)
     {
          $this->User = $Username;
          $this->Password = $UserPassword;

          $sql = "SELECT username, password from users WHERE username = '$this->User' AND password = '$this->Password' AND status != 0";

          $request = $this->get_OneRegister($sql);
          return $request;
     }

}