<?php
namespace App\Models;
use PDO;
use PDOException;

class Commande{
    private PDO $conn;
    private ?int $id;
    private ?string $titre;
    private ?string $address;
    private ?string $phone;
    private ?string $status;
    private ?string $created_at;
    private ?bool $is_deleted;
    private ?int $user;

    function __construct($conn = NULL, $id = NULL, $titre = NULL, $address = NULL, $phone = NULL, $status = "pending", $created_at = NULL, $is_deleted = 0, $user = NULL)
    {
        $this->conn = $conn;
        $this->id = $id;
        $this->titre = $titre;
        $this->address = $address;
        $this->status = $status;
        $this->created_at = $created_at;
        $this->is_deleted = $is_deleted;
        $this->phone = $phone;
        $this->user = $user;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getTitre()
    {
        return $this->titre;
    }
    
    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function setAddress($address)
    {
        $this->address = $address;
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
    }

    public function getIs_deleted()
    {
        return $this->is_deleted;
    }

    public function setIs_deleted($is_deleted)
    {
        $this->is_deleted = $is_deleted;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    public function getUser_id()
    {
        return $this->user;
    }

    public function setUser_id($user)
    {
        $this->user = $user;
    }
    function create(){
        try {
            $sql = "INSERT INTO commandes (titre, address, phone, status, is_deleted, created_at, user_id) VALUES (:titre, :address, :phone, :status, :is_deleted, now(), :user_id)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(":titre", $this->getTitre());
            $stmt->bindValue(":address", $this->getAddress());
            $stmt->bindValue(":phone", $this->getPhone());
            $stmt->bindValue(":status", $this->getStatus());
            $stmt->bindValue(":is_deleted", $this->getIs_deleted());
            $stmt->bindValue(":user_id", $this->getUser_id());
            $stmt->execute();
            $this_id = $this->conn->lastInsertId();
            header("Location: ../../public/client/client_add_package.php?commande_id=" . urlencode($this_id));
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
            header("Location: /Admin/Dashboard");
        } catch (PDOException) {
            echo $stmt->errorCode();
        }
    }

    function update(){
        try {
            $sql = "UPDATE commandes set titre = COALESCE(:titre, titre), address = COALESCE(:address,address), phone = COALESCE(:phone, phone), status = COALESCE(:status, status) WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(":id", $this->getId());
            $stmt->bindValue(":titre", $this->gettitre());
            $stmt->bindValue(":address", $this->getAddress());
            $stmt->bindValue(":phone", $this->getPhone());
            $stmt->bindValue(":status", $this->getStatus());
            var_dump($this->getId());
            var_dump($this->gettitre());
            var_dump($this->getAddress());
            var_dump($this->getPhone());
            var_dump($this->getStatus());
            $stmt->execute();    
            $this->read();
        } catch (PDOException) {
            echo $stmt->errorCode();
        }
    }

    function delete(){
        try {
            $sql = "UPDATE commandes SET is_deleted = '1' WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(":id", $this->getId());
            $stmt->execute();    
            $this->read();
            $this->readAll();  
        } catch (PDOException) {
            echo $stmt->errorCode();
        }
    }
}