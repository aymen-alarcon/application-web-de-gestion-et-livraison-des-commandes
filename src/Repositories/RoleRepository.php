<?php

class RoleRepository{
    protected $conn;

    function __construct($conn)
    {
        $this->conn = $conn;
    }

    function registerRole($role){
        try {
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
        } catch (PDOException) {
            echo $stmt->errorCode();
        }
    }

    function readRole($user){
        try {
            session_start();
            $sql = "SELECT * FROM roles WHERE user_id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(":id", $user->getUser_id());
            $stmt->execute(); 
            $role = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if ($role[0]["role_name"] == "admin") {
                $_SESSION["role"] = $role[0]["role_name"];
                header("Location: ../../public/admin/admin_dashboard.php");
                exit;
            }else if ($role[0]["role_name"] == "client") {
                $_SESSION["role"] = $role[0]["role_name"];
                $route = "Location: ../../public/client/client_dashboard.php";
                header("Location: ../Controller/ReadNotificationHandler.php?route=$route");
                exit;
            }else if ($role[0]["role_name"] == "deliverer") {
                $_SESSION["role"] = $role[0]["role_name"];
                $route = "Location: ../../public/deliverer/deliverer_dashboard.php";
                header("Location: ../Controller/ReadNotificationHandler.php?route=$route");
                exit;
            }
        } catch (PDOException) {
            echo $stmt->errorCode();
        }
    }

    function readAll(){
        try {
            $sql = "SELECT * FROM roles";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();   
            $_SESSION["roles"] = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $link = explode("/", $_SERVER["HTTP_REFERER"]);
            header("Location: ../../" . $link[4] . "/" . $link[5] . "/" . $link[6]);
        } catch (PDOException) {
            echo $stmt->errorCode();
        }
    }

    function update($offer){
        try {
            $sql = "UPDATE roles set role_name = COALESCE(:role_name, role_name) WHERE user_id = :user_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(":user_id", $offer->getUser_id());
            $stmt->bindValue(":role_name", $offer->getName());
            $stmt->execute();    
        } catch (PDOException) {
            echo $stmt->errorCode();
        }
    }
}