<?php

class RoleRepository{
    protected $conn;

    function __construct($conn)
    {
        $this->conn = $conn;
    }

    function registerRole($role){
        session_start();
        $sql = "INSERT INTO roles (role_name, user_id) VALUES (:role_name, :user_id)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":role_name", $role->getName());
        $stmt->bindValue(":user_id", $role->getUser_id());
        $stmt->execute();
        if ($role->getName() === "admin") {
            $_SESSION["role"] = $role->getName();
            header("Location: ../../public/admin/admin_dashboard.php");
            exit;
        }
        else if ($role->getName() === "client") {
            $_SESSION["role"] = $role->getName();
            header("Location: ../../public/client/client_dashboard.php");
            exit;
        }
        else if ($role->getName() === "deliverer") {
            $_SESSION["role"] = $role->getName();
            header("Location: ../../public/deliverer/deliverer_dashboard.php");
            exit;
        }
    }

    function readRole($user){
        $sql = "SELECT role_name FROM roles WHERE user_id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":id", $user->getUser_id());
        $stmt->execute(); 
        $role = $stmt->fetchAll(PDO::FETCH_ASSOC);
        session_start();

        if ($role[0]["role_name"] == "admin") {
            $_SESSION["role"] = $role[0]["role_name"];
            header("Location: ../../public/admin/admin_dashboard.php");
            exit;
        }else if ($role[0]["role_name"] == "client") {
            $_SESSION["role"] = $role[0]["role_name"];
            header("Location: ../Controller/ReadNotificationHandler.php");
            exit;
        }else if ($role[0]["role_name"] == "deliverer") {
            $_SESSION["role"] = $role[0]["role_name"];
            header("Location: ../../public/deliverer/deliverer_dashboard.php");
            exit;
        }
    }

    function delete($role){
        $sql = "DELETE FROM users WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":id", $role->getId());
        $stmt->execute();    
    }

    function read($role){
        $sql = "SELECT * FROM roles WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":id", $role->getId());
        $stmt->execute();    
        $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function readAll($role){
        $sql = "SELECT * FROM roles";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();   
        $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}