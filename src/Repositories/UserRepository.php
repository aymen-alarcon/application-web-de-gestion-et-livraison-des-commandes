<?php

class UserRepository{
    protected $conn;

    function __construct($conn)
    {
        $this->conn = $conn;
    }

    function login($user){ 
        try {
            $sql = "SELECT * FROM users WHERE email = :email";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(":email", $user->getEmail());
            $stmt->execute();
            $userCredentials = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($userCredentials && $user->getPassword() === $userCredentials["password"]) {
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
        } catch (PDOException) {
            echo $stmt->errorCode();
        }       
    }

    function register($user, $role){
        try {
            session_start();
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
            $_SESSION["id"] = $this->conn->lastInsertId();
            header("Location: ../Controller/RegisterRoleHandler.php?id=" . $_SESSION["id"] . "&name=" . $role);
        } catch (PDOException) {
            echo $stmt->errorCode();
        }
    }

    function Update($user){
        try {
            $sql = "UPDATE users SET username = COALESCE(:username, username), first_name = COALESCE(:first_name, first_name), last_name = COALESCE(:last_name, last_name), phone = COALESCE(:phone, :phone), address = COALESCE(:address, address) WHERE id = :id";
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
        } catch (PDOException) {
            echo $stmt->errorCode();
        }
    }

    function readAll(){
        try {
            $sql = "SELECT * FROM users";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $_SESSION["users"] = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $link = explode("/", $_SERVER["HTTP_REFERER"]);
            header("Location: ../../" . $link[4] . "/" . $link[5] . "/" . $link[6]);
        } catch (PDOException) {
            echo $stmt->errorCode();
        }
    }

    function delete($user){
        try {
            $sql = "DELETE FROM users WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(":id", $user->getId());
            $stmt->execute();  
            $this->readAll();  
        } catch (PDOException) {
            echo $stmt->errorCode();
        }
    }
}