<?php
namespace App\Models;
use PDO;
use PDOException;

class Notification{
        private PDO $conn;
        private ?string $id;
        private ?string $contenu;
        private ?string $status;
        private ?string $sender_id;
        private ?string $receiver_id;

        function __construct($conn = NULL, $id = NULL, $contenu = "A new Offer have been sent", $status = "Not Seen" ,$sender_id = NULL, $receiver_id = NULL)
        {
                $this->conn = $conn;
                $this->id = $id;
                $this->contenu = $contenu;
                $this->status = $status;
                $this->sender_id = $sender_id;
                $this->receiver_id = $receiver_id;
        }

        public function getId()
        {
                return $this->id;
        }

        public function setId($id)
        {
                $this->id = $id;
        }

        public function getContenu()
        {
                return $this->contenu;
        }

        public function setContenu($contenu)
        {
                $this->contenu = $contenu;
        }

        public function getStatus()
        {
                return $this->status;
        }

        public function setStatus($status)
        {
                $this->status = $status;
        }

        public function getSender_id()
        {
                return $this->sender_id;
        }

        public function setSender_id($sender_id)
        {
                $this->sender_id = $sender_id;
        }

        public function setReceiverId($receiver_id){
                $this->receiver_id = $receiver_id;
        }

        public function getReceiverId(){
                return $this->receiver_id;
        }
    function create(){
        try {
            $sql = "INSERT INTO notifications (contenu, status, sender_id, created_at, receiver_id) VALUES (:contenu, :status, :sender_id, now(), :receiver_id)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(":contenu", $this->getContenu());
            $stmt->bindValue(":status", $this->getStatus());
            $stmt->bindValue(":receiver_id", $this->getReceiverId());
            $stmt->bindValue(":sender_id", $_SESSION["id"]);
            $stmt->execute();
        } catch (PDOException $e) {
            echo $stmt->errorCode();
        }
    }

    function update(){
        try {
            $sql = "UPDATE notifications set status = :status WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(":id", $this->getId());
            $stmt->execute();    
        } catch (PDOException) {
            echo $stmt->errorCode();
        }
    }

    function delete(){
        try {
            $sql = "DELETE FROM notifications WHERE id = :id";
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
            $sql = "SELECT * FROM notifications WHERE receiver_id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(":id", $this->getReceiverId());
            $stmt->execute();    
            $_SESSION["notifications"] = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException) {
            echo $stmt->errorCode();
        }
    }

    function readAll(){
        try {
            $sql = "SELECT * FROM notifications";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();   
            $_SESSION["notification"] = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException) {
            echo $stmt->errorCode();
        }
    }
}
?>