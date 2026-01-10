<?php

class OfferRepository{
    protected $conn;

    function __construct($conn)
    {
        $this->conn = $conn;
    }

    function create($offer){
        try {
            $sql = "INSERT INTO offers (vehicule, prix, durée_estimée, created_at, commande_id, sender_id ,statu) VALUES (:vehicle, :prix, :duree_estimee, now(), :commande_id, :sender_id, :statu)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(":vehicle", $offer->getVehicule());
            $stmt->bindValue(":prix", $offer->getPrice());
            $stmt->bindValue(":duree_estimee", $offer->getDuree());
            $stmt->bindValue(":commande_id", $offer->getCommande_id());
            $stmt->bindValue(":sender_id", $offer->getSender_id());
            $stmt->bindValue(":statu", $offer->getStatu());
            $stmt->execute();
            header("Location: ../Controller/CreateNotificationHandler.php?commande_id=" .urlencode($offer->getCommande_id()));
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                $_SESSION["flash"] = "Offer already exists for this sender.";
                header("Location: ../../public/deliverer/deliverer_order_interaction.php");
                exit;
            } else {
                echo $stmt->errorCode();
            }
        }
    }

    function update($offer){
        try {
            $sql = "UPDATE offers set statu = :statu WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(":id", $offer->getId());
            $stmt->bindValue(":statu", $offer->getStatu());
            $stmt->execute();    
        } catch (PDOException) {
            echo $stmt->errorCode();
        }
    }

    function delete($offer){
        try {
            $sql = "DELETE FROM offers WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(":id", $offer->getId());
            $stmt->execute();    
        } catch (PDOException) {
            echo $stmt->errorCode();
        }
    }

    function read($offer){
        try {
            $sql = "SELECT * FROM offers WHERE commande_id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(":id", $offer->getCommande_id());
            $stmt->execute();    
            $_SESSION["offers"] = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException) {
            echo $stmt->errorCode();
        }
    }

    function readAll(){
        try {
            $sql = "SELECT * FROM offers";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();   
            $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException) {
            echo $stmt->errorCode();
        }
    }
}