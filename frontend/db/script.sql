-- Create the database
CREATE DATABASE PWeb;

-- Use the created database
USE PWeb;

-- Create the users table
CREATE TABLE Users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    birth_date DATE NOT NULL,
    gender ENUM('Mujer', 'Hombre', 'Otro') NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    phone VARCHAR(15) NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_At TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

