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

CREATE TABLE commande_item (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    quantity INT NOT NULL,
    date date
)

CREATE TABLE notifications (
    id INT PRIMARY KEY AUTO_INCREMENT,
    contenu VARCHAR(50) NOT NULL,
    statu VARCHAR(50) NOT NULL,
    created_at TIMESTAMP ,
) 

CREATE TABLE offres (
    id INT PRIMARY KEY AUTO_INCREMENT,
    vehicule VARCHAR(50) NOT NULL,
    prix INT NOT NULL,
    duree_estimee DATE DEFAULT NULL,
)

CREATE TABLE role (
    id INT PRIMARY KEY AUTO_INCREMENT,
    role_name VARCHAR(70) NOT NULL,
    permissions VARCHAR(70) NOT NULL,
)


ALTER TABLE commande_items
ADD COLUMN commande_id INT NOT NULL,
ADD CONSTRAINT fk_commande
    FOREIGN KEY (commande_id) REFERENCES commandes(id)
    ON DELETE CASCADE;

ALTER TABLE commande_items ADD price INT NOT NULL AFTER quantity