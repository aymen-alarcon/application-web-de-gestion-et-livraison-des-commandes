<?php
namespace App\Models;
use PDO;
use PDOException;

class Offer{
        private PDO $conn;
        private ?string $id;
        private ?string $vehicule;
        private ?string $price;
        private ?string $duree;
        private ?string $commande_id;
        private ?string $sender_id;
        private ?string $statu;
    
        function __construct($conn = NULL, $id = NULL, $vehicule = NULL, $price = NULL, $duree = NULL, $commande_id = NULL, $sender_id = NULL, $statu = "pending")
        {
                $this->conn = $conn;
                $this->id = $id;
                $this->vehicule = $vehicule;
                $this->price = $price;
                $this->duree = $duree;
                $this->commande_id = $commande_id;
                $this->sender_id = $sender_id;
                $this->statu = $statu;
        }

        public function getId()
        {
                return $this->id;
        }

        public function setId($id)
        {
                $this->id = $id;
        }

        public function getVehicule()
        {
                return $this->vehicule;
        }

        public function setVehicule($vehicule)
        {
                $this->vehicule = $vehicule;
        }

        public function getPrice()
        {
                return $this->price;
        }

        public function setPrice($price)
        {
                $this->price = $price;
        }

        public function getDuree()
        {
                return $this->duree;
        }

        public function setDuree($duree)
        {
                $this->duree = $duree;
        }

        public function getCommande_id()
        {
                return $this->commande_id;
        }

        public function setCommande_id($commande_id)
        {
                $this->commande_id = $commande_id;
        }

        public function getSender_id()
        {
                return $this->sender_id;
        }

        public function setSender_id($sender_id)
        {
                $this->sender_id = $sender_id;
        }

        public function getStatu()
        {
                return $this->statu;
        }

        public function setStatu($statu)
        {
                $this->statu = $statu;
        }
    function create(){
        try {
            $sql = "SELECT COUNT(*) FROM offers WHERE sender_id = :sender_id AND commande_id = :commande_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':sender_id' , $this->getSender_id());
            $stmt->bindValue(':commande_id' , $this->getCommande_id());
            $stmt->execute();
    
            if ($stmt->fetchColumn() > 0) {
                $_SESSION["flash"] = "You already sent an offer for this order.";
                header("Location: ../../public/deliverer/deliverer_order_interaction.php");
                exit;
            }
            
            $sql = "INSERT INTO offers (vehicule, prix, durée_estimée, created_at, commande_id, sender_id ,statu) VALUES (:vehicle, :prix, :duree_estimee, now(), :commande_id, :sender_id, :statu)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(":vehicle", $this->getVehicule());
            $stmt->bindValue(":prix", $this->getPrice());
            $stmt->bindValue(":duree_estimee", $this->getDuree());
            $stmt->bindValue(":commande_id", $this->getCommande_id());
            $stmt->bindValue(":sender_id", $this->getSender_id());
            $stmt->bindValue(":statu", $this->getStatu());
            $stmt->execute();
            header("Location: ../Controller/CreateNotificationHandler.php?commande_id=" .urlencode($this->getCommande_id()));
        } catch (PDOException) {
            echo $stmt->errorCode();
        }
    }

    function update(){
        try {
            $sql = "UPDATE offers set statu = COALESCE(:statu, statu) WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(":id", $this->getId());
            $stmt->bindValue(":statu", $this->getStatu());
            $stmt->execute();    
        } catch (PDOException) {
            echo $stmt->errorCode();
        }
    }

    function delete(){
        try {
            $sql = "DELETE FROM offers WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(":id", $this->getId());
            $stmt->execute();    
            $this->readAll();  
        } catch (PDOException) {
            echo $stmt->errorCode();
        }
    }

    function read(){
        try {
            $sql = "SELECT * FROM offers WHERE commande_id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(":id", $this->getCommande_id());
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
            $_SESSION["offers"] = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $link = explode("/", $_SERVER["HTTP_REFERER"]);
            header("Location: ../../" . $link[4] . "/" . $link[5] . "/" . $link[6]);
        } catch (PDOException) {
            echo $stmt->errorCode();
        }
    }
}
?>