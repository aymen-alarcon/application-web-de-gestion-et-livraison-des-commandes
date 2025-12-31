<?php

class CommandeRepository implements InterfaceCrud{
    protected $conn;

    function __construct($conn)
    {
        $this->conn = $conn;
    }

    function create($commande){
        $sql = "INSERT INTO commandes (usernatitreme, address, statu, is_deleted, created_at) VALUES (:titre, :address, :statu, :is_deleted, now())";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":titre", $commande->getTitre());
        $stmt->bindParam(":address", $commande->getAddress());
        $stmt->bindParam(":statu", $commande->getStatu());
        $stmt->bindParam(":is_deleted", $commande->getIs_deleted());
        $stmt->execute();
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