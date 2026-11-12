-- create database recette;

CREATE TABLE IF NOT EXISTS recette_api CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE recette;


-- create table recette 
CREATE TABLE IF NOT EXISTS recette ( 
    
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(150) NOT NULL,
    pays VARCHAR(100) NOT NULL,
    difficulte INT NOT NULL,
    details TEXT NOT NULL
  
)ENGINE=InnoDB;