-- Create the database
CREATE DATABASE pweb;

DROP DATABASE pweb;

-- Use the created database
USE pweb;

-- Create the users table
CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50),
    last_name VARCHAR(50),
    birth_date DATE,
    gender ENUM('Mujer', 'Hombre', 'Otro'),
    email VARCHAR(100),
    phone VARCHAR(15),
    password char(60),
    created_At TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO
    users (
        first_name,
        last_name,
        birth_date,
        gender,
        email,
        phone,
        password
    )
VALUES
    (
        'John',
        'Doe',
        '1990-01-01',
        'Hombre',
        'johndoe@example.com',
        '123-456-7890',
        '123456'
    );

SELECT
    *
FROM
    users;