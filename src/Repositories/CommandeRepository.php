<?php

class CommandeRepository{
    protected $conn;

    function __construct($conn)
    {
        $this->conn = $conn;
    }

    function create($commande){
        $sql = "INSERT INTO commandes (titre, address, phone, statu, is_deleted, created_at) VALUES (:titre, :address, :phone, :statu, :is_deleted, now())";
        $stmt = $this->conn->prepare($sql);
        $titre = $commande->getTitre();
        $address = $commande->getAddress();
        $phone = $commande->getPhone();
        $statu =  $commande->getStatu();
        $is_deleted = $commande->getIs_deleted();
        $stmt->bindParam(":titre", $titre);
        $stmt->bindParam(":address", $address);
        $stmt->bindParam(":phone", $phone);
        $stmt->bindParam(":statu", $statu);
        $stmt->bindParam(":is_deleted", $is_deleted);
        $stmt->execute();
        header("Location: ../../public/client_dashboard.php");
    }

    function update($commande){
        $sql = "UPDATE commandes set titre = :titre, address = :address, statu = :statu, is_deleted = :is_deleted, phone = :phone, password = :password WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $commande->getId());
        $stmt->bindParam(":titre", $commande->gettitre());
        $stmt->bindParam(":address", $commande->getAddress());
        $stmt->bindParam(":statu", $commande->getStatu());
        $stmt->bindParam(":is_deleted", $commande->getis_deleted());
        $stmt->execute();    
    }

    function delete($commande){
        $sql = "DELETE FROM commandes WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $commande->getId());
        $stmt->execute();    
    }

    function read($commande, $columns){
        $sql = "SELECT $columns FROM commandes WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $commande->getId());
        $stmt->execute();    
        $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function readAll($commande){
        $sql = "SELECT * FROM commandes";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();   
        $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}