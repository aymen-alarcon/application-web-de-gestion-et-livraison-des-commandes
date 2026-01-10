<?php

class NotificationRepository{
    protected $conn;

    function __construct($conn)
    {
        $this->conn = $conn;
    }

    function create($notification){
        try {
            $sql = "INSERT INTO notifications (contenu, statu, sender_id, created_at, receiver_id) VALUES (:contenu, :statu, :sender_id, now(), :receiver_id)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(":contenu", $notification->getContenu());
            $stmt->bindValue(":statu", $notification->getStatu());
            $stmt->bindValue(":receiver_id", $notification->getReceiverId());
            $stmt->bindValue(":sender_id", $_SESSION["id"]);
            $stmt->execute();
        } catch (PDOException $e) {
            echo $stmt->errorCode();
        }
    }

    function update($notification){
        try {
            $sql = "UPDATE notifications set statu = :statu WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(":id", $notification->getId());
            $stmt->execute();    
        } catch (PDOException) {
            echo $stmt->errorCode();
        }
    }

    function delete($notification){
        try {
            $sql = "DELETE FROM notifications WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(":id", $notification->getId());
            $stmt->execute();    
        } catch (PDOException) {
            echo $stmt->errorCode();
        }
    }

    function read($notification){
        try {
            $sql = "SELECT * FROM notifications WHERE receiver_id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(":id", $notification->getReceiverId());
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