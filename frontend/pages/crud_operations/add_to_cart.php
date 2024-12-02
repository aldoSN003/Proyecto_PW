<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
include("../connection.php");

// Enable mysqli exceptions
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    if (isset($_GET['product_id'])) {
        $product_id = $_GET['product_id'];
        $user_id = $_SESSION["user"]["id"];

        // Retrieve the product price from the product table to calculate subtotal
        $query_get_product = "SELECT price FROM product WHERE product_id = ?";
        $stmt = $conn->prepare($query_get_product);
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            die("Product not found.");
        }

        $product = $result->fetch_assoc();
        $product_price = floatval($product['price']);

        // Check if the product is already in the cart
        $query_check_cart = "SELECT quantity FROM cart WHERE user_id = ? AND product_id = ?";
        $stmt = $conn->prepare($query_check_cart);
        $stmt->bind_param("ii", $user_id, $product_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Product is already in the cart, update the quantity
            $row = $result->fetch_assoc();
            $new_quantity = $row['quantity'] + 1;
            $new_subtotal = $new_quantity * $product_price; // Update subtotal based on new quantity

            $query_update_cart = "UPDATE cart SET quantity = ?, subtotal = ? WHERE user_id = ? AND product_id = ?";
            $stmt = $conn->prepare($query_update_cart);
            $stmt->bind_param("idii", $new_quantity, $new_subtotal, $user_id, $product_id);
            $stmt->execute();
        } else {
            // Product is not in the cart, insert it
            $quantity = 1;
            $subtotal = $product_price; // Set subtotal to the product price for the first item
            $query_insert_cart = "INSERT INTO cart (user_id, product_id, quantity, subtotal) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($query_insert_cart);
            $stmt->bind_param("iiid", $user_id, $product_id, $quantity, $subtotal);
            $stmt->execute();
        }

        // Set a session variable to display a success message
        $_SESSION['success_message'] = "Product added to cart successfully!";
        header('Location: ../shopping_cart.php'); // Redirect to the shopping cart
        exit(); // Ensure no further code is executed after redirection
    }
} catch (mysqli_sql_exception $e) {
    // Handle error
    error_log("Database error: " . $e->getMessage()); // Log the error message
    die("An error occurred while adding the product to your cart."); // Display a user-friendly message
}
