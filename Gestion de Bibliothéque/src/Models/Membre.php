<?php 
namespace App\Models;
use PDO;

class Membre extends User{
    private PDO $conn;

    public function __construct($conn = NULL, $id = NULL, $firstName = NULL, $lastName = NULL, $email = NULL, $password = NULL)
    {
        return parent::__construct($conn, $id, $firstName, $lastName, $email, $password);
    }

    function create(){
        $sql = "INSERT INTO membres (first_name, last_name, email, password, date_creation) VALUES (:first_name, :last_name, :email, :password, now())";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue("first_name", parent::getFirstName());
        $stmt->bindValue(":last_name", parent::getLastName());
        $stmt->bindValue(":email", parent::getEmail());
        $stmt->bindValue(":password", parent::getPassword());
        $stmt->execute();
    }

    function update(){
        $sql = "UPDATE membres SET first_name = COALESCE(:first_name,first_name), last_name = COALESCE(:last_name,last_name), email = COALESCE(:email, email) WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":first_name", parent::getFirstName());
        $stmt->bindValue(":last_name", parent::getLastName());
        $stmt->bindValue(":email", parent::getEmail());
        $stmt->bindValue(":id", parent::getId());
        $stmt->execute();
    }

    function readById(){
        $sql = "SELECT * FROM membres WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":id", parent::getId());
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_ORI_PRIOR, self::class);
        $stmt->execute();
        $stmt->fetch();
    }

    function delete(){
        $sql = "DELETE FROM membres WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":id", parent::getId());
        $stmt->execute();
    }
}