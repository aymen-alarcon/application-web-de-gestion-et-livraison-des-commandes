<?php

class UserRepository{
    protected $conn;

    function __construct($conn)
    {
        $this->conn = $conn;
    }

    function login($user){        
        $email = $user->getEmail();
        $password = $user->getPassword();

        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        $userCredentials = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($userCredentials && $password == $userCredentials["password"]) {
            session_start();
            $_SESSION["id"] = $userCredentials["id"];
            header("Location: ../../public/client_dashboard.php?id=" . urldecode($userCredentials["id"]));
        }
    }

    function register(User $user){
        $sql = "INSERT INTO users (username, first_name, last_name, email, phone, password, created_at) VALUES (:username, :first_name, :last_name, :email, :phone, :password, now())";
        $stmt = $this->conn->prepare($sql);
        $username = $user->getUsername();
        $firstName = $user->getFirstName();
        $lastName = $user->getLastName();
        $email = $user->getEmail();
        $phone = $user->getPhone();
        $password = $user->getPassword();
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":first_name", $firstName);
        $stmt->bindParam(":last_name", $lastName);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":phone", $phone);
        $stmt->bindParam(":password", $password);
        $stmt->execute();
        session_start();
        $_SESSION["id"] = $this->conn->lastInsertId();
        header("Location: ../../public/client_dashboard.php?id=" . urldecode($_SESSION["id"]));
    }
}