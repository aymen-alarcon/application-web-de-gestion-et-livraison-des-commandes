<?php

class OfferRepository{
    protected $conn;

    function __construct($conn)
    {
        $this->conn = $conn;
    }

    function create($offer){
        $sql = "INSERT INTO offers (vehicule, prix, durée_estimée, created_at, commande_id, sender_id) VALUES (:vehicle, :prix, :duree_estimee, now(), :commande_id, :sender_id)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":vehicle", $offer->getVehicule());
        $stmt->bindValue(":prix", $offer->getPrice());
        $stmt->bindValue(":duree_estimee", $offer->getDuree());
        $stmt->bindValue(":commande_id", $offer->getCommande_id());
        $stmt->bindValue(":sender_id", $offer->getSender_id());
        $stmt->execute();
        header("Location: ../Controller/CreateNotification.php?commande_id=" .urlencode($offer->getCommande_id()));
        exit;
    }

    function update($offer){
        $sql = "UPDATE offers set statu = :statu WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":id", $offer->getId());
        $stmt->bindValue(":statu", $offer->getStatu());
        $stmt->execute();    
    }

    function delete($offer){
        $sql = "DELETE FROM offers WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":id", $offer->getId());
        $stmt->execute();    
    }

    function read($offer){
        $sql = "SELECT * FROM offers WHERE commande_id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":id", $offer->getCommande_id());
        $stmt->execute();    
        $_SESSION["offers"] = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function readAll(){
        $sql = "SELECT * FROM offers";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();   
        $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}