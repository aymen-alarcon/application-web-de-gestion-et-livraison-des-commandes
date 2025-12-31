CREATE DATABASE gestion_et_livraison_des_commandes

CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(70) NOT NULL,
    first_name VARCHAR(70) NOT NULL,
    last_name VARCHAR(70) NOT NULL,
    phone VARCHAR(70) NULL NULL,
    email VARCHAR(70) NOT NULL,
    password VARCHAR(70) NOT NULL,
    address VARCHAR(70) NOT NULL,
    created_at TIMESTAMP,
)

CREATE TABLE commande (
    id INT PRIMARY KEY AUTO_INCREMENT,
    titre VARCHAR(70) NOT NULL,
    address VARCHAR(70) NOT NULL,
    statu VARCHAR(70) NOT NULL,
    created_at TIMESTAMP,
    is_deleted ENUM('0', '1') DEFAULT '0',
)