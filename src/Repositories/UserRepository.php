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
                setcookie($key, $value, time() + 72000, "/");
            }
            $_SESSION["id"] = $userCredentials["id"];
            header("Location: ../../public/client/client_dashboard.php?id=" . $userCredentials["id"]);
            exit;
        } else {
            echo "Invalid email or password";
        }
    }

    function register(User $user){
        $sql = "INSERT INTO users (username, first_name, last_name, email, phone, password, address, created_at) VALUES (:username, :first_name, :last_name, :email, :phone, :password, :address, now())";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":username", $user->getUsername());
        $stmt->bindValue(":first_name", $user->getFirstName());
        $stmt->bindValue(":last_name", $user->getLastName());
        $stmt->bindValue(":email", $user->getEmail());
        $stmt->bindValue(":phone", $user->getPhone());
        $stmt->bindValue(":password", $user->getPassword());
        $stmt->bindValue(":address", $user->getAddress());
        setcookie("username", $user->getUsername(), time() * 3600, "\\");
        setcookie("first_name", $user->getFirstName(), time() * 3600, "\\");
        setcookie("last_name", $user->getLastName(), time() * 3600, "\\");
        setcookie("email", $user->getEmail(), time() * 3600, "\\");
        setcookie("phone", $user->getPhone(), time() * 3600, "\\");
        setcookie("address", $user->getAddress(), time() * 3600, "\\");
        $stmt->execute();
        session_start();
        $_SESSION["id"] = $this->conn->lastInsertId();
        header("Location: ../../public/client/client_dashboard.php?id=" . urldecode($_SESSION["id"]));
    }

    function read($user){
        $sql = "SELECT * FROM users WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":id", $user->getId());
        $stmt->execute();    
        $userInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($userInfo[0] as $key => $value) {
            if ($key === 'password' || $key === 'id') {
                continue;
            }
            setcookie($key, $value, time() + 3600, "/");
        }

        header("Location: ../../public/client/client_profile.php?id=" . urldecode($_SESSION["id"]));
    }
}