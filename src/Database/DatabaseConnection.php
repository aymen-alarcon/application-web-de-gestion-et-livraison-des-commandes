<?php

namespace App\Database;

use PDO;
use PDOException;

class DatabaseConnection{
    protected $conn;

    function establishConnection(){
        try {
            $this->conn = new PDO("mysql:host=localhost;dbname=gestion_et_livraison_des_commandes;", "root", "");
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "connection failed " . $e->getMessage();
        }
        return $this->conn;
    }  
}