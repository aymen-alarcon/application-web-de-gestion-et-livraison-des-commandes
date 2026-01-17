<?php
namespace App\Models;
use PDO;
use PDOException;

class Role{
    private PDO $conn;
    private ?int $id;
    private ?string $name;
    private User $user;

    function __construct($conn = NULL, $id = NULL, $name = NULL, $user = NULL)
    {
        $this->conn = $conn;
        $this->id = $id;
        $this->name = $name;
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

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getUser_id()
    {
        return $this->user;
    }

    public function setUser_id($user)
    {
        $this->user = $user;
    }
    function registerRole(){
        try {
            session_start();
            $sql = "INSERT INTO roles (role_name, user_id) VALUES (:role_name, :user_id)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(":role_name", $this->getName());
            $stmt->bindValue(":user_id", $this->getUser_id());
            $stmt->execute();
            if ($this->getName() === "admin") {
                $_SESSION["role"] = $this->getName();
                header("Location: ../../public/admin/admin_dashboard.php");
                exit;
            }
            else if ($this->getName() === "client") {
                $_SESSION["role"] = $this->getName();
                header("Location: ../../public/client/client_dashboard.php");
                exit;
            }
            else if ($this->getName() === "deliverer") {
                $_SESSION["role"] = $this->getName();
                header("Location: ../../public/deliverer/deliverer_dashboard.php");
                exit;
            }
        } catch (PDOException) {
            echo $stmt->errorCode();
        }
    }

    function readRole(){
        try {
            session_start();
            $sql = "SELECT * FROM roles WHERE user_id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(":id", $this->getUser_id());
            $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE ,self::class);
            $stmt->execute(); 
            $roles = $stmt->fetchAll();

            if ($roles[0]["role_name"] == "admin") {
                $_SESSION["role"] = $roles[0]["role_name"];
                header("Location: ../../public/admin/admin_dashboard.php");
                exit;
            }else if ($roles[0]["role_name"] == "client") {
                $_SESSION["role"] = $roles[0]["role_name"];
                $route = "Location: ../../public/client/client_dashboard.php";
                header("Location: ../Controller/ReadNotificationHandler.php?route=$route");
                exit;
            }else if ($roles[0]["role_name"] == "deliverer") {
                $_SESSION["role"] = $roles[0]["role_name"];
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

    function update(){
        try {
            $sql = "UPDATE roles set role_name = COALESCE(:role_name, role_name) WHERE user_id = :user_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(":user_id", $this->getUser_id());
            $stmt->bindValue(":role_name", $this->getName());
            $stmt->execute();    
        } catch (PDOException) {
            echo $stmt->errorCode();
        }
    }

    function delete(){
        try {
            $sql = "DELETE FROM roles WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(":id", $this->getId());
            $stmt->execute();    
            $this->readAll();  
        } catch (PDOException) {
            echo $stmt->errorCode();
        }
    }
}