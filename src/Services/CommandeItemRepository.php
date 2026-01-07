<?php
class CommandeItemRepository{
    protected $conn;

    function __construct($conn)
    {
        $this->conn = $conn;
    }

    function create($commandeItem){
        session_start();
        $sql = "INSERT INTO commande_items (name, quantity, price, date, description, commande_id) VALUES (:name, :quantity, :price, now(), :description, :commande_id)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":name", $commandeItem->getName());
        $stmt->bindValue(":quantity", $commandeItem->getQuantity());
        $stmt->bindValue(":price", $commandeItem->getPrice());
        $stmt->bindValue(":description", $commandeItem->getDescription());
        $stmt->bindValue(":commande_id", $commandeItem->getCommandeId());
        $stmt->execute();
        header("Location: ../../public/client/client_dashboard.php");
    }

    function read($commandeItem){
        session_start();
        $sql = "SELECT * FROM commande_items WHERE commande_id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":id", $commandeItem->getCommandeId());
        $stmt->execute();
        $_SESSION['commande_items'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function update($commandeItem){
        $sql = "UPDATE commande_items set name = COALESCE(:name, name), quantity = COALESCE(:quantity,quantity), price = COALESCE(:price, price), description = COALESCE(:description, description) WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":id", $commandeItem->getId());
        $stmt->bindValue(":name", $commandeItem->getName());
        $stmt->bindValue(":quantity", $commandeItem->getQuantity());
        $stmt->bindValue(":price", $commandeItem->getPrice());
        $stmt->bindValue(":description", $commandeItem->getDescription());
        $stmt->execute();  
        header("Location: ../../public/client/client_order_dashboard.php");
    }

    function delete($commandeItem){
        $sql = "DELETE FROM commande_items WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":id", $commandeItem->getId());
        $stmt->execute(); 
        header("Location: ../../public/client/client_order_dashboard.php");
    }
}