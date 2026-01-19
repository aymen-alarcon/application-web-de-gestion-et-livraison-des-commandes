<?php
namespace App\Models;

use PDO;
use PDOException;

class Offer{
    private ?PDO $conn;
    private ?string $id;
    private ?string $vehicle;
    private ?string $prix;
    private ?string $estimated_duration;
    private ?string $commande_id;
    private ?string $sender_id;
    private ?string $status;
    private ?string $created_at;
    
    function __construct($conn = NULL, $id = NULL, $vehicle = NULL, $prix = NULL, $estimated_duration = NULL, $commande_id = NULL, $sender_id = NULL, $status = "pending", $created_at = NULL)
    {
        $this->conn = $conn;
        $this->id = $id;
        $this->vehicle = $vehicle;
        $this->prix = $prix;
        $this->estimated_duration = $estimated_duration;
        $this->commande_id = $commande_id;
        $this->sender_id = $sender_id;
        $this->status = $status;
        $this->created_at = $created_at;
    }

    public function getId()
    {
        return $this->id;
    }

        public function setId($id)
        {
                $this->id = $id;
        }

        public function getVehicle()
        {
                return $this->vehicle;
        }

        public function setVehicle($vehicle)
        {
                $this->vehicle = $vehicle;
        }

        public function getPrice()
        {
                return $this->prix;
        }

        public function setPrice($prix)
        {
                $this->prix = $prix;
        }

        public function getEstimatedDuration()
        {
                return $this->estimated_duration;
        }

        public function setEstimatedDuration($estimated_duration)
        {
                $this->estimated_duration = $estimated_duration;
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

        public function getStatus()
        {
                return $this->status;
        }

        public function setStatus($status)
        {
                $this->status = $status;
        }

    public function getCreated_at()
    {
        return $this->created_at;
    }

    public function setCreated_at($created_at)
    {
        $this->created_at = $created_at;

        return $this;
    }

    function create(){
        try {
            $sql = "SELECT COUNT(*) FROM offers WHERE sender_id = :sender_id AND commande_id = :commande_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':sender_id' , $this->getSender_id());
            $stmt->bindValue(':commande_id' , $this->getCommande_id());
            $stmt->execute();
    
            if ($stmt->fetchColumn() > 0) {
                header("Location: ../../public/deliverer/deliverer_order_interaction.php");
                exit;
            }
            
            $sql = "INSERT INTO offers (vehicle, prix, estimated_duration, created_at, commande_id, sender_id ,status) VALUES (:vehicle, :prix, :estimated_duration, now(), :commande_id, :sender_id, :status)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(":vehicle", $this->getvehicle());
            $stmt->bindValue(":prix", $this->getPrice());
            $stmt->bindValue(":estimated_duration", $this->getEstimatedDuration());
            $stmt->bindValue(":commande_id", $this->getCommande_id());
            $stmt->bindValue(":sender_id", $this->getSender_id());
            $stmt->bindValue(":status", $this->getStatus());
            $stmt->execute();
            header("Location: ../Controller/CreateNotificationHandler.php?commande_id=" .urlencode($this->getCommande_id()));
            exit;
        } catch (PDOException) {
            echo $stmt->errorCode();
        }
    }

    function update(){
        try {
            $sql = "UPDATE offers set status = COALESCE(:status, status) WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(":id", $this->getId());
            $stmt->bindValue(":status", $this->getStatus());
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
            $sql = "SELECT * FROM offers WHERE commande_id = :commande_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(":commande_id", $this->getCommande_id());
            $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, self::class);
            $stmt->execute();    
            $offersByOrder = $stmt->fetchAll();
            return $offersByOrder;
        } catch (PDOException) {
            echo $stmt->errorCode();
        }
    }

    function readAll(){
        try {
            $sql = "SELECT * FROM offers";
            $stmt = $this->conn->prepare($sql);
            $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, self::class);
            $stmt->execute();    
            $offers = $stmt->fetchAll();
            return $offers;
        } catch (PDOException) {
            echo $stmt->errorCode();
        }
    }
}
?>