<?php

class OffreRepository{
    protected $conn;

    function __construct($conn)
    {
        $this->conn = $conn;
    }

    function create(User $user){
        $sql = "INSERT INTO users (username, first_name, last_name, email, phone, password, created_at) VALUES (:username, :first_name, :last_name, :email, :phone, :password, now())";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":username", $user->getUsername());
        $stmt->bindParam(":first_name", $user->getFirstName());
        $stmt->bindParam(":last_name", $user->getLastName());
        $stmt->bindParam(":email", $user->getEmail());
        $stmt->bindParam(":phone", $user->getPhone());
        $stmt->bindParam(":password", $user->getPassword());
        $stmt->execute();
    }

    function update(User $user){
        $sql = "UPDATE users set username = :username, first_name = :first_name, last_name = :last_name, email = :email, phone = :phone, password = :password WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $user->getId());
        $stmt->bindParam(":username", $user->getUsername());
        $stmt->bindParam(":first_name", $user->getFirstName());
        $stmt->bindParam(":last_name", $user->getLastName());
        $stmt->bindParam(":email", $user->getEmail());
        $stmt->bindParam(":phone", $user->getPhone());
        $stmt->bindParam(":password", $user->getPassword());
        $stmt->execute();    
    }

    function delete(User $user){
        $sql = "DELETE FROM users WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $user->getId());
        $stmt->execute();    
    }

    function read(User $user, $columns){
        $sql = "SELECT $columns FROM users WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $user->getId());
        $stmt->execute();    
        $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function readAll(User $user){
        $sql = "SELECT * FROM users";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();   
        $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}