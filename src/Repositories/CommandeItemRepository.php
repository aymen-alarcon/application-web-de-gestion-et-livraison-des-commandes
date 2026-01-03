<?php
class CommandeItemRepository{
    protected $conn;

    function __construct($conn)
    {
        $this->conn = $conn;
    }

    function create($commande){
        session_start();
        $sql = "INSERT INTO commande_items (name, quantity, price, date, description, commande_id) VALUES (:name, :quantity, :price, now(), :description, :commande_id)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":name", $commande->getName());
        $stmt->bindValue(":quantity", $commande->getQuantity());
        $stmt->bindValue(":price", $commande->getPrice());
        $stmt->bindValue(":description", $commande->getDescription());
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
        $sql = "UPDATE commande_items set name = :name, quantity = :quantity, price = :price, description = :description WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":id", $commande->getId());
        $stmt->bindValue(":name", $commande->getName());
        $stmt->bindValue(":quantity", $commande->getQuantity());
        $stmt->bindValue(":price", $commande->getPrice());
        $stmt->bindValue(":description", $commande->getDescription());
        $stmt->execute();  
        header("Location: ../../public/client_order_dashboard.php");
    }

    function delete($commande){
        $sql = "UPDATE commande_items SET is_deleted = '1' WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":id", $commande->getId());
        $stmt->execute();    
        header("Location: ../../public/client_order_dashboard.php");
    }
}