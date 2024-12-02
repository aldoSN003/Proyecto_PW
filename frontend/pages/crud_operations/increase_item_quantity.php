<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
include("../connection.php");

// Enable mysqli exceptions
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    // Check if cart_item_id and action are set in the request
    if (isset($_GET['cart_item_id']) && isset($_GET['action'])) {
        $cart_id = intval($_GET['cart_item_id']);
        $action = $_GET['action']; // 'increase' or 'decrease'
        
        // Fetch the current quantity and price of the product
        $query = "SELECT c.quantity, p.price FROM cart c JOIN product p ON c.product_id = p.product_id WHERE c.cart_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $cart_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $current_quantity = intval($row['quantity']);
            $price = floatval($row['price']);
            
            // Determine the new quantity based on the action
            if ($action === 'increase') {
                $new_quantity = $current_quantity + 1;
            } elseif ($action === 'decrease') {
                // Ensure the quantity does not go below 1
                if ($current_quantity > 1) {
                    $new_quantity = $current_quantity - 1;
                } else {
                    // Optionally handle the case where quantity is already 1
                    $_SESSION['error_message'] = "Cannot decrease quantity below 1.";
                    header('Location: ../shopping_cart.php');
                    exit();
                }
            } else {
                $_SESSION['error_message'] = "Invalid action.";
                header('Location: ../shopping_cart.php');
                exit();
            }

            // Calculate the new subtotal
            $new_subtotal = $new_quantity * $price;

            // Update the cart with the new quantity and subtotal
            $update_query = "UPDATE cart SET quantity = ?, subtotal = ? WHERE cart_id = ?";
            $update_stmt = $conn->prepare($update_query);
            $update_stmt->bind_param("idi", $new_quantity, $new_subtotal, $cart_id);
            $update_stmt->execute();

            // Set a session variable to display a success message
            $_SESSION['success_message'] = "Quantity updated successfully!";
        } else {
            $_SESSION['error_message'] = "Cart item not found.";
        }
    } else {
        $_SESSION['error_message'] = "Invalid request.";
    }
} catch (mysqli_sql_exception $e) {
    // Handle error
    error_log("Database error: " . $e->getMessage());
    $_SESSION['error_message'] = "An error occurred while updating the quantity.";
}

// Redirect back to the shopping cart
header('Location: ../shopping_cart.php');
exit();
?>