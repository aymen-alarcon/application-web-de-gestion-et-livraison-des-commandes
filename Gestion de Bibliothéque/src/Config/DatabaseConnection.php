<?php

namespace App\Config;
use PDO;
use PDOException;

class DatabaseConnection{
    private PDO $conn;
    function establishConnection(){
        try {
            $dsn = new PDO("mysql:host=localhost;dbname=gestionBiblio", "root", "");
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "5edama";
        } catch (PDOException $e) {
            echo "connection failed " . $e->getMessage();
        }
        return $this->conn;
    }
}