<?php

class DatabaseConnection{
    protected $conn;

    function connect(){
        try {
            $this->conn = new PDO("mysql:host=localhost;dbname=gestion_et_livraison_des_commandes;", "root", "");
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "connection succeded";
        } catch (PDOException $e) {
            echo "connection failed " . $e->getMessage();
        }
        return $this->conn;
    }  
}