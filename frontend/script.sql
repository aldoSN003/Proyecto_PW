-- Create the database
CREATE DATABASE PWeb;
DROP DATABASE  PWeb;
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
    p VARCHAR(255) NOT NULL,
    created_At TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
INSERT INTO users (first_name, last_name, birth_date, gender, email, phone, p)
VALUES ('John', 'Doe', '1990-01-01', 'Hombre', 'johndoe@example.com', '123-456-7890', 'password_hash');
SELECT * FROM Users;
-- Optionally, you can add an index for faster lookups on the EmailAddress
CREATE INDEX idx_email ON Users(EmailAddress);