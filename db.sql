-- Active: 1737733565182@@127.0.0.1@3306@bibliotheque
CREATE DATABASE IF NOT EXISTS `bibliotheque`;
USE `bibliotheque`;

CREATE table administrateur(
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(250) NOT NULL
);

INSERT INTO administrateur (username, password) VALUES ("administrateur", "BUniversitaire");

CREATE TABLE livres (
    id INT PRIMARY KEY AUTO_INCREMENT,
    titre VARCHAR(50) NOT NULL,
    auteur VARCHAR(50) NOT NULL,
    annee INT,
    quantite INT NOT NULL DEFAULT 1
);

CREATE TABLE usagers (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(50) NOT NULL,
    email VARCHAR(50) UNIQUE NOT NULL
); 

CREATE TABLE emprunts (
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_livre INT NOT NULL,
    id_usager INT NOT NULL,
    date_emprunt DATE NOT NULL,
    date_retour DATE,
    rendu BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (id_livre) REFERENCES livres(id),
    FOREIGN KEY (id_usager) REFERENCES usagers(id) 
);