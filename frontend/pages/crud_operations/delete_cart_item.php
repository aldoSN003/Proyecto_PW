<?php
include("../connection.php");
session_start();

if (isset($_GET['cart_item_id'])) {
    $item_id = $_GET['cart_item_id'];
    $query = "DELETE FROM cart WHERE cart_id = ?";
    
    // Prepare statement
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $item_id);
    $result = $stmt->execute();

    if (!$result) {
        die("Query Failed.");
    }

    $_SESSION['message'] = 'Cart item removed successfully!';
    $_SESSION['message_type'] = 'danger';
    header('Location: ../shopping_cart.php');
    exit();
}
?>