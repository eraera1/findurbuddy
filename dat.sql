CREATE DATABASE IF NOT EXISTS animal_shelter;
USE animal_shelter;


CREATE TABLE IF NOT EXISTS animals (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    breed VARCHAR(100) NOT NULL,
    age INT NOT NULL,
    adopted BOOLEAN DEFAULT FALSE
);
