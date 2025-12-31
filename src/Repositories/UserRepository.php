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
        $sql = "INSERT INTO users (username, first_name, last_name, email, phone, password, address, created_at) VALUES (:username, :first_name, :last_name, :email, :phone, :password, :address, now())";
        $stmt = $this->conn->prepare($sql);
        $username = $user->getUsername();
        $firstName = $user->getFirstName();
        $lastName = $user->getLastName();
        $email = $user->getEmail();
        $phone = $user->getPhone();
        $password = $user->getPassword();
        $address = $user->getAddress();
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":first_name", $firstName);
        $stmt->bindParam(":last_name", $lastName);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":phone", $phone);
        $stmt->bindParam(":password", $password);
        $stmt->bindParam(":address", $address);
        $stmt->execute();
        session_start();
        $_SESSION["id"] = $this->conn->lastInsertId();
        header("Location: ../../public/client_dashboard.php?id=" . urldecode($_SESSION["id"]));
    }

    function read($user){
        $sql = "SELECT * FROM users WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $id = $user->getId();
        $stmt->bindParam(":id", $id);
        $stmt->execute();    
        $userInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
        var_dump($userInfo);
        $expiration = time() + 3600;

        setcookie("username", $userInfo[0]["username"], $expiration, "/");
        setcookie("first_name", $userInfo[0]["first_name"], $expiration, "/");
        setcookie("last_name", $userInfo[0]["last_name"], $expiration, "/");
        setcookie("email", $userInfo[0]["email"], $expiration, "/");
        setcookie("phone", $userInfo[0]["phone"], $expiration, "/");
        setcookie("address", $userInfo[0]["address"], $expiration, "/");
        setcookie("created_at", $userInfo[0]["created_at"], $expiration, "/");
        header("Location: ../../public/client_profile.php?id=" . urldecode($_SESSION["id"]));
    }
}