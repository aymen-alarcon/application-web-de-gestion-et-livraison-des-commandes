<?php

class UserRepository{
    protected $conn;

    function __construct($conn)
    {
        $this->conn = $conn;
    }

    function login($user){        
        $password = $user->getPassword();

        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":email", $user->getEmail());
        $stmt->execute();
        $userCredentials = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($userCredentials && $password === $userCredentials["password"]) {
            session_start();
            foreach ($userCredentials as $key => $value) {
                if ($key === 'password' || $key === 'id') {
                    continue;
                }
                setcookie($key, $value, time() + 9999, "/");
            }
            $_SESSION["id"] = $userCredentials["id"];
            header("Location: ../Controller/ReadRoleHandler.php?id=" . $userCredentials["id"]);
            exit;
        } else {
            echo "Invalid email or password";
        }
    }

    function register($user, $role){
        $sql = "INSERT INTO users (username, first_name, last_name, email, phone, password, address, created_at) VALUES (:username, :first_name, :last_name, :email, :phone, :password, :address, now())";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":username", $user->getUsername());
        $stmt->bindValue(":first_name", $user->getFirstName());
        $stmt->bindValue(":last_name", $user->getLastName());
        $stmt->bindValue(":email", $user->getEmail());
        $stmt->bindValue(":phone", $user->getPhone());
        $stmt->bindValue(":password", $user->getPassword());
        $stmt->bindValue(":address", $user->getAddress());
        setcookie("username", $user->getUsername(), time() + 9999, "/");
        setcookie("first_name", $user->getFirstName(), time() + 9999, "/");
        setcookie("last_name", $user->getLastName(), time() + 9999, "/");
        setcookie("email", $user->getEmail(), time() + 9999, "/");
        setcookie("phone", $user->getPhone(), time() + 9999, "/");
        setcookie("address", $user->getAddress(), time() + 9999, "/");
        $stmt->execute();
        session_start();
        $_SESSION["id"] = $this->conn->lastInsertId();
        header("Location: ../Controller/RegisterRoleHandler.php?id=" . $_SESSION["id"] . "&name=" . $role);
    }

    function Update($user){
        $sql = "UPDATE users SET username = :username, first_name = :first_name, last_name = :last_name, phone = :phone, address = :address WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":username", $user->getUsername());
        $stmt->bindValue(":first_name", $user->getFirstName());
        $stmt->bindValue(":last_name", $user->getLastName());
        $stmt->bindValue(":phone", $user->getPhone());
        $stmt->bindValue(":address", $user->getAddress());
        $stmt->bindValue(":id", $user->getId());
        setcookie("username", $user->getUsername(), time() + 9999, "/");
        setcookie("first_name", $user->getFirstName(), time() + 9999, "/");
        setcookie("last_name", $user->getLastName(), time() + 9999, "/");
        setcookie("phone", $user->getPhone(), time() + 9999, "/");
        setcookie("address", $user->getAddress(), time() + 9999, "/");
        $stmt->execute();
    }
}