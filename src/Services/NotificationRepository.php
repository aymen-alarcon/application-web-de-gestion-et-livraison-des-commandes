<?php

class NotificationRepository{
    protected $conn;

    function __construct($conn)
    {
        $this->conn = $conn;
    }

    function create($notification){
        session_start();
        var_dump($notification->getContenu());
        var_dump($notification->getStatu());
        var_dump($notification->getReceiver_id());
        $sql = "INSERT INTO notifications (contenu, statu, sender_id, created_at, receiver_id) VALUES (:contenu, :statu, :sender_id, now(), :receiver_id)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":contenu", $notification->getContenu());
        $stmt->bindValue(":statu", $notification->getStatu());
        $stmt->bindValue(":receiver_id", $notification->getReceiver_id());
        $stmt->bindValue(":sender_id", $_SESSION["id"]);
        $stmt->execute();
    }

    function update($notification){
        $sql = "UPDATE notifications set notificationname = :notificationname, first_name = :first_name, last_name = :last_name, email = :email, phone = :phone, password = :password WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":id", $notification->getId());
        $stmt->bindValue(":notificationname", $notification->getnotificationname());
        $stmt->bindValue(":first_name", $notification->getFirstName());
        $stmt->bindValue(":last_name", $notification->getLastName());
        $stmt->bindValue(":email", $notification->getEmail());
        $stmt->bindValue(":phone", $notification->getPhone());
        $stmt->bindValue(":password", $notification->getPassword());
        $stmt->execute();    
    }

    function delete($notification){
        $sql = "DELETE FROM notifications WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":id", $notification->getId());
        $stmt->execute();    
    }

    function read($notification){
        $sql = "SELECT * FROM notifications WHERE receiver_id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":id", $notification->getReceiverId());
        $stmt->execute();    
        $_SESSION["notifications"] = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function readAll(){
        $sql = "SELECT * FROM notifications";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();   
        $_SESSION["notification"] = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}