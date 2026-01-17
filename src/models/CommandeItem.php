<?php
namespace App\Models;
use PDO;
use PDOException;

class CommandeItem{
    private PDO $conn;
    private ?int $id;
    private ?string $name;
    private ?int $quantity;
    private ?int $price;
    private ?string $description;
    private Commande $commande;

    function __construct(
        $conn = NULL,$id = NULL, $name = NULL, $quantity = NULL, $price = NULL, $description = NULL, $commande = NULL
    )
    {
        $this->conn = $conn;
        $this->id = $id;
        $this->name = $name;
        $this->quantity = $quantity;
        $this->price = $price;
        $this->description = $description;
        $this->commande = $commande;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function getCommandeId()
    {
        return $this->commande;
    }

    public function setCommandeId($commande)
    {
        $this->commande = $commande;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    function create(){
        session_start();
        try {
                $sql = "INSERT INTO commande_items (name, quantity, price, date, description, commande_id) VALUES (:name, :quantity, :price, now(), :description, :commande_id)";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindValue(":name", $this->getName());
                $stmt->bindValue(":quantity", $this->getQuantity());
                $stmt->bindValue(":price", $this->getPrice());
                $stmt->bindValue(":description", $this->getDescription());
                $stmt->bindValue(":commande_id", $this->getCommandeId());
                $stmt->execute();
                header("Location: ../../public/client/client_dashboard.php");
        } catch (PDOException) {
            echo $stmt->errorCode();
        }
    }

    function read(){
        try {
            session_start();
            $sql = "SELECT * FROM commande_items WHERE commande_id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(":id", $this->getCommandeId());
            $stmt->execute();
            $_SESSION['commande_items'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException) {
            echo $stmt->errorCode();
        }
    }

    function update(){
        try {
            $sql = "UPDATE commande_items set name = COALESCE(:name, name), quantity = COALESCE(:quantity,quantity), price = COALESCE(:price, price), description = COALESCE(:description, description) WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(":id", $this->getId());
            $stmt->bindValue(":name", $this->getName());
            $stmt->bindValue(":quantity", $this->getQuantity());
            $stmt->bindValue(":price", $this->getPrice());
            $stmt->bindValue(":description", $this->getDescription());
            $stmt->execute();  
            header("Location: ../../public/client/client_order_dashboard.php");
        } catch (PDOException) {
            echo $stmt->errorCode();
        }
    }

    function delete(){
        try {
            $sql = "DELETE FROM commande_items WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(":id", $this->getId());
            $stmt->execute(); 
        } catch (PDOException) {
            echo $stmt->errorCode();
        }
    }
}