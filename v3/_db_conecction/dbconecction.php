<?php

  
    class DatabaseConnection{

        public function getConnection(){
          $db = null;
          $db = new mysqli('127.0.0.1','root','','sicoban', 3307);
          //$db = new mysqli('130.211.135.78','jaime','jaime123','sicoban', 3306);
          if (mysqli_connect_errno()) {
           
           // $db = null;
            die("error en la conexion");
          //printf("<br />Connect failed: %s\n", mysqli_connect_error());
          //exit();
          }    
                return $db;
        }
    }

?>