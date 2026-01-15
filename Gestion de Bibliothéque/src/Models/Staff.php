<?php

use PDO;

class Staff extends User{
    private PDO $conn;

    public function __construct($conn = NULL, $id = NULL, $username = NULL, $firstName = NULL, $lastName = NULL, $email = NULL, $password = NULL)
    {
        $this->conn = $conn;
        parent::__construct($id, $username, $firstName, $lastName, $email, $password);
    }
}