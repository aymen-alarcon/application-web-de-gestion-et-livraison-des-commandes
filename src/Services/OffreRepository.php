<?php

class OffreRepository{
    protected $conn;

    function __construct($conn)
    {
        $this->conn = $conn;
    }

    function create($offre){
        $sql = "INSERT INTO offers (vehicule, prix, durée_estimée, created_at, commande_id) VALUES (:vehicle, :prix, :duree_estimee, now(), :commande_id)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":vehicle", $offre->getVehicule());
        $stmt->bindValue(":prix", $offre->getPrice());
        $stmt->bindValue(":duree_estimee", $offre->getDuree());
        $stmt->bindValue(":commande_id", $offre->getCommande_id());
        $stmt->execute();
        header("Location: ../Controller/CreateNotification.php?commande_id=" .urlencode($offre->getCommande_id()));
        exit;
    }

    function update($offre){
        $sql = "UPDATE offres set offrename = :offrename, first_name = :first_name, last_name = :last_name, email = :email, phone = :phone, password = :password WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $offre->getId());
        $stmt->bindParam(":offrename", $offre->getoffrename());
        $stmt->bindParam(":first_name", $offre->getFirstName());
        $stmt->bindParam(":last_name", $offre->getLastName());
        $stmt->bindParam(":email", $offre->getEmail());
        $stmt->bindParam(":phone", $offre->getPhone());
        $stmt->bindParam(":password", $offre->getPassword());
        $stmt->execute();    
    }

    function delete($offre){
        $sql = "DELETE FROM offres WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $offre->getId());
        $stmt->execute();    
    }

    function read($offre, $columns){
        $sql = "SELECT $columns FROM offres WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $offre->getId());
        $stmt->execute();    
        $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function readAll($offre){
        $sql = "SELECT * FROM offres";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();   
        $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}