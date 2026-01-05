<?php
class CommandeRepository{
    protected $conn;

    function __construct($conn)
    {
        $this->conn = $conn;
    }

    function create($commande){
        session_start();
        $sql = "INSERT INTO commandes (titre, address, phone, statu, is_deleted, created_at, user_id) VALUES (:titre, :address, :phone, :statu, :is_deleted, now(), :user_id)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":titre", $commande->getTitre());
        $stmt->bindValue(":address", $commande->getAddress());
        $stmt->bindValue(":phone", $commande->getPhone());
        $stmt->bindValue(":statu", $commande->getStatu());
        $stmt->bindValue(":is_deleted", $commande->getIs_deleted());
        $stmt->bindValue(":user_id", $_SESSION["id"]);
        $stmt->execute();
        $commande_id = $this->conn->lastInsertId();
        header("Location: ../../public/client/client_add_package.php?commande_id=" . urlencode($commande_id));
    }

    function read(){
        session_start();
        $sql = "SELECT * FROM commandes WHERE user_id = :id AND is_deleted = '0'";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $_SESSION["id"]);
        $stmt->execute();
        $_SESSION['commandes'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function readAll(){
        session_start();
        $sql = "SELECT * FROM commandes WHERE is_deleted = '0' ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $_SESSION['commandes'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function update($commande){
        $sql = "UPDATE commandes set titre = :titre, address = :address, phone = :phone WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":id", $commande->getId());
        $stmt->bindValue(":titre", $commande->gettitre());
        $stmt->bindValue(":address", $commande->getAddress());
        $stmt->bindValue(":phone", $commande->getPhone());
        $stmt->execute();    
        $this->read();
    }

    function delete($commande){
        $sql = "UPDATE commandes SET is_deleted = '1' WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":id", $commande->getId());
        $stmt->execute();    
        $this->read();
    }

    function cancel($commande){
        $sql = "UPDATE commandes SET statu = :statu WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":id", $commande->getId());
        $stmt->bindValue(":statu", $commande->getStatu());
        $stmt->execute();    
        $this->read();
    }
}