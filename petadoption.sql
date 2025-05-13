CREATE DATABASE petdoption;

USE petdoption;

CREATE TABLE pets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    type VARCHAR(50),
    personality VARCHAR(50),
    image_url VARCHAR(255),
    is_adopted BOOLEAN DEFAULT 0
);
