<?php
session_start();
include("../connection.php");

// Asegúrate de que el usuario esté autenticado
if (!isset($_SESSION['user'])) {
    die("Acceso no autorizado.");
}

// Verificar si se ha enviado el ID del producto y el total
if (!isset($_POST['product_id']) || !isset($_POST['total'])) {
    die("Datos de producto no válidos.");
}

// Obtener el ID del producto y el total
$product_id = $_POST['product_id'];
$total = $_POST['total'];

// Obtener el precio del producto
$product_query = "SELECT price, available FROM product WHERE product_id = ?";
$product_stmt = $conn->prepare($product_query);
$product_stmt->bind_param("i", $product_id);
$product_stmt->execute();
$product_result = $product_stmt->get_result();
$product = $product_result->fetch_assoc();

if ($product) {
    $price = $product['price'];
    $available = $product['available'];

    // Verificar disponibilidad
    if ($available < 1) {
        die("El producto no está disponible.");
    }

    // Actualizar la disponibilidad del producto
    $update_query = "UPDATE product SET available = available - 1 WHERE product_id = ?";
    $update_stmt = $conn->prepare($update_query);
    $update_stmt->bind_param("i", $product_id);
    $update_stmt->execute();

    // Aquí puedes agregar lógica para registrar la compra en la base de datos, si es necesario

    // Redirigir a una página de éxito o mostrar un mensaje
    header("Location: ../welcome.php?success=1&total=" . urlencode(number_format($total, 2)));
    exit();
} else {
    die("Producto no encontrado.");
}
?>