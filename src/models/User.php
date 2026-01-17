<?php
namespace App\Models;
use PDO;
use PDOException;

class User{
    private PDO $conn;
    private ?int $id;
    private ?string $username;
    private ?string $firstName;
    private ?string $lastName;
    private ?string $email;
    private ?string $password;
    private ?string $phone;
    private ?string $address;

    function __construct(
        $conn = NULL, 
        $id = NULL,
        $username = NULL,
        $firstName = NULL,
        $lastName = NULL,
        $email = NULL,
        $password = NULL,
        $phone = NULL,
        $address = NULL
    )
    {
        $this->conn = $conn;
        $this->id = $id;
        $this->username = $username;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->password = $password;
        $this->phone = $phone;
        $this->address = $address;
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
        return $this->firstName;
    }

    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
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
            header("Location: ../Controller/RegisterRoleHandler.php?id=" . $_SESSION["id"] . "&name=" . $role);
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
            $link = explode("/", $_SERVER["HTTP_REFERER"]);
            header("Location: ../../" . $link[4] . "/" . $link[5] . "/" . $link[6]);
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