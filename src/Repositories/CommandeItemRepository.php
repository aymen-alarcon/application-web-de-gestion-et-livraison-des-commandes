<?php
class CommandeItemRepository{
    protected $conn;

    function __construct($conn)
    {
        $this->conn = $conn;
    }

    function create($commande){
        session_start();
        $sql = "INSERT INTO commande_items (name, quantity, price, date, commande_id) VALUES (:name, :quantity, :price, now(), :commande_id)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":name", $commande->getName());
        $stmt->bindValue(":quantity", $commande->getQuantity());
        $stmt->bindValue(":price", $commande->getPrice());
        $stmt->bindValue(":commande_id", $commande->getCommandeId());
        $stmt->execute();
        header("Location: ../../public/client_dashboard.php");
    }

    function read($commande){
        session_start();
        $sql = "SELECT * FROM commande_items WHERE commande_id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":id", $commande->getCommandeId());
        $stmt->execute();
        $_SESSION['commande_items'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
        header("Location: ../../public/client_order.php");
        exit;
    }

    function update($commande){
        $sql = "UPDATE commande_items set name = :name, quantity = :quantity, statu = :statu, is_deleted = :is_deleted, price = :price, password = :password WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":id", $commande->getId());
        $stmt->bindValue(":name", $commande->getName());
        $stmt->bindValue(":quantity", $commande->getQuantity());
        $stmt->bindValue(":statu", $commande->getStatu());
        $stmt->bindValue(":is_deleted", $commande->getis_deleted());
        $stmt->execute();    
    }

    function delete($commande){
        $sql = "UPDATE commande_items SET is_deleted = '1' WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":id", $commande->getId());
        $stmt->execute();    
        // $this->read();
        header("Location: ../../public/client_order_dashboard.php");
    }
}