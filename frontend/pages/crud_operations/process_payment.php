<?php
session_start();
include("../connection.php");

// Asegúrate de que el usuario esté autenticado
if (!isset($_SESSION['user'])) {
    die("Acceso no autorizado.");
}

// Obtener el ID del usuario
$user_id = $_SESSION['user']['id']; // Asegúrate de que el ID del usuario esté en la sesión

// Obtener los productos del carrito
$query = "SELECT product_id, quantity FROM cart WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Inicializar variables para el total
$total = 0;

// Actualizar la disponibilidad de los productos y calcular el total
while ($row = $result->fetch_assoc()) {
    $product_id = $row['product_id'];
    $quantity = $row['quantity'];

    // Obtener el precio del producto
    $product_query = "SELECT price FROM product WHERE product_id = ?";
    $product_stmt = $conn->prepare($product_query);
    $product_stmt->bind_param("i", $product_id);
    $product_stmt->execute();
    $product_result = $product_stmt->get_result();
    $product = $product_result->fetch_assoc();

    if ($product) {
        $price = $product['price'];
        $subtotal = $price * $quantity;
        $total += $subtotal;

        // Actualizar el campo 'available' en la tabla 'product'
        $update_query = "UPDATE product SET available = available - ? WHERE product_id = ?";
        $update_stmt = $conn->prepare($update_query);
        $update_stmt->bind_param("ii", $quantity, $product_id);
        $update_stmt->execute();
    }
}

// Aquí puedes agregar lógica para procesar el pago (por ejemplo, integrar con una API de pago)
// Por simplicidad, asumimos que el pago se procesa correctamente

// Limpiar el carrito después del pago
$delete_query = "DELETE FROM cart WHERE user_id = ?";
$delete_stmt = $conn->prepare($delete_query);
$delete_stmt->bind_param("i", $user_id);
$delete_stmt->execute();

// Redirigir a una página de éxito o mostrar un mensaje
header("Location: ../shopping_cart.php?success=1&total=" . urlencode(number_format($total, 2)));
exit();
?>