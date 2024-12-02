-- CREACION DE BASE DE DATOS
CREATE DATABASE e_commerce;

USE e_commerce;

-- TABLA user
CREATE TABLE user (
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


-- TABLA product
CREATE TABLE product (
    product_id INT(11) PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    price DECIMAL(10, 2) NOT NULL,  -- Use DECIMAL for currency values
    available INT(11) NOT NULL,      -- To track available stock
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,  -- To track updates
    image_url VARCHAR(255)            -- To store the image URL for the product
);

-- LISTA DE PRODUCTOS
INSERT INTO product (name, description, price, available, image_url) VALUES
('HP Notebook', 'A high-performance laptop with a powerful graphics card and fast processing speed.', 999.99, 6, 'https://pisces.bbystatic.com/image2/BestBuy_US/images/products/2b810a44-822a-4dd1-ae2d-7243d954e406.jpg;maxHeight=2000;maxWidth=2000;format=webp'),
('HP Envy', 'A sleek and stylish laptop with excellent performance for everyday tasks.', 1099.99, 7, 'https://pisces.bbystatic.com/image2/BestBuy_US/images/products/0621b0be-9c7a-4fdd-9de9-cc46ea05bac4.jpg;maxHeight=2000;maxWidth=2000;format=webp'),
('Toshiba B77', 'A gaming laptop with a high refresh rate display and advanced cooling system.', 1299.99, 5, 'https://m.media-amazon.com/images/I/61Ta4G8oGKL._AC_SL1500_.jpg'),
('Dell XPS 13', 'A compact laptop with a stunning display and long battery life.', 1399.99, 8, 'https://pisces.bbystatic.com/image2/BestBuy_US/images/products/6584/6584131_sd.jpg;maxHeight=2000;maxWidth=2000;format=webp'),
('Lenovo ThinkPad X1', 'A business laptop known for its durability and performance.', 1499.99, 4, 'https://pisces.bbystatic.com/image2/BestBuy_US/images/products/bcb4f2a3-4a33-4cd1-a271-24533fff85a0.jpg;maxHeight=2000;maxWidth=2000;format=webp'),
('Apple MacBook Pro', 'A powerful laptop with a Retina display and M1 chip.', 1999.99, 3, 'https://pisces.bbystatic.com/image2/BestBuy_US/images/products/843476e7-9f63-4a98-b9bb-add6f2ee1667.jpg;maxHeight=2000;maxWidth=2000;format=webp'),
('Asus ROG Zephyrus', 'A gaming laptop with top-tier graphics and performance.', 1799.99, 2, 'https://pisces.bbystatic.com/image2/BestBuy_US/images/products/6570/6570222_rd.jpg;maxHeight=2000;maxWidth=2000;format=webp'),
('Acer Swift 3', 'A lightweight laptop with a great balance of performance and portability.', 899.99, 10, 'https://pisces.bbystatic.com/image2/BestBuy_US/images/products/7f704623-0424-4557-bd54-ef072f741e4e.jpg;maxHeight=2000;maxWidth=2000;format=webp'),
('Microsoft Surface Laptop 4', 'A versatile laptop with a touchscreen and excellent battery life.', 1299.99, 5, 'https://pisces.bbystatic.com/image2/BestBuy_US/images/products/6582/6582841_sd.jpg;maxHeight=2000;maxWidth=2000;format=webp'),
('Razer Blade 15', 'A premium gaming laptop with a sleek design and powerful specs.', 2499.99, 3, 'https://pisces.bbystatic.com/image2/BestBuy_US/images/products/6571/6571553_sd.jpg;maxHeight=2000;maxWidth=2000;format=webp'),
('HP Pavilion', 'A budget-friendly laptop with decent performance for everyday use.', 599.99, 12, 'https://pisces.bbystatic.com/image2/BestBuy_US/images/products/54e896a9-98d0-492d-9c86-9f86f9867e68.jpg;maxHeight=2000;maxWidth=2000;format=webp'),
('Samsung Galaxy Book', 'A stylish laptop with a vibrant display and solid performance.', 1099.99, 6, 'https://m.media-amazon.com/images/I/6131ZgIFn1L._AC_SL1500_.jpg'),
('LG Gram 17', 'An ultra-lightweight laptop with a large display and long battery life.', 1699.99, 4, 'https://pisces.bbystatic.com/image2/BestBuy_US/images/products/6540/6540480_sd.jpg;maxHeight=2000;maxWidth=2000;format=webp'),
('Dell Inspiron 15', 'A versatile laptop suitable for both work and play.', 749.99, 8, 'https://pisces.bbystatic.com/image2/BestBuy_US/images/products/6575/6575151_sd.jpg;maxHeight=2000;maxWidth=2000;format=webp'),
('Acer Predator Helios 300', 'A gaming laptop with a high refresh rate and powerful graphics.', 1399.99, 5, 'https://pisces.bbystatic.com/image2/BestBuy_US/images/products/dbbf6389-b5ec-4ffc-b0fc-454fc91fb625.jpg;maxHeight=2000;maxWidth=2000;format=webp'),
('Lenovo Yoga 9i', 'A 2-in-1 laptop with a flexible design and premium features.', 1499.99, 3, 'https://pisces.bbystatic.com/image2/BestBuy_US/images/products/6571/6571372_sd.jpg;maxHeight=2000;maxWidth=2000;format=webp'),
('Microsoft Surface Pro 7', 'A versatile tablet-laptop hybrid with a detachable keyboard.', 999.99, 7, 'https://pisces.bbystatic.com/image2/BestBuy_US/images/products/6582/6582846_sd.jpg;maxHeight=2000;maxWidth=2000;format=webp'),
('Asus ZenBook 14', 'A compact laptop with a stunning display and powerful performance.', 1199.99, 6, 'https://pisces.bbystatic.com/image2/BestBuy_US/images/products/d876410e-9a56-4efe-8a67-3b54eaf6f27d.jpg;maxHeight=2000;maxWidth=2000;format=webp'),
('HP Omen 15', 'A gaming laptop with a sleek design and powerful hardware.', 1599.99, 4, 'https://pisces.bbystatic.com/image2/BestBuy_US/images/products/8b74d9c7-76e8-4a4b-935c-43abb9b68f44.jpg;maxHeight=2000;maxWidth=2000;format=webp'),
('Toshiba Satellite', 'A reliable laptop for everyday tasks and entertainment.', 699.99, 10, 'https://http2.mlstatic.com/D_NQ_NP_2X_767393-MLM69980096713_062023-F.webp');


-- TABLA cart
CREATE TABLE IF NOT EXISTS cart (
    cart_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL DEFAULT 1,
    subtotal DECIMAL(10, 2) NOT NULL,
    date_added DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES user(user_id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES product(product_id) ON DELETE CASCADE
);

