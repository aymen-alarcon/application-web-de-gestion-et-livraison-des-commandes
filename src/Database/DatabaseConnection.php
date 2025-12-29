<?php

class DatabaseConnection{
    function connect($conn){
        try {
            $conn = new PDO("mysql:host=localhost;dbname=gestion_et_livraison_des_commandes;", "root", "");
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }  
}