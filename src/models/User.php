<?php
namespace App\Models;
use PDO;
use PDOException;

class User{
    private ?PDO $conn;
    private ?int $id;
    private ?string $username;
    private ?string $first_name;
    private ?string $last_name;
    private ?string $email;
    private ?string $password;
    private ?string $phone;
    private ?string $address;
    private ?string $created_at;
    private ?bool $is_deleted;

    function __construct(
        $conn = NULL, 
        $id = NULL,
        $username = NULL,
        $first_name = NULL,
        $last_name = NULL,
        $email = NULL,
        $password = NULL,
        $phone = NULL,
        $address = NULL,
        $created_at = NULL,
        $is_deleted = NULL
    )
    {
        $this->conn = $conn;
        $this->id = $id;
        $this->username = $username;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->email = $email;
        $this->password = $password;
        $this->phone = $phone;
        $this->address = $address;
        $this->created_at = $created_at;
        $this->is_deleted = $is_deleted;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getFirstName()
    {
        return $this->first_name;
    }

    public function setFirstName($first_name)
    {
        $this->first_name = $first_name;
    }

    public function getLastName()
    {
        return $this->last_name;
    }

    public function setLastName($last_name)
    {
        $this->last_name = $last_name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function setAddress($address)
    {
        $this->address = $address;
    }

    public function getIs_deleted()
    {
        return $this->is_deleted;
    }

    public function setIs_deleted($is_deleted)
    {
        $this->is_deleted = $is_deleted;
    }

    public function getCreated_at()
    {
        return $this->created_at;
    }

    public function setCreated_at($created_at)
    {
        $this->created_at = $created_at;
    }

    function login(){ 
        try {
            $sql = "SELECT * FROM users WHERE email = :email";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(":email", $this->getEmail());
            $stmt->execute();
            $thisCredentials = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($thisCredentials && $this->getPassword() === $thisCredentials["password"]) {
                session_start();
                foreach ($thisCredentials as $key => $value) {
                    if ($key === 'password' || $key === 'id') {
                        continue;
                    }
                    setcookie($key, $value, time() + 9999, "/");
                }
                $_SESSION["id"] = $thisCredentials["id"];
                header("Location: ../Controller/ReadRoleHandler.php?id=" . $thisCredentials["id"]);
                exit;
            } else {
                echo "Invalid email or password";
            }
        } catch (PDOException) {
            echo $stmt->errorCode();
        }       
    }

    function register($role){
        try {
            session_start();
            $sql = "INSERT INTO users (username, first_name, last_name, email, phone, password, address, created_at) VALUES (:username, :first_name, :last_name, :email, :phone, :password, :address, now())";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(":username", $this->getUsername());
            $stmt->bindValue(":first_name", $this->getFirstName());
            $stmt->bindValue(":last_name", $this->getLastName());
            $stmt->bindValue(":email", $this->getEmail());
            $stmt->bindValue(":phone", $this->getPhone());
            $stmt->bindValue(":password", $this->getPassword());
            $stmt->bindValue(":address", $this->getAddress());
            setcookie("username", $this->getUsername(), time() + 9999, "/");
            setcookie("first_name", $this->getFirstName(), time() + 9999, "/");
            setcookie("last_name", $this->getLastName(), time() + 9999, "/");
            setcookie("email", $this->getEmail(), time() + 9999, "/");
            setcookie("phone", $this->getPhone(), time() + 9999, "/");
            setcookie("address", $this->getAddress(), time() + 9999, "/");
            $stmt->execute();
            $_SESSION["id"] = $this->conn->lastInsertId();
            header("Location: /Role/Create?name=" . $role);
        } catch (PDOException) {
            echo $stmt->errorCode();
        }
    }

    function Update(){
        try {
            $sql = "UPDATE users SET username = COALESCE(:username, username), first_name = COALESCE(:first_name, first_name), last_name = COALESCE(:last_name, last_name), phone = COALESCE(:phone, :phone), address = COALESCE(:address, address) WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(":username", $this->getUsername());
            $stmt->bindValue(":first_name", $this->getFirstName());
            $stmt->bindValue(":last_name", $this->getLastName());
            $stmt->bindValue(":phone", $this->getPhone());
            $stmt->bindValue(":address", $this->getAddress());
            $stmt->bindValue(":id", $this->getId());
            if ($this->getId() === $_SESSION["id"]) {
                setcookie("username", $this->getUsername(), time() + 9999, "/");
                setcookie("first_name", $this->getFirstName(), time() + 9999, "/");
                setcookie("last_name", $this->getLastName(), time() + 9999, "/");
                setcookie("phone", $this->getPhone(), time() + 9999, "/");
                setcookie("address", $this->getAddress(), time() + 9999, "/");
            }
            $stmt->execute();
            $this->readAll();
        } catch (PDOException) {
            echo $stmt->errorCode();
        }
    }

    function readAll(){
        try {
            $sql = "SELECT * FROM users";
            $stmt = $this->conn->prepare($sql);
            $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, self::class);
            $stmt->execute();
            $_SESSION["users"] = $stmt->fetchAll();
        } catch (PDOException) {
            echo $stmt->errorCode();
        }
    }

    function delete(){
        try {
            $sql = "DELETE FROM users WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(":id", $this->getId());
            $stmt->execute();  
            $this->readAll();  
        } catch (PDOException) {
            echo $stmt->errorCode();
        }
    }
}