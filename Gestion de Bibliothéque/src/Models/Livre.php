<?php
namespace App\Models;
use PDO;
class Livre{
    private PDO $conn;
    private ?int $id;
    private ?string $titre;
    private ?string $description;
    private ?string $date_creation;

    public function __construct($conn, $id = NULL, $titre = NULL, $description = NULL, $date_creation = NULL)
    {
        $this->conn = $conn;
        $this->id = $id;
        $this->titre = $titre;
        $this->description = $description;
        $this->date_creation = $date_creation;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getTitre()
    {
        return $this->titre;
    }

    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getDate_creation()
    {
        return $this->date_creation;
    }

    public function setDate_creation($date_creation)
    {
        $this->date_creation = $date_creation;
    }

    function create(){
        $sql = "INSERT INTO livres (titre, description, date_creation) VALUES (:titre, :description, now())";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue("titre", $this->getTitre());
        $stmt->bindValue(":description", $this->getDescription());
        $stmt->execute();
    }

    function update(){
        $sql = "UPDATE livres SET titre = COALESCE(titre:,titre), description = COALESCE(description:,description) WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":titre", $this->getTitre());
        $stmt->bindValue(":description", $this->getDescription());
        $stmt->bindValue(":id", $this->getId());
        $stmt->execute();
    }

    function readById(){
        $sql = "SELECT * FROM livres WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":id", $this->getId());
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_ORI_PRIOR, self::class);
        $stmt->execute();
        $stmt->fetch();
    }

    function delete(){
        $sql = "DELETE FROM livres WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":id", $this->getId());
        $stmt->execute();
    }
}