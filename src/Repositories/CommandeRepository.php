<?php
class CommandeRepository{
    protected $conn;

    function __construct($conn)
    {
        $this->conn = $conn;
    }

    function create($commande){
        $sql = "INSERT INTO commandes (titre, address, phone, statu, is_deleted, created_at, user_id) VALUES (:titre, :address, :phone, :statu, :is_deleted, now(), :user_id)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":titre", $commande->getTitre());
        $stmt->bindValue(":address", $commande->getAddress());
        $stmt->bindValue(":phone", $commande->getPhone());
        $stmt->bindValue(":statu", $commande->getStatu());
        $stmt->bindValue(":is_deleted", $commande->getIs_deleted());
        $stmt->bindValue(":user_id", $_SESSION["id"]);
        $stmt->execute();
        header("Location: ../../public/client_dashboard.php");
    }

    function read($commande){
        $sql = "SELECT * FROM commandes WHERE user_id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $_SESSION["id"]);
        $stmt->execute();
        $commande = $stmt->fetchAll(PDO::FETCH_ASSOC);
        setcookie("titre", $commande[0]["titre"], time() + 3600, "\\");
        setcookie("address", $commande[0]["address"], time() + 3600, "\\");
        setcookie("phone", $commande[0]["phone"], time() + 3600, "\\");
        setcookie("statu", $commande[0]["statu"], time() + 3600, "\\");
        setcookie("user_id", $commande[0]["user_id"], time() + 3600, "\\");
        setcookie("created_at", $commande[0]["created_at"], time() + 3600, "\\");
        header("Location: ../../public/client_order_dashboard.php");
    }

    function update($commande){
        $sql = "UPDATE commandes set titre = :titre, address = :address, statu = :statu, is_deleted = :is_deleted, phone = :phone, password = :password WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":id", $commande->getId());
        $stmt->bindValue(":titre", $commande->gettitre());
        $stmt->bindValue(":address", $commande->getAddress());
        $stmt->bindValue(":statu", $commande->getStatu());
        $stmt->bindValue(":is_deleted", $commande->getis_deleted());
        $stmt->execute();    
    }

    function delete($commande){
        $sql = "DELETE FROM commandes WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":id", $commande->getId());
        $stmt->execute();    
    }
}