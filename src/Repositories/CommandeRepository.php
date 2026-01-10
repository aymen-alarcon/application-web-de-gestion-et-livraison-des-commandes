<?php
class CommandeRepository{
    protected $conn;

    function __construct($conn)
    {
        $this->conn = $conn;
    }

    function create($commande){
        try {
            $sql = "INSERT INTO commandes (titre, address, phone, statu, is_deleted, created_at, user_id) VALUES (:titre, :address, :phone, :statu, :is_deleted, now(), :user_id)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(":titre", $commande->getTitre());
            $stmt->bindValue(":address", $commande->getAddress());
            $stmt->bindValue(":phone", $commande->getPhone());
            $stmt->bindValue(":statu", $commande->getStatu());
            $stmt->bindValue(":is_deleted", $commande->getIs_deleted());
            $stmt->bindValue(":user_id", $commande->getUser_id());
            $stmt->execute();
            $commande_id = $this->conn->lastInsertId();
            header("Location: ../../public/client/client_add_package.php?commande_id=" . urlencode($commande_id));
        } catch (PDOException) {
            echo $stmt->errorCode();
        }
    }

    function read(){
        try {
            $sql = "SELECT * FROM commandes WHERE user_id = :id AND is_deleted = '0'";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(":id", $_SESSION["id"]);
            $stmt->execute();
            $_SESSION['commandes'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException) {
            echo $stmt->errorCode();
        }
    }

    function readAll(){
        try {
            $sql = "SELECT * FROM commandes";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $_SESSION['commandes'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
            // $link = explode("/", $_SERVER["HTTP_REFERER"]);
            // header("Location: ../../" . $link[4] . "/" . $link[5] . "/" . $link[6]);
        } catch (PDOException) {
            echo $stmt->errorCode();
        }
    }

    function update($commande){
        try {
            $sql = "UPDATE commandes set titre = COALESCE(:titre, titre), address = COALESCE(:address,address), phone = COALESCE(:phone, phone), statu = COALESCE(:statu, statu) WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(":id", $commande->getId());
            $stmt->bindValue(":titre", $commande->gettitre());
            $stmt->bindValue(":address", $commande->getAddress());
            $stmt->bindValue(":phone", $commande->getPhone());
            $stmt->bindValue(":statu", $commande->getStatu());
            var_dump($commande->getId());
            var_dump($commande->gettitre());
            var_dump($commande->getAddress());
            var_dump($commande->getPhone());
            var_dump($commande->getStatu());
            $stmt->execute();    
            $this->read();
        } catch (PDOException) {
            echo $stmt->errorCode();
        }
    }

    function delete($commande){
        try {
            $sql = "UPDATE commandes SET is_deleted = '1' WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(":id", $commande->getId());
            $stmt->execute();    
            $this->read();
        } catch (PDOException) {
            echo $stmt->errorCode();
        }
    }
}